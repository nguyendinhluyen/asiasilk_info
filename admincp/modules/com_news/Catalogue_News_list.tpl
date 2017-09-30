<form method='POST' enctype='multipart/form-data' id = "frm" name = "frm">
<div class = "title" style ="text-indent:10px">Danh mục tin tức</div>
	<div>{lag_page} : {page}</div>
	<div style = "float:left">
			<div class = "title" style = 'width:851px'>
				<div class = "con_title" style = "width:50px;text-align:center"><input style ='margin-left:3px' type="checkbox" name="chkall" onclick="chkallClick(this);"></div>
				<div class = "con_title" style = "width:50px">{lag_delete}</div>
				<div class = "con_title" style = "width:50px">{lag_edit}</div>
				<div class = "con_title" style = "width:250px">Tên chuyên mục</div> 
				<div class = "con_title" style = "width:100px">Sắp xếp</div>
				<div class = "con_title" style = "width:100px">Trạng thái</div>
				<div class = "con_title" style = "width:125px">Ngày tạo</div>
				<div class = "con_title" style = "width:125px">Lần sửa cuối</div>
			</div>
			<div>
		<!--BEGINLIST_CATSNEWS-->
		<!--BEGIN_CATSNEWS-->
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;text-align:center"><input style ='margin-top:8px' type="checkbox" name="chk[]" value="{categories_id}"></div>
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;"><a href="./?show=CatalogueNewsList&action=del&id={categories_id}&p={p}" onclick="return confirm('{del_confirm} ?');">{lag_delete}</a></div>
				<div class = "con_list_con" style = "width:50px;background-color:{color};height:30px;"><a href="./?show=CatalogueNewsOpt&id={categories_id}&p={p}">{lag_edit}</a></div>
				<div class = "con_list_con" style = "width:250px;background-color:{color};height:30px;">{categories_name}</div>
				<div class = "con_list_con" style = "width:100px;background-color:{color};height:30px;">{categories_order}</div>
				<div class = "con_list_con" style = "width:100px;background-color:{color};height:30px;">{categories_status}</div>
				<div class = "con_list_con" style = "width:125px;background-color:{color};height:30px">{categories_date_added}</div>
				<div class = "con_list_con" style = "width:125px;background-color:{color};height:30px">{categories_modified_date}</div>

				<div class ='clear'></div>
		<!--END_CATSNEWS-->
		<!--ENDLIST_CATSNEWS-->
			</div>
	</div>
	<input class = "button" type = "submit" name = "btndel" value = "{delete_check}" onclick="return confirm('{del_confirm}?');">
                <input class = "button" type = "submit" name = "btnstatus" value = "Ẩn/hiện" onclick = "return chkselected();">
	<input class = "button" type = "button" value = "Thêm mới" onclick="window.location='./?show=CatalogueNewsOpt'">
</form>
