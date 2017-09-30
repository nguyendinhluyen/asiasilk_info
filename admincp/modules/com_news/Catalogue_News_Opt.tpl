<div class = "title">Thêm danh mục tin tức</div>
<div class = "content_con">
	<form method='POST' enctype='multipart/form-data' id = "frm" name = "frm">
	<div class = "img_show">
		<img src='../style/images/cat.png' width='60px'/>
	</div>
	<div style="float:left;padding-left:20px">
	<div class ='err'>{error}</div>
		<p>
			<label>Tên danh mục</label><input type = 'text' name = 'txtname' class ='fieldinput' value ='{txtname}'>
		</p>
		<p>
			<label><b>Sắp xếp</b></label><input type = 'text' name = 'txtorder' class ='fieldinput' value ='{txtorder}'>
		</p>
		
			<p>
			<label>&nbsp;</label><input class = "button" type = "submit" name = "btnadd" value = "Save"/>
			<input class = "button" type = "reset" value = "Reset"/>
		</p>
		<br/>
	</div>
	</form>
</div>