<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
?>
<table class="admintable">
	<tr>
		<td width="75" style="width: 75px;" align="right" class="key">CSS</td>
		<td><?php echo JText::_('RSFP_CSS_DESC'); ?></td>
	</tr>
	<tr>
		<td colspan="2"><textarea class="rs_textarea codemirror-css" rows="20" cols="75" name="CSS" id="CSS" style="width:100%;"><?php echo $this->escape($this->form->CSS);?></textarea></td>
	</tr>
	<tr>
		<td width="75" style="width: 75px;" align="right" class="key">Javascript</td>
		<td><?php echo JText::_('RSFP_JS_DESC'); ?></td>
	</tr>
	<tr>
		<td colspan="2"><textarea class="rs_textarea codemirror-js" rows="20" cols="75" name="JS" id="JS" style="width:100%;"><?php echo $this->escape($this->form->JS);?></textarea></td>
	</tr>
</table>