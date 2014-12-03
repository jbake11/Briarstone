/* JCE Editor - 2.4.3 | 11 September 2014 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2014 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
(function(){var each=tinymce.each,extend=tinymce.extend,JSON=tinymce.util.JSON;var isWin=navigator.platform.indexOf('Win')!==-1,isSafari=tinymce.isWebKit&&navigator.vendor.indexOf('Apple')!==-1;var Node=tinymce.html.Node;var mimes={};function toArray(list){return Array.prototype.slice.call(list||[],0);}
(function(mime_data){var items=mime_data.split(/,/),i,y,ext;for(i=0;i<items.length;i+=2){ext=items[i+1].split(/ /);for(y=0;y<ext.length;y++){mimes[ext[y]]=items[i];}}})("application/msword,doc dot,"+"application/pdf,pdf,"+"application/pgp-signature,pgp,"+"application/postscript,ps ai eps,"+"application/rtf,rtf,"+"application/vnd.ms-excel,xls xlb,"+"application/vnd.ms-powerpoint,ppt pps pot,"+"application/zip,zip,"+"application/x-shockwave-flash,swf swfl,"+"application/vnd.openxmlformats-officedocument.wordprocessingml.document,docx,"+"application/vnd.openxmlformats-officedocument.wordprocessingml.template,dotx,"+"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,"+"application/vnd.openxmlformats-officedocument.presentationml.presentation,pptx,"+"application/vnd.openxmlformats-officedocument.presentationml.template,potx,"+"application/vnd.openxmlformats-officedocument.presentationml.slideshow,ppsx,"+"application/x-javascript,js,"+"application/json,json,"+"audio/mpeg,mpga mpega mp2 mp3,"+"audio/x-wav,wav,"+"audio/mp4,m4a,"+"image/bmp,bmp,"+"image/gif,gif,"+"image/jpeg,jpeg jpg jpe,"+"image/photoshop,psd,"+"image/png,png,"+"image/svg+xml,svg svgz,"+"image/tiff,tiff tif,"+"text/plain,asc txt text diff log,"+"text/html,htm html xhtml,"+"text/css,css,"+"text/csv,csv,"+"text/rtf,rtf,"+"video/mpeg,mpeg mpg mpe,"+"video/quicktime,qt mov,"+"video/mp4,mp4,"+"video/x-m4v,m4v,"+"video/x-flv,flv,"+"video/x-ms-wmv,wmv,"+"video/avi,avi,"+"video/webm,webm,"+"video/vnd.rn-realvideo,rv,"+"application/vnd.oasis.opendocument.formula-template,otf,"+"application/octet-stream,exe");var state={STOPPED:1,STARTED:2,QUEUED:1,UPLOADING:2,FAILED:4,DONE:5,GENERIC_ERROR:-100,HTTP_ERROR:-200,IO_ERROR:-300,SECURITY_ERROR:-400}
tinymce.create('tinymce.plugins.Upload',{files:[],plugins:[],init:function(ed,url){function cancel(){ed.dom.bind(ed.getBody(),'dragover',function(e){var dataTransfer=e.dataTransfer;if(dataTransfer&&dataTransfer.files&&dataTransfer.files.length){e.preventDefault();}});ed.dom.bind(ed.getBody(),'drop',function(e){var dataTransfer=e.dataTransfer;if(dataTransfer&&dataTransfer.files&&dataTransfer.files.length){e.preventDefault();}});}
var self=this;self.editor=ed;self.plugin_url=url;ed.onPreInit.add(function(){each(ed.plugins,function(o,k){if(ed.getParam(k+'_upload')&&tinymce.is(o.getUploadURL,'function')&&tinymce.is(o.insertUploadedFile,'function')){self.plugins.push(o);}});if(!ed.settings.compress.css){ed.dom.loadCSS(url+"/css/content.css");}
ed.parser.addNodeFilter('img',function(nodes){var i=nodes.length,node,cls,data;while(i--){node=nodes[i],cls=node.attr('class'),data=node.attr('data-mce-upload-marker');if((cls&&cls.indexOf('upload-placeholder')!=-1)||data){if(self.plugins.length==0){node.remove();}else{self._createUploadMarker(node);}}}});ed.serializer.addNodeFilter('img',function(nodes){var i=nodes.length,node,cls;while(i--){node=nodes[i],cls=node.attr('class');if(cls&&/mceItemUploadMarker/.test(cls)){cls=cls.replace(/(?:^|\s)mceItem(Upload|UploadMarker)(?!\S)/g,'');cls+=' upload-placeholder';node.attr({'data-mce-src':'media/jce/img/placeholder.png','class':tinymce.trim(cls)});}}});});ed.onInit.add(function(){if(!window.FormData){cancel();return;}
if(self.plugins.length==0){cancel();return;}
function bindUploadEvents(ed){each(ed.dom.select('img.mceItemUploadMarker',ed.getBody()),function(n){if(self.plugins.length==0){ed.dom.remove(n);}else{self._bindUploadMarkerEvents(ed,n);}});}
ed.selection.onSetContent.add(function(){bindUploadEvents(ed);});ed.onSetContent.add(function(){bindUploadEvents(ed);});if(ed.onFullScreen){ed.onFullScreen.add(function(editor){bindUploadEvents(editor);});}
if(isSafari&&isWin){ed.dom.bind(ed.getBody(),'dragenter',function(e){var dataTransfer=e.dataTransfer;if(dataTransfer&&dataTransfer.files&&dataTransfer.files.length){var dropInputElm;dropInputElm=ed.dom.get(ed.getBody().id+"_dragdropupload");if(!dropInputElm){dropInputElm=ed.dom.add(ed.getBody(),"input",{'type':'file','id':ed.getBody().id+"_dragdropupload",'multiple':'multiple','style':{position:'absolute',display:'block',top:0,left:0,width:'100%',height:'100%',opacity:'0'}});}
ed.dom.bind(dropInputElm,'change',function(e){each(dropInputElm.files,function(file){if(tinymce.inArray(self.files,file)==-1){self.addFile(file);}});ed.dom.unbind(dropInputElm,'change');ed.dom.remove(dropInputElm);each(self.files,function(file){self.upload(file);});});}});ed.dom.bind(ed.getBody(),'drop',function(e){var dataTransfer=e.dataTransfer;if(dataTransfer&&dataTransfer.files&&dataTransfer.files.length){e.preventDefault();}});return;}
if(window.Opera){return;}
function cancelEvent(e){e.preventDefault();e.stopPropagation();}
if(tinymce.isIE||tinymce.isIE11){ed.dom.bind(ed.getBody(),'dragover',cancelEvent);}
ed.dom.bind(ed.getBody(),'drop',function(e){var dataTransfer=e.dataTransfer;if(dataTransfer&&dataTransfer.files&&dataTransfer.files.length){each(dataTransfer.files,function(file){self.addFile(file);});cancelEvent(e);}
if(self.files.length){each(self.files,function(file){self.upload(file);});}
if(tinymce.isGecko&&e.target.nodeName=='IMG'){cancelEvent(e);}});});self.FilesAdded=new tinymce.util.Dispatcher(this);self.UploadProgress=new tinymce.util.Dispatcher(this);self.FileUploaded=new tinymce.util.Dispatcher(this);self.UploadError=new tinymce.util.Dispatcher(this);this.settings={multipart:true,multi_selection:true,file_data_name:'file',filters:[]};self.FileUploaded.add(function(file,o){var n=file.marker,s,w,h;function showError(error){ed.windowManager.alert(error||ed.getLang('upload.response_error','Invalid Upload Response'));ed.dom.remove(n);return false;}
if(n){if(o&&o.response){var r=JSON.parse(o.response);if(!r){return showError();}
if(r.error){var txt=r.text||r.error;ed.windowManager.alert(txt);ed.dom.remove(n);return false;}
if(file.status==state.DONE){r.type=file.type;if(file.uploader){o=file.uploader;if(s=o.insertUploadedFile(r)){var styles=ed.dom.getAttrib(n,'data-mce-style');if(styles){styles=ed.dom.styles.parse(styles);ed.dom.setStyles(s,styles);}
if(ed.dom.hasClass(n,'mceItemUploadMarker')){ed.dom.setAttribs(s,{'width':n.width||s.width,'height':n.height||s.height});}
if(ed.dom.replace(s,n)){ed.nodeChanged();return true;}}}
self.files.splice(tinymce.inArray(self.files,file),1);}}else{return showError();}
ed.dom.remove(n);}});self.UploadError.add(function(o){ed.windowManager.alert(o.code+' : '+o.message);if(o.file&&o.file.marker){ed.dom.remove(o.file.marker);}});},_bindUploadMarkerEvents:function(ed,marker){var self=this,dom=tinymce.DOM;function removeUpload(){dom.setStyles('wf_upload_button',{'top':'','left':'','display':'none','zIndex':''});}
ed.onNodeChange.add(removeUpload);ed.dom.bind(ed.getWin(),'scroll',removeUpload);var input=dom.get('wf_upload_input');if(!input){var btn=dom.add(dom.doc.body,'div',{'id':'wf_upload_button','title':ed.getLang('upload.button_description','Click to upload a file')},'<label for="wf_upload_input">'+ed.getLang('upload.label','Upload')+'</label>');input=dom.add(btn,'input',{'type':'file','id':'wf_upload_input'});}
ed.dom.bind(marker,'mouseover',function(e){if(ed.dom.getAttrib(marker,'data-mce-selected')){return;}
var vp=ed.dom.getViewPort(ed.getWin());var p1=dom.getRect(ed.getContentAreaContainer());var p2=ed.dom.getRect(marker);var st=ed.getBody().scrollTop;if(st>p2.y+p2.h/2-25){return;}
if(st<(p2.y+p2.h/2+25)-p1.h){return;}
var x=Math.max(p2.x-vp.x,0)+p1.x;var y=Math.max(p2.y-vp.y,0)+p1.y-Math.max(st-p2.y,0);var zIndex=ed.id=='mce_fullscreen'?dom.get('mce_fullscreen_container').style.zIndex:0;dom.setStyles('wf_upload_button',{'top':y+p2.h/2-27,'left':x+p2.w/2-54,'display':'block','zIndex':zIndex+1});input.onchange=function(){if(input.files){var file=input.files[0];if(file){file.marker=marker;if(self.addFile(file)){ed.dom.addClass(marker,'loading');self.upload(file);removeUpload();}}}};});ed.dom.bind(marker,'mouseout',function(e){if(!e.relatedTarget&&e.clientY>0){return;}
removeUpload();});},_createUploadMarker:function(n){var self=this,ed=this.editor,src=n.attr('src')||'',style={},styles,cls=[];if(!n.attr('alt')&&!/data:image/.test(src)){var alt=src.substring(src.length,src.lastIndexOf('/')+1);n.attr('alt',alt);}
if(n.attr('style')){style=ed.dom.styles.parse(n.attr('style'));}
if(n.attr('hspace')){style['margin-left']=style['margin-right']=n.attr('hspace');}
if(n.attr('vspace')){style['margin-top']=style['margin-bottom']=n.attr('vspace');}
if(n.attr('align')){style.float=n.attr('align');}
if(n.attr('class')){cls=n.attr('class').replace(/\s*upload-placeholder\s*/,'').split(' ');}
cls.push('mceItemUpload');cls.push('mceItemUploadMarker');n.attr({'src':this.plugin_url+'/img/trans.gif','class':tinymce.trim(cls.join(' '))});var tmp=ed.dom.create('span',{'style':style});if(styles=ed.dom.getAttrib(tmp,'style')){n.attr({'style':styles,'data-mce-style':styles});}},buildUrl:function(url,items){var query='';each(items,function(value,name){query+=(query?'&':'')+encodeURIComponent(name)+'='+encodeURIComponent(value);});if(query){url+=(url.indexOf('?')>0?'&':'?')+query;}
return url;},addFile:function(file){var ed=this.editor,self=this,fileNames={},url;if(/\.(php|php(3|4|5)|phtml|pl|py|jsp|asp|htm|html|shtml|sh|cgi)\./i.test(file.name)){ed.windowManager.alert(ed.getLang('upload.file_extension_error','File type not supported'));return false;}
each(self.plugins,function(o,k){if(!file.upload_url){if(url=o.getUploadURL(file)){file.upload_url=url;file.uploader=o;}}});if(file.upload_url){if(tinymce.is(file.uploader.getUploadConfig,'function')){var config=file.uploader.getUploadConfig();var type=file.type.replace(/[a-z0-9]+\/([a-z0-9]{2,4})/i,'$1');type=type.toLowerCase();if(tinymce.inArray(config.filetypes,type)==-1){ed.windowManager.alert(ed.getLang('upload.file_extension_error','File type not supported'));return false;}
if(file.size){var max=parseInt(config.max_size)||1024;if(file.size>max*1024){ed.windowManager.alert(ed.getLang('upload.file_size_error','File size exceeds maximum allowed size'));return false;}}}
self.FilesAdded.dispatch(file);if(!file.marker){var w=300,h=300;ed.execCommand('mceInsertContent',false,'<img id="__mce_tmp" class="mceItemUpload" />',{skip_undo:1});if(/image\/(gif|png|jpeg|jpg)/.test(file.type)){w=h=Math.round(Math.sqrt(file.size));w=Math.max(100,w);h=Math.max(100,h);}
var n=ed.dom.get('__mce_tmp');ed.dom.setAttrib(n,'id','');n.style.width=w+"px";n.style.height=h+"px";file.marker=n;}
ed.undoManager.add();self.files.push(file);return true;}else{ed.windowManager.alert(ed.getLang('upload.file_extension_error','File type not supported'));return false;}
return false;},upload:function(file){var self=this,ed=this.editor;var args={'action':'upload','format':'raw','method':'dragdrop','component_id':ed.settings.component_id};args[ed.settings.token]='1';var url=file.upload_url;function sendFile(bin){var xhr=new XMLHttpRequest,formData=new FormData();if(xhr.upload){xhr.upload.onprogress=function(e){if(e.lengthComputable){file.loaded=Math.min(file.size,e.loaded);self.UploadProgress.dispatch(file);}};}
xhr.onreadystatechange=function(){var httpStatus;if(xhr.readyState==4&&self.state!==state.STOPPED){try{httpStatus=xhr.status;}catch(ex){httpStatus=0;}
if(httpStatus>=400){self.UploadError.dispatch({code:state.HTTP_ERROR,message:ed.getLang('upload.http_error','HTTP Error'),file:file,status:httpStatus});}else{file.loaded=file.size;self.UploadProgress.dispatch(file);bin=formData=null;file.status=state.DONE;self.FileUploaded.dispatch(file,{response:xhr.responseText,status:httpStatus});}}};var name=file.target_name||file.name;name=name.replace(/[\+\\\/\?\#%&<>"\'=\[\]\{\},;@\^\(\)£€$]/g,'');extend(args,{'name':name});xhr.open("post",url,true);each(self.settings.headers,function(value,name){xhr.setRequestHeader(name,value);});each(extend(args,self.settings.multipart_params),function(value,name){formData.append(name,value);});formData.append(self.settings.file_data_name,bin);xhr.send(formData);return;}
if(file.status==state.DONE||file.status==state.FAILED||self.state==state.STOPPED){return;}
extend(args,{name:file.target_name||file.name});sendFile(file);},getInfo:function(){return{longname:'Drag & Drop and Placeholder Upload',author:'Ryan Demmer',authorurl:'http://www.joomlacontenteditor.net',infourl:'http://www.joomlacontenteditor.net',version:'2.4.3'};}});tinymce.PluginManager.add('upload',tinymce.plugins.Upload);})();