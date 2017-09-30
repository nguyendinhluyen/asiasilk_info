<!--BEGINLIST_SCRIPT-->
<!--BEGIN_SCRIPT-->
<script type="text/javascript" src="../jscript/common.js"></script>   
<!--END_SCRIPT-->
<!--ENDLIST_SCRIPT-->
<div class = "title">{panel_add_update_product}</div>
<div class = "content_con">
<pre id="invdetail" name="invdetail" style="display:none">
{txtdetail}
</pre>
	<form method='POST' enctype='multipart/form-data' id = "frm" name = "frm" onsubmit="submitForm2()">
    	<input type="hidden" name="txtdetail" id="txtdetail">
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
		<p><label><b>Keywords</b></label><input size ='50' type = 'text' name = 'keywords' value ='{keywords}'>
		</p>
		<p><label><b>Description</b></label><input size ='50' type = 'text' name = 'description' value ='{description}'>
		</p>
        <p><label>Mô tả ngắn</label><textarea name="news_shortcontent" cols="60" rows="5">{news_shortcontent}</textarea>
		</p>
        
        
        
        
		<p>
		
			<label>{news_detail}</label>
			<script>
		var oEdit1 = new InnovaEditor("oEdit1");		
		oEdit1.arrStyle = [["BODY",false,"","font:12px verdana,arial,sans-serif;"]];
		
		oEdit1.width="660";
		oEdit1.height=300;
		oEdit1.features=["FullScreen","Search",
			"Cut","Copy","Paste","PasteWord","PasteText","|","Undo","Redo","|",
			"ForeColor","BackColor","|","Bookmark","Hyperlink",
			"CustomTag","HTMLSource","BRK","Numbering","Bullets","|","Indent","Outdent","LTR","RTL","|","Image","Flash","Media","|","InternalLink","CustomObject","|",
			"Table","Guidelines","Absolute","|","Characters","Line",
			"Form","Clean","ClearAll","BRK",
			"StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting",
			"ParagraphFormatting","CssText","Styles","|",
			"Paragraph","FontName","FontSize","|",
			"Bold","Italic",
			"Underline","Strikethrough","|","Superscript","Subscript","|",
			"JustifyLeft","JustifyCenter","JustifyRight","JustifyFull"];

		//oEdit1.cmdAssetManager="modalDialogShow('/Editor/assetmanager/assetmanager.php',640,465)";
		oEdit1.cmdAssetManager="modalDialogShow('../assetmanager/assetmanager.php',640,465)";
		oEdit1.RENDER(document.getElementById("invdetail").innerHTML);
</script>
		</p>
		
		<p>
			<label>&nbsp;</label><input class = "button" type = "submit" name = "btnadd" value = "{btn}"/>
			<input class = "button" type = "reset" value = "{reset}"/>
		</p>
		<br/>
	</div>
	</form>
</div>