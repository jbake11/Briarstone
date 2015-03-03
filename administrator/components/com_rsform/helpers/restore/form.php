<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

class RSFormProRestoreForm
{
	// JDatabase instance
	protected $db;
	
	// Holds the form's structure as a JTable object
	protected $form;
	
	// Holds an array of the XML data.
	protected $xml;
	
	// Holds an array in the form of field ID => field name.
	protected $fields;
	
	// Holds the setting for keeping the form's ids from the backup
	protected $keepId;
	
	public function __construct($options = array()) {
		$this->keepId		= isset($options['keepId']) ? true : false;
		$path 	  			= &$options['path'];
		$this->db 			= JFactory::getDbo();
		
		// Check if the form's xml exists
		if (!file_exists($path)) {
			throw new Exception(sprintf('The file %s does not exist!', $path));
		}
		
		if (!is_readable($path)) {
			throw new Exception(sprintf('File %s is not readable!', $path));
		}
		
		// Attempt to load the XML data
		libxml_use_internal_errors(true);
		
		$this->xml = simplexml_load_file($options['path']);
		
		if ($this->xml === false) {
			$errors = array();
			foreach (libxml_get_errors() as $error) {
				$errors[] = 'Message: '.$error->message.'; Line: '.$error->line.'; Column: '.$error->column;
			}
			throw new Exception(sprintf('Error while parsing XML: %s<br/>', implode('<br />', $errors)));
		}
	}
	
	public function restore() {
		$this->restoreStructure();
		$this->restoreFields();
		$this->restoreCalculations();
		$this->restorePost();
		$this->restoreConditions();
		$this->restoreDirectory();
		$this->restoreEmails();
		$this->restoreMappings();
		
		// Allow plugins to restore their own data from the backup.
		JFactory::getApplication()->triggerEvent('rsfp_onFormRestore', array($this->form, $this->xml, $this->fields));
	}
	
	public function getFormId() {
		return $this->form->FormId;
	}
	
	// Form structure
	// ==============
	
	protected function restoreStructure() {
		// Restore the form structure #__rsform_forms
		$data 			= array();
		$oldFormId 		= false;
		foreach ($this->xml->structure->children() as $property => $value) {
			// Skip translations for now
			if ($property == 'translations') {
				continue;
			}
			
			if ($property == 'FormId') {
				$oldFormId = (string) $value;
				continue;
			}
			
			$data[$property] = (string) $value;
		}
		
		$this->form = JTable::getInstance('RSForm_Forms', 'Table');
		
		if ($this->keepId && $oldFormId) {
			if (!$this->form->load($oldFormId)) {
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_forms')
						->set($this->db->qn('FormId') .'='. $this->db->q($oldFormId));
				$this->db->setQuery($query)->execute();
				
				$data['FormId'] = $oldFormId;
			}
			
			// Reset it back
			$this->form = JTable::getInstance('RSForm_Forms', 'Table');
		}
		
		if (!$this->form->save($data)) {
			throw new Exception(sprintf('Form %s could not be saved!', $this->form->FormTitle));
		}
		
		// Restore form translations
		if ($this->xml->structure->translations) {
			foreach ($this->xml->structure->translations->children() as $lang_code => $properties) {
				foreach ($properties->children() as $property => $value) {
					$query = $this->db->getQuery(true);
					$query	->insert('#__rsform_translations')
							->set(array(
									$this->db->qn('form_id')		.'='.$this->db->q($this->form->FormId),
									$this->db->qn('lang_code')		.'='.$this->db->q((string) $lang_code),
									$this->db->qn('reference')		.'='.$this->db->q('forms'),
									$this->db->qn('reference_id')	.'='.$this->db->q((string) $property),
									$this->db->qn('value')			.'='.$this->db->q((string) $value)
							));
					$this->db->setQuery($query)->execute();
				}
			}
		}
	}
	
	// Fields
	// ======
	
