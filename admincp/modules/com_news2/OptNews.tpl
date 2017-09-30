<!--BEGINLIST_SCRIPT-->
<!--BEGIN_SCRIPT-->
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>   
<script type="text/javascript" src="../jscript/common.js"></script>   
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	entity_encoding : "raw",
	editor_selector : "mceEditor",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	theme_advanced_buttons1 : "justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,code",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,insertdate,inserttime,preview",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,charmap,emotions,iespell,media,advhr",
	theme_advanced_buttons5 : "save,newdocument,|,bold,italic,underline,strikethrough,|,ltr,rtl,|,fullscreen,|,print,|,forecolor,backcolor",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	 template_external_list_url : "example_template_list.js",
	 file_browser_callback : "tinyBrowser"
});
</script>
<script type="text/javascript">
    function tinyBrowser (field_name, url, type, win) {

       /* If you work with sessions in PHP and your client doesn't accept cookies you might need to carry
          the session name and session ID in the request string (can look like this: "?PHPSESSID=88p0n70s9dsknra96qhuk6etm5").
          These lines of code extract the necessary parameters and add them back to the filebrowser URL again. */

       var cmsURL = "../tiny_mce/plugins/tinybrowser/tinybrowser.php";    // script URL - use an absolute path!
       if (cmsURL.indexOf("?") < 0) {
           //add the type as the only query parameter
           cmsURL = cmsURL + "?type=" + type;
       }
       else {
           //add the type as an additional query parameter
           // (PHP session ID is now included if there is one at all)
           cmsURL = cmsURL + "&type=" + type;
       }

       tinyMCE.activeEditor.windowManager.open({
           file : cmsURL,
           title : 'My File Browser',
           width : 650, 
           height : 440,
           resizable : "yes",
           scrollbars : "yes",
           inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
           close_previous : "no"
       }, {
           window : win,
           input : field_name
       });
       return false;
     }
   </script>
<!--END_SCRIPT-->
<!--ENDLIST_SCRIPT-->
<div class = "title">{panel_add_update_product}</div>
<div class = "content_con">
	<form method='POST' enctype='multipart/form-data' id = "frm" name = "frm">
	<div style ="float:left;width:150px">
			<p style = 'margin-left:65px;font-weight:bold'>{image}</p>
			<p style = "margin-left:45px">{ImgThumb} {ImgDel} <a href = '#' onclick = "javascript:history.back(1)"><img src='../style/images/back.gif'></a></p>
			<div class = "img_show" style = "width:135px">
			<img src='{imagesrc}' width='130px'/>
			</div>
	</div>

	<div style="float:left;padding-left:25px">
	<div style ="margin-left:95px;">{error}</div>
		<p><label><b>{news_title}</b></label><input size ='50' maxlength = '50' type = 'text' name = 'txtname' value ='{txtname}'>
		</p>
		
		<p>
			<label>{image}</label><input size ='50' name = 'image' type ="file" />
		</p>

		<p>
			<label>{source}</label><input size ='50' type = 'text' name = 'txtsource' id="source" value ='{txtsource}'/>
		</p>
		
		<p>
			<label>{product_of_catalogue}</label>{cat_list}
		</p>
		<p>
			<label>{decription}</label><textarea name = "decription" cols = "67" rows = "5">{txtdecripton}</textarea>

		</p>
		<p>
		
			<label>{news_detail}</label><textarea class="mceEditor" name = "detail" cols = "67" rows = "15">{txtdetail}</textarea>
		</p>
		
		<p>
			<label>&nbsp;</label><input class = "button" type = "submit" name = "btnadd" value = "{btn}"/>
			<input class = "button" type = "reset" value = "{reset}"/>
		</p>
		<br/>
	</div>
	</form>
</div>