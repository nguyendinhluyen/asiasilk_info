<!--BEGINLIST_SCRIPT-->
<!--BEGIN_SCRIPT-->
<script language=Javascript src="../jscript/overlib_mini.js"></script>
<!--END_SCRIPT-->
<!--ENDLIST_SCRIPT-->
<form method='POST' enctype='multipart/form-data' id = "frm" name = "frm">
<div class = "title" style ="text-indent:10px">{newsmanager}</div>
	<div>{lag_page} : {page}</div>
	<div style = "float:left">
			<div class = "title" style = 'width:851px'>
				<div class = "con_title" style = "width:50px;text-align:center"><input style ='margin-left:3px' type="checkbox" name="chkall" onclick="chkallClick(this);"></div>
				<div class = "con_title" style = "width:50px">{lag_delete}</div>
				<div class = "con_title" style = "width:50px">{lag_edit}</div>
				<div class = "con_title" style = "width:200px"><a href = './?show=newsList&order=name&p={p}'>{title}</a></div>
				<div class = "con_title" style = "width:90px">{image}</div>
				<div class = "con_title" style = "width:120px"><a href = './?show=newsList&order=status&p={p}'>{lag_status}</a></div>
				<div class = "con_title" style = "width:140px;border:0px"><a href = './?show=newsList&order=dateadd&p={p}'>{lag_date_create}</a></div>
				<div class = "con_title" style = "width:150px;border:0px"><a href = './?show=newsList&order=datemodifiled&p={p}'>{lag_date_modifiled}</a></div>
			</div>
			<div>
		<!--BEGINLIST_NEWS-->
		<!--BEGIN_NEWS-->
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;text-align:center"><input style ='margin-top:8px' type="checkbox" name="chk[]" value="{id}"></div>
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;"><a href="?show=newsList&action=del&id={id}&p={p}&order={oderby}" onclick="return confirm('{del_confirm} ?');">{lag_delete}</a></div>
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;"><a href="?show=OptNews&id={id}&p={p}&order={oderby}">{lag_edit}</a></div>
				<div class = "con_list_con" style = "width:200px;background-color:{color};height:30px;">{news_name}</div>
				<div class = "con_list_con" style = "width:90px;background-color:{color};height:30px;">{news_image}</div>
				<div class = "con_list_con" style = "width:120px;background-color:{color};height:30px">{status}</div>
				<div class = "con_list_con" style = "width:140px;border:0px;background-color:{color};height:30px">{date_added}</div>
				<div class = "con_list_con" style = "width:150px;border:0px;background-color:{color};height:30px">{last_modified}</div>
				<div class ='clear'></div>
		<!--END_NEWS-->
		<!--ENDLIST_NEWS-->
			</div>
	</div>
	<input class = "button" type = "submit" name = "btndel" value = "{delete_check}" onclick="return chkdelete('{del_confirm}');">
	<input class = "button" type = "button" value = "{addnews}" onclick="window.location='./?show=OptNews'">
	<input style="display:none" class = "button" type = "submit" value = "Tin tức hot" name ="btnNewswait">
    <input class = "button" type = "submit" name = "btnStatus" value = "{shi}" onclick = "return chkselected();">
</form>
<div id=overDiv style="z-index: 1000; visibility: hidden; position: absolute; top: 586px" align=center></div>