	protected function restoreFields() {
		// Restore the form fields #__rsform_components
		if (isset($this->xml->fields)) {
			foreach ($this->xml->fields->children() as $field) {
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_components')
						->set(array(
								$this->db->qn('FormId')				.'='.$this->db->q($this->form->FormId),
								$this->db->qn('ComponentTypeId')	.'='.$this->db->q((string) $field->ComponentTypeId),
								$this->db->qn('Order')				.'='.$this->db->q((string) $field->Order),
								$this->db->qn('Published')			.'='.$this->db->q((string) $field->Published)
						));
				$this->db->setQuery($query)->execute();
				$componentId = $this->db->insertid();
				
				
				if (isset($field->properties)) {
					foreach ($field->properties->children() as $property => $value) {
						$query = $this->db->getQuery(true);
						$query	->insert('#__rsform_properties')
								->set(array(
										$this->db->qn('ComponentId')	.'='.$this->db->q($componentId),
										$this->db->qn('PropertyName')	.'='.$this->db->q((string) $property),
										$this->db->qn('PropertyValue')	.'='.$this->db->q((string) $value)
								));
						$this->db->setQuery($query)->execute();
						// store the ComponentId
						if ((string) $property == 'NAME') {
							$this->fields[(string) $value] = $componentId;
						}
					}
				}
				if (isset($field->translations)) {
					foreach ($field->translations->children() as $lang_code => $properties) {
						foreach ($properties->children() as $property => $value) {
							$query = $this->db->getQuery(true);
							$reference_id = $componentId.'.'.(string) $property;
							$query	->insert('#__rsform_translations')
									->set(array(
											$this->db->qn('form_id')		.'='.$this->db->q($this->form->FormId),
											$this->db->qn('lang_code')		.'='.$this->db->q((string) $lang_code),
											$this->db->qn('reference')		.'='.$this->db->q('properties'),
											$this->db->qn('reference_id')	.'='.$this->db->q($reference_id),
											$this->db->qn('value')			.'='.$this->db->q((string) $value)
									));
							$this->db->setQuery($query)->execute();
						}
					}
				}
			}
		}
	}
	
	// Calculations
	// ============
	
	protected function restoreCalculations() {
		// Restore Calculations #__rsform_calculations
		if (isset($this->xml->calculations)) {
			foreach ($this->xml->calculations->children() as $calculation) {
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_calculations')
						->set(array(
								$this->db->qn('formId')		.'='.$this->db->q($this->form->FormId),
								$this->db->qn('total')		.'='.$this->db->q((string) $calculation->total),
								$this->db->qn('expression')	.'='.$this->db->q((string) $calculation->expression),
								$this->db->qn('ordering')	.'='.$this->db->q((string) $calculation->ordering)
						));
				$this->db->setQuery($query)->execute();
			}
		}
	}
	
	// Post
	// ====
	
	protected function restorePost() {
		// Restore Post to Location #__rsform_posts
		if (isset($this->xml->post)) {
			foreach ($this->xml->post as $post) {
				// Some older versions might have left some data here due to a bug, must delete it first.
				$query = $this->db->getQuery(true);
				$query->delete('#__rsform_posts')
					  ->where($this->db->qn('form_id').' = '.$this->db->q($this->form->FormId));
				$this->db->setQuery($query)->execute();
				
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_posts')
						->set(array(
								$this->db->qn('form_id').'='.$this->db->q($this->form->FormId),
								$this->db->qn('enabled').'='.$this->db->q((string) $post->enabled),
								$this->db->qn('method')	.'='.$this->db->q((string) $post->method),
								$this->db->qn('silent')	.'='.$this->db->q((string) $post->silent),
								$this->db->qn('url')	.'='.$this->db->q((string) $post->url)
						));
				$this->db->setQuery($query)->execute();
			}
		}
	}
	
	// Conditions
	// ==========
	
	protected function restoreConditions() {
		// Restore conditions #__rsform_conditions & #__rsform_condition_details
		if (isset($this->xml->conditions)) {
			foreach ($this->xml->conditions->children() as $condition) {
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_conditions')
						->set(array(
								$this->db->qn('form_id')		.'='.$this->db->q($this->form->FormId),
								$this->db->qn('action')			.'='.$this->db->q((string) $condition->action),
								$this->db->qn('block')			.'='.$this->db->q((string) $condition->block),
								$this->db->qn('component_id')	.'='.$this->db->q($this->fields[(string) $condition->component_id]),
								$this->db->qn('condition')		.'='.$this->db->q((string) $condition->condition),
								$this->db->qn('lang_code')		.'='.$this->db->q((string) $condition->lang_code)
						));
				$this->db->setQuery($query)->execute();
				$conditionId = $this->db->insertid();
				
				if (isset($condition->details)) {
					foreach ($condition->details->children() as $detail) {
						$query = $this->db->getQuery(true);
						$query	->insert('#__rsform_condition_details')
								->set(array(
										$this->db->qn('condition_id')	.'='.$this->db->q($conditionId),
										$this->db->qn('component_id')	.'='.$this->db->q($this->fields[(string) $detail->component_id]),
										$this->db->qn('operator')		.'='.$this->db->q((string) $detail->operator),
										$this->db->qn('value')			.'='.$this->db->q((string) $detail->value)
								));
						$this->db->setQuery($query)->execute();
						
					}
				}
			}
		}
	}
	
	// Directory
	// =========
	
	protected function restoreDirectory() {
		// Restore directory #__rsform_directory & #__rsform_directory_fields
		if (isset($this->xml->directory)) {
			foreach ($this->xml->directory as $directory) {				
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_directory')
						->set(array(
								$this->db->qn('formId')					.'='.$this->db->q($this->form->FormId),
								$this->db->qn('enablepdf')				.'='.$this->db->q((string) $directory->enablepdf),
								$this->db->qn('enablecsv')				.'='.$this->db->q((string) $directory->enablecsv),
								$this->db->qn('ViewLayout')				.'='.$this->db->q((string) $directory->ViewLayout),
								$this->db->qn('ViewLayoutName')			.'='.$this->db->q((string) $directory->ViewLayoutName),
								$this->db->qn('ViewLayoutAutogenerate')	.'='.$this->db->q((string) $directory->ViewLayoutAutogenerate),
								$this->db->qn('CSS')					.'='.$this->db->q((string) $directory->CSS),
								$this->db->qn('JS')						.'='.$this->db->q((string) $directory->JS),
								$this->db->qn('ListScript')				.'='.$this->db->q((string) $directory->ListScript),
								$this->db->qn('DetailsScript')			.'='.$this->db->q((string) $directory->DetailsScript),
								$this->db->qn('EmailsScript')			.'='.$this->db->q((string) $directory->EmailsScript),
								$this->db->qn('groups')					.'='.$this->db->q((string) $directory->groups),
						));
				$this->db->setQuery($query)->execute();
				
				if (isset($directory->fields)) {
					foreach ($directory->fields->children() as $field) {
						// check for the component ID
						$componentId = (string) $field->componentId;
						if (!is_numeric($componentId)) {
							if (isset($this->fields[$componentId])) {
								$componentId = $this->fields[$componentId];
							}
						} else {
							$componentId = (int) $componentId;
						}
						
						if (is_int($componentId)) {
							$query = $this->db->getQuery(true);
							$query	->insert('#__rsform_directory_fields')
									->set(array(
											$this->db->qn('formId')			.'='.$this->db->q($this->form->FormId),
											$this->db->qn('componentId')	.'='.$this->db->q($componentId),
											$this->db->qn('viewable')		.'='.$this->db->q((string) $field->viewable),
											$this->db->qn('searchable')		.'='.$this->db->q((string) $field->searchable),
											$this->db->qn('editable')		.'='.$this->db->q((string) $field->editable),
											$this->db->qn('indetails')		.'='.$this->db->q((string) $field->indetails),
											$this->db->qn('incsv')			.'='.$this->db->q((string) $field->incsv),
											$this->db->qn('ordering')		.'='.$this->db->q((string) $field->ordering)
									));
							$this->db->setQuery($query)->execute();
						}
					}
				}
			}
		}
	}
	
	// Emails
	// ======
	
	protected function restoreEmails() {
		// Restore Emails #__rsform_emails
		if (isset($this->xml->emails)) {
			foreach ($this->xml->emails->children() as $email) {
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_emails')
						->set(array(
								$this->db->qn('formId')		.'='.$this->db->q($this->form->FormId),
								$this->db->qn('type')		.'='.$this->db->q((string) $email->type),
								$this->db->qn('from')		.'='.$this->db->q((string) $email->from),
								$this->db->qn('fromname')	.'='.$this->db->q((string) $email->fromname),
								$this->db->qn('replyto')	.'='.$this->db->q((string) $email->replyto),
								$this->db->qn('to')			.'='.$this->db->q((string) $email->to),
								$this->db->qn('cc')			.'='.$this->db->q((string) $email->cc),
								$this->db->qn('bcc')		.'='.$this->db->q((string) $email->bcc),
								$this->db->qn('subject')	.'='.$this->db->q((string) $email->subject),
								$this->db->qn('mode')		.'='.$this->db->q((string) $email->mode),
								$this->db->qn('message')	.'='.$this->db->q((string) $email->message)
						));
				$this->db->setQuery($query)->execute();
				
				if (isset($email->translations)) {
					foreach ($email->translations->children() as $lang_code => $properties) {
						foreach ($properties->children() as $property => $value) {
							$query = $this->db->getQuery(true);
							$query	->insert('#__rsform_translations')
									->set(array(
											$this->db->qn('form_id')		.'='.$this->db->q($this->form->FormId),
											$this->db->qn('lang_code')		.'='.$this->db->q((string) $lang_code),
											$this->db->qn('reference')		.'='.$this->db->q('emails'),
											$this->db->qn('reference_id')	.'='.$this->db->q((string) $property),
											$this->db->qn('value')			.'='.$this->db->q((string) $value)
									));
							$this->db->setQuery($query)->execute();
						}
					}
				}
			}
		}
	}
	
	// Mappings
	// ========
	
	protected function restoreMappings() {
		// Restore Mappings #__rsform_mappings
		if (isset($this->xml->mappings)) {
			foreach ($this->xml->mappings->children() as $mapping) {				
				$query = $this->db->getQuery(true);
				$query	->insert('#__rsform_mappings')
						->set(array(
								$this->db->qn('formId')		.'='.$this->db->q($this->form->FormId),
								$this->db->qn('connection')	.'='.$this->db->q((string) $mapping->connection),
								$this->db->qn('host')		.'='.$this->db->q((string) $mapping->host),
								$this->db->qn('port')		.'='.$this->db->q((string) $mapping->port),
								$this->db->qn('username')	.'='.$this->db->q((string) $mapping->username),
								$this->db->qn('password')	.'='.$this->db->q((string) $mapping->password),
								$this->db->qn('database')	.'='.$this->db->q((string) $mapping->database),
								$this->db->qn('method')		.'='.$this->db->q((string) $mapping->method),
								$this->db->qn('table')		.'='.$this->db->q((string) $mapping->table),
								$this->db->qn('data')		.'='.$this->db->q((string) $mapping->data),
								$this->db->qn('wheredata')	.'='.$this->db->q((string) $mapping->wheredata),
								$this->db->qn('extra')		.'='.$this->db->q((string) $mapping->extra),
								$this->db->qn('andor')		.'='.$this->db->q((string) $mapping->andor),
								$this->db->qn('ordering')	.'='.$this->db->q((string) $mapping->ordering),
						));
				$this->db->setQuery($query)->execute();
			}
		}
	}	
}