<?php

function selectRow($f, $table, $where) {

	global $mysql;

	$sql = "select " . $f . " from " . $table . ' where ' . $where;

	$mysql->setQuery($sql);

	$mysql->query();

	return $mysql->loadAllRow();

}

function deleteRow($table, $where) {

	global $mysql;

	$sql = "delete from " . $table . ' where ' . $where;

	$mysql->setQuery($sql);

	$mysql->query();

}

function deleteImg($path, $arr_img, $f) {

	for ($i = 0; $i < count($arr_img); ++$i) {

		if (file_exists($path . $arr_img[$i][$f])) {

			@unlink($path . $arr_img[$i][$f]);
		}
	}
}

function countRow($f, $table, $where) {

	global $mysql;

	$sql = "select " . $f . " from " . $table . ' where ' . $where;

	$mysql->setQuery($sql);

	$mysql->query();

	return $mysql->getNumRows();

}

function getGroup($id, $width = 200) {

	global $mysql;

	$select = "<select name='group' style='width:" . $width . "px'>";

	$mysql->setQuery("select group_id,group_name from user_group");

	$result = $mysql->query();

	while ($row = mysql_fetch_assoc($result)) {

		if ($id == $row['group_id']) {

			$select .= "<option value='" . $row['group_id'] . "' selected>"

					. $row['group_name'] . "</option>";

		} else {

			$select .= "<option value='" . $row['group_id'] . "'>"

					. $row['group_name'] . "</option>";

		}

	}

	$select .= "</select>";

	return $select;

}

//kiá»ƒm tra catalogue cÃ³ tá»“n táº¡i hay khÃ´ng

function check_cats_name($catname, $id, $parent_id) {

	return checkExit('categories_id', 'categories',

			"categories_name = '" . $catname . "' and parent_id='" . $parent_id

					. "' and language ='" . $_SESSION['lag']

					. "' and categories_id<>" . $id);

}

//kiá»ƒm tra catalogue tin tá»©c cÃ³ tá»“n táº¡i hay khÃ´ng

function check_cats_name_news($catname, $id) {

	return checkExit('categories_id', 'news_catalogue',

			"categories_name = '" . $catname . "' and language ='"

					. $_SESSION['lag'] . "' and categories_id<>" . $id);

}

//kiá»…m tra id website

function check_id_website($id) {

	return checkExit('id', 'website', "id = '" . $id . "'");

}

//kiá»ƒm tra id cÃ³ trong CSDL khÃ´ng

function check_valid($id)//check id invalid on data or valid

 {

	return checkExit('categories_id', 'categories',

			"categories_id = '" . $id . "' and language ='" . $_SESSION['lag']

					. "'");

}

function check_id_user($id)//check id invalid on data or valid

 {

	return checkExit('id', 'user', "id = '" . $id . "'");

}

function check_valid_cats_news($id)//check id invalid on data or valid

 {

	return checkExit('categories_id', 'news_catalogue',

			"categories_id = '" . $id . "' and language ='" . $_SESSION['lag']

					. "'");

}

function check_id_product($id)//check id invalid on data or valid

 {

	return checkExit('products_id', 'products',

			"products_id  = '" . $id . "' and language ='" . $_SESSION['lag']

					. "'");

}

function check_id_news($id)//check id invalid on data or valid

 {

	return checkExit('news_id', 'news',

			"news_id  = '" . $id . "' and language ='" . $_SESSION['lag'] . "'");

}

function check_id_provider($id) {

	return checkExit('providers_id', 'support', 'providers_id = ' . $id);

}

function check_id_content($id) {

	return checkExit('content_id', 'contents',

			"content_id = '" . $id . "' and language ='" . $_SESSION['lag']

					. "'");

}

function getLevel($id) {

	global $mysql;

	$mysql

			->setQuery(

					"select level from categories where categories_id='" . $id

							. "'");

	$mysql->query();

	$row = $mysql->loadOneRow();

	return $row['level'];

}

function checkuser($username, $id) {

	return checkExit('username', 'user',

			"id <>'" . $id . "' and username ='" . $username . "'");

}

function check_id_game($id) {

	return checkExit('adver_id', 'game', 'adver_id = ' . $id);

}

function check_id_adver($id) {

	return checkExit('adver_id', 'adver', 'adver_id = ' . $id);

}

function check_id_adver2($id) {

	return checkExit('adver_id', 'ads', 'adver_id = ' . $id);

}

function listpost($id = '') {

	$arr_pos = array('1' => 'BÃªn trÃ¡i', '2' => 'BÃªn pháº£i');

	if (!empty($id)) {

		return $arr_pos[$id];

	} else

		return $arr_pos;

}

function catalogue_pos($id) {

	$arr_pos = listpost();

	$select = "<select name ='pos'>";

	$n = count($arr_pos);

	for ($i = 1; $i <= $n; ++$i) {

		if ($id == $i) {

			$select .= "<option value='" . $i . "' selected>" . $arr_pos[$i]

					. "</option>";

		} else {

			$select .= "<option value='" . $i . "'>" . $arr_pos[$i]

					. "</option>";

		}

	}

	$select .= "</select>";

	return $select;

}



function catlist($id) 
{
	global $mysql;

	$sql = "select categories_id,categories_name from categories where level = 1 and language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select name = 'catlist' id = 'catlist'>";

	while ($row = mysql_fetch_assoc($result)) {

		$sql2 = "select categories_id,categories_name from categories where level = 2 and parent_id ='"

				. $row['categories_id'] . "' and language = '"

				. $_SESSION['lag'] . "'";

		$mysql->setQuery($sql2);

		$result2 = $mysql->query();

		if (mysql_num_rows($result2) > 0) {

			$select .= "<optgroup label='" . $row['categories_name'] . "'>";

			while ($row2 = mysql_fetch_assoc($result2)) {

				if ($id == $row2['categories_id'])

					$select .= "<option value ='" . $row2['categories_id']

							. "' selected>" . $row2['categories_name']

							. "</option>";

				else

					$select .= "<option value ='" . $row2['categories_id']

							. "'>" . $row2['categories_name'] . "</option>";

			}

			$select .= "</optgroup>";

		} else {

			if ($id == $row['categories_id'])

				$select .= "<option value ='" . $row['categories_id']

						. "' selected>" . $row['categories_name'] . "</option>";

			else

				$select .= "<option value ='" . $row['categories_id'] . "'>"

						. $row['categories_name'] . "</option>";
		}

	}

	$select .= '</select>';		
	
	return $select;	

}

//Vị trí thêm
function commoditylist($id)
{	
	$select  = '<select name="commoditylist" id="commoditylist">';
	// Co hang
	if($id == 0)
	{
		$select .= '<option value = "0" selected="selected"> Còn Hàng </option>'; 	
		$select .= '<option value = "1"> Hết Hàng </option>';
		$select .= '<option value = "2"> Sắp Có Hàng </option>';
		$select .= '<option value = "4"> Đặt Trước </option>';
		$select .= '</select>';	           	
	}
	
	// Tam thoi het hang	
	else if($id == 1)
	{
		$select .= '<option value = "0"> Còn Hàng </option>'; 	
		$select .= '<option value = "1" selected="selected"> Hết Hàng </option>'; 
		$select .= '<option value = "2"> Sắp Có Hàng </option>';
		$select .= '<option value = "4"> Đặt Trước </option>';	
		$select .= '</select>';	           			
	}
	
	// Sap co hang
	else if($id ==2)
	{
		$select .= '<option value = "0"> Còn Hàng </option>'; 	
		$select .= '<option value = "1"> Hết Hàng </option>'; 
		$select .= '<option value = "2" selected="selected"> Sắp Có Hàng </option>';
		$select .= '<option value = "4"> Đặt Trước </option>';	
		$select .= '</select>';	           	
	}		
	
	//Dat hang truoc
	else if($id ==4)
	{
		$select .= '<option value = "0"> Còn Hàng </option>'; 	
		$select .= '<option value = "1"> Hết Hàng </option>'; 
		$select .= '<option value = "2"> Sắp Có Hàng </option>';
		$select .= '<option value = "4" selected = "selected"> Đặt Trước </option>';	
		$select .= '</select>';	           			
	}
	
	//Con lai mac dinh co hang
	else
	{
		$select .= '<option value = "0" selected="selected"> Còn Hàng </option>'; 	
		$select .= '<option value = "1"> Hết Hàng </option>'; 
		$select .= '<option value = "2"> Sắp Có Hàng </option>';
		$select .= '<option value = "4"> Đặt Trước </option>';	
		$select .= '</select>';	           	
	}
	return $select;
}

//VI TRI THEM
function helplist($id)
{	
	//CHON TAT CA CAC MUC CHUA DUOC HIEN THI	
	
	// Chinh sua Dich vu van chuyen
	if($id == 0)
	{
		$sql = "SELECT idKindHelp, nameKindHelp, flag 
				FROM KindHelp 
				WHERE flag = 0 or idKindHelp = 30";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{				
			if($row['idKindHelp'] != 30)
				$select .= '<option value ="'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			
			else if($row['idKindHelp'] == 30)
				$select .= '<option value ="'.$row['idKindHelp'].'"selected'.'>'.$row['nameKindHelp'].'</option>'; 			
		}	
	}
	
	// Chinh sua Cach thuc thanh toan
	else if ($id == 1)
	{
		$sql = "SELECT idKindHelp, nameKindHelp, flag 
				FROM KindHelp 
				WHERE flag = 0 or idKindHelp = 31";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{							
			if($row['idKindHelp'] != 31)
				$select .= '<option value ="'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			

			else if($row['idKindHelp'] == 31)
				$select .= '<option value ="'.$row['idKindHelp'].'"selected>'.$row['nameKindHelp'].'</option>'; 			
		}	
	}
	
	// Chinh sua Cau hoi thuong gap
	else if ($id == 2)
	{
		$sql = "select idKindHelp, nameKindHelp, flag from KindHelp where flag = 0 or idKindHelp = 32";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{				
			if($row['idKindHelp'] != 32)
				$select .= '<option value ="'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			
			else if($row['idKindHelp'] == 32)
				$select .= '<option value ="'.$row['idKindHelp'].'"selected>'.$row['nameKindHelp'].'</option>'; 		
		}	
	}
	
	// Chinh sua Huong dan mua hang
	else if ($id == 3)
	{
		$sql = "select idKindHelp, nameKindHelp, flag from KindHelp where flag = 0 or idKindHelp = 33";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{				
			if($row['idKindHelp'] != 33)
				$select .= '<option value ="'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			
			else if($row['idKindHelp'] == 33)
				$select .= '<option value ="'.$row['idKindHelp'].'"selected>'.$row['nameKindHelp'].'</option>'; 		
		}	
	}

	else if ($id == 4)
	{
		$sql = "select idKindHelp, nameKindHelp, flag from KindHelp where flag = 0 or idKindHelp = 34";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{				
			if($row['idKindHelp'] != 34)
				$select .= '<option value ="'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			
			else if($row['idKindHelp'] == 34)
				$select .= '<option value ="'.$row['idKindHelp'].'"selected>'.$row['nameKindHelp'].'</option>'; 		
		}	
	}	
	
	//SU DUNG KHI ADD TIN TUC
	else
	{
		$sql = "select idKindHelp, nameKindHelp, flag from KindHelp where flag = 0 or idKindHelp= 34 order by idKindHelp DESC";	
	
		global $mysql;	
	
		$mysql->setQuery($sql);
	
		$result = $mysql->query();	
					
		$select  = '<select name="helplist" id="helplist" onchange="display()">';

		while ($row = mysql_fetch_assoc($result))
		{				
			$select .= '<option value = "'.$row['idKindHelp'].'">'.$row['nameKindHelp'].'</option>'; 			
		}	
	}
	$select .= '</select>';	           		
	return $select;
}


function catlist_web($id) 
{

	global $mysql;

	$sql = "select categories_id,categories_name from categories where categories_id=201 and language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select name = 'catlist' id = 'catlist'>";

	while ($row = mysql_fetch_assoc($result)) {

		$select .= "<optgroup label='" . $row['categories_name'] . "'>";

		$sql2 = "select categories_id,categories_name from categories where parent_id ='"

				. $row['categories_id'] . "' and language = '"

				. $_SESSION['lag'] . "'";

		$mysql->setQuery($sql2);

		$result2 = $mysql->query();

		while ($row2 = mysql_fetch_assoc($result2)) {

			if ($id == $row2['categories_id'])

				$select .= "<option value ='" . $row2['categories_id']

						. "' selected>" . $row2['categories_name']

						. "</option>";

			else

				$select .= "<option value ='" . $row2['categories_id'] . "'>"

						. $row2['categories_name'] . "</option>";

		}

		$select .= "</optgroup>";

	}

	$select .= '</select>';

	return $select;

}

function catlist_ads($id) {

	global $mysql;

	$sql = "select categories_id,categories_name from categories where level = 1 and language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select name = 'catlist' id = 'catlist'>";

	if ($id == 0) {

		$select .= "<option value ='1-0' selected>Trang chá»§</option>";

	} else {

		$select .= "<option value ='1-0'>Trang chá»§</option>";

	}

	while ($row = mysql_fetch_assoc($result)) {

		$select .= "<optgroup label='" . $row['categories_name'] . "'>";

		$sql2 = "select categories_id,categories_name from categories where level = 2 and parent_id ='"

				. $row['categories_id'] . "' and language = '"

				. $_SESSION['lag'] . "'";

		$mysql->setQuery($sql2);

		$result2 = $mysql->query();

		while ($row2 = mysql_fetch_assoc($result2)) {

			if ($id == $row2['categories_id'])

				$select .= "<option value ='" . $row2['categories_id']

						. "-1' selected>===" . $row2['categories_name']

						. "</option>";

			else

				$select .= "<option value ='" . $row2['categories_id']

						. "-1'>===" . $row2['categories_name'] . "</option>";

		}

		$select .= "</optgroup>";

	}

	$select .= '</select>';

	return $select;

}

function LoadAllCatalogue($id) {

	$catlist = "<select name ='catlist'>";

	global $mysql;

	$sql = "Select categories_id,categories_name from categories where language ='"

			. $_SESSION['lag'] . "' and parent_id =0";

	$mysql->setQuery($sql);

	$row = $mysql->loadAllRow();



	$sql = "Select parent_id,categories_id,categories_name from categories where language ='"

			. $_SESSION['lag'] . "' and parent_id <>0";

	$mysql->setQuery($sql);

	$parent = $mysql->loadAllRow();



	$n = count($row);

	$m = count($parent);

	for ($i = 0; $i < $n; ++$i) {

		if ($id == $row[$i]['categories_id']) {

			$catlist .= "<option value = '" . $row[$i]['categories_id']

					. "' selected>" . $row[$i]['categories_name'] . "</option>";

		} else {

			$catlist .= "<option value = '" . $row[$i]['categories_id'] . "'>"

					. $row[$i]['categories_name'] . "</option>";

		}



		for ($j = 0; $j < $m; ++$j) {

			if ($row[$i]['categories_id'] == $parent[$j]['parent_id']) {

				if ($id == $parent[$j]['categories_id']) {

					$catlist .= "<option value = '"

							. $parent[$j]['categories_id']

							. "' selected>======"

							. $parent[$j]['categories_name'] . "</option>";

				} else {

					$catlist .= "<option value = '"

							. $parent[$j]['categories_id'] . "'>======"

							. $parent[$j]['categories_name'] . "</option>";



				}

			}

		}

	}

	$catlist .= '</select>';

	return $catlist;



}

function cat_news_list($id) {

	$catlist = "<select name ='catlist'>";

	global $mysql;

	$sql = "SELECT categories_id,categories_name 
			FROM news_catalogue 
			WHERE language ='". $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$row = $mysql->loadAllRow();

	$n = count($row);

	for ($i = 0; $i < $n; ++$i) {

		if ($id == $row[$i]['categories_id'])
		{
			$catlist .= "<option value = '" . $row[$i]['categories_id']

					. "' selected>" . $row[$i]['categories_name'] . "</option>";
		}
		else
		{
			$catlist .= "<option value = '" . $row[$i]['categories_id'] . "'>"

					. $row[$i]['categories_name'] . '</option>';
		}

	}

	$catlist .= '</select>';

	return $catlist;

}

function get_total_product($id) {

	return countRow('products_id', 'products', "categories_id =" . intval($id));

}



function dl_subcats($id = '', $width = 100) {

	global $mysql;

	$sql = "select categories_id,categories_name from categories where level = 1 and language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select name = 'dl_subcats' id = 'dl_subcats' style = 'width:"

			. $width . "'>";

	$select .="<option value = '0'>-- Danh mục gốc --</option>";

	while ($row = mysql_fetch_assoc($result)) {

		if ($id == $row['categories_id'])

			$select .= "<option value ='" . $row['categories_id']

					. "' selected>" . $row['categories_name'] . "</option>";

		else

			$select .= "<option value ='" . $row['categories_id'] . "'>"

					. $row['categories_name'] . "</option>";



		$sql2 = "select categories_id,categories_name from categories where level = 2 and parent_id ='"

				. $row['categories_id'] . "' and language = '"

				. $_SESSION['lag'] . "'";

		$mysql->setQuery($sql2);

		$result2 = $mysql->query();

		while ($row2 = mysql_fetch_assoc($result2)) {

			if ($id == $row2['categories_id'])

				$select .= "<option value ='" . $row2['categories_id']

						. "' selected>===" . $row2['categories_name']

						. "</option>";

			else

				$select .= "<option value ='" . $row2['categories_id']

						. "'>===" . $row2['categories_name'] . "</option>";

		}

	}

	$select .= '</select>';

	return $select;

}

function get_parent_name($id) {

	global $mysql;

	$sql = "select categories_name from categories where categories_id = "

			. intval($id);

	$mysql->setQuery($sql);

	$mysql->query();

	if ($mysql->getNumRows() > 0) {

		$row = $mysql->loadOneRow();

		return $row['categories_name'];

	} else {

		return 0;

	}

}

function get_cats_name($id) {

	global $mysql;

	$sql = "select categories_name from categories where categories_id = '"

			. intval($id) . "'";

	$mysql->setQuery($sql);

	$mysql->query();

	$arr = $mysql->loadOneRow();

	return $arr['categories_name'];

}

function get_catsnews_name($id) {

	global $mysql;

	$sql = "select categories_name from news_catalogue where categories_id = '"

			. intval($id) . "'";

	$mysql->setQuery($sql);

	$mysql->query();

	$arr = $mysql->loadOneRow();

	return $arr['categories_name'];

}

//xÃ³a hÃ¬nh sáº£n pháº©m 

function delete_img($arr_id, $template = '') {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select products_image from products where products_id in ("

				. $arr_id . ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		if ($result) {

			while ($row = mysql_fetch_assoc($result)) {

				$img = $row['products_image'];

				if (file_exists(_UPLOAD_IMG . $img)) {

					@unlink(_UPLOAD_IMG . $img);

				}

				if (file_exists(_UPLOAD_IMG_THUMB . $img)) {

					@unlink(_UPLOAD_IMG_THUMB . $img);

				}

			}

		}

	}

}

function delete_img_webiste($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select image from website where id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		if ($result) {

			while ($row = mysql_fetch_assoc($result)) {

				$img = $row['image'];

				if (file_exists(_UPLOAD_WEBSITE . $img)) {

					@unlink(_UPLOAD_WEBSITE . $img);

				}

				if (file_exists(_UPLOAD_THUMB_WEBSITE . $img)) {

					@unlink(_UPLOAD_THUMB_WEBSITE . $img);

				}

			}

		}

	}

}

//xÃ³a sáº£n pháº©m

function delete_product($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		//$sql = "delete from user_comment where product_id in(" . $arr_id . ")";

		//$mysql->setQuery($sql);

		//$mysql->query();

		$sql = "delete from guest_comment where product_id in(" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

		$sql = "delete from products where products_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}



//xÃ³a hÃ¬nh tin tá»©c 

function delete_img_news($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select news_image from news where news_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		if ($result) {

			while ($row = mysql_fetch_assoc($result)) {

				$img = $row['news_image'];

				if (file_exists(_UPLOAD_IMG_NEWS . $img)) {

					@unlink(_UPLOAD_IMG_NEWS . $img);

				}

				if (file_exists(_UPLOAD_IMG_NEWS_THUMB . $img)) {

					@unlink(_UPLOAD_IMG_NEWS_THUMB . $img);

				}

			}

		}

	}

}

//xÃ³a tin tá»©c

function delete_news($arr_id) {

	global $mysql;

	if (!empty($arr_id)) 
	{			
		//	VI TRI THEM
		//  Kiem tra tin thuoc loai nao de xoa trong ban KindHelp
				
		$sql = "Select news_name,news_image,news_catalogue,news_source,news_shortcontent,news_content from news where news_id ='". $arr_id."'";
		
		$mysql -> setQuery($sql);

		$row = $mysql ->loadOneRow();

		$catalogue = $row['news_catalogue'];
		
		if($catalogue == 30 || $catalogue == 31 || $catalogue == 32 || $catalogue == 33 )
		{
			$sqlKindHelp = "update KindHelp set flag = 0 where idKindHelp = '".$catalogue."'";				
					
			$mysql -> setQuery($sqlKindHelp);

			$mysql -> query();
		}
		///////////////////////////////////////////////////////////////////////				
						
		
		$sql = "delete from news where news_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

//xÃ³a hÃ¬nh tin tá»©c tá»« catalogue

function delete_img_news_in_cats($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select news_image from news where news_catalogue in ("

				. $arr_id . ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		if ($result) {

			while ($row = mysql_fetch_assoc($result)) {

				$img = $row['news_image'];

				if (file_exists(_UPLOAD_IMG_NEWS . $img)) {

					@unlink(_UPLOAD_IMG_NEWS . $img);

				}

				if (file_exists(_UPLOAD_IMG_NEWS_THUMB . $img)) {

					@unlink(_UPLOAD_IMG_NEWS_THUMB . $img);

				}

			}

		}

	}

}

//xÃ³a tin tá»©c  tá»« catalogue

function delete_news_in_cats($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "delete from news where news_catalogue in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

function Set_status_news($arr_id) {

	SetStatus('news_id', 'status', 'news', 'news_id in (' . $arr_id . ')');

}

function Set_status_cats_news($arr_id) {

	SetStatus('categories_id', 'categories_status', 'news_catalogue',

			'categories_id in (' . $arr_id . ')');

}

function Set_status_support($arr_id) {

	SetStatus('providers_id', 'providers_status', 'support',

			'providers_id in (' . $arr_id . ')');

}

function Set_status_catalogue($arr_id) {

	SetStatus('categories_id', 'categories_status', 'categories',

			'categories_id in (' . $arr_id . ')');

}

function Set_status_product($arr_id) {

	SetStatus('products_id', 'products_status', 'products',

			'products_id in (' . $arr_id . ')');

}

function SetStatus($id, $status, $table, $where) 
{
	global $mysql;

	if (!empty($id)) 
	{

		$sql = "select " . $id . "," . $status . " from " . $table . " where "

				. $where;

		$mysql->setQuery($sql);

		$result = $mysql->query();

		$row = $mysql->loadAllRow();

		$n = count($row);

		for ($i = 0; $i < $n; ++$i) {

			if ($row[$i][$status] == '0') {

				$sql = "update " . $table . " set " . $status . " = 1 where "

						. $id . " ='" . $row[$i][$id] . "'";

			} else {

				$sql = "update " . $table . " set " . $status . " = 0 where "

						. $id . " ='" . $row[$i][$id] . "'";

			}

			$mysql->setQuery($sql);

			$mysql->query();

		}

	}

}

function Set_news_waitting($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "update news set news_wait=1 where news_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

function delete_product_in_cat($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "delete from products where categories_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

function delete_productImg_in_cat($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select products_image from products where categories_id in ("

				. $arr_id . ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		if ($result) {

			while ($row = mysql_fetch_assoc($result)) {

				$img = $row['products_image'];

				if (file_exists(_UPLOAD_IMG . $img)) {

					@unlink(_UPLOAD_IMG . $img);

				}

				if (file_exists(_UPLOAD_IMG_THUMB . $img)) {

					@unlink(_UPLOAD_IMG_THUMB . $img);

				}

			}

		}

	}

}

//xÃ³a danh má»¥c 

function delete_cats($arr_id) {

	global $mysql;

	/*

	if(!empty($arr_id)){

	//láº¥y ra catalogue_id Ä‘á»ƒ xÃ³a sáº£n pháº©m

	$sql = "select categories_id from categories where parent_id in (".$arr_id.")";

	$mysql -> setQuery($sql);

	$result = $mysql -> query();

	$arr_cats_id = array();

	while($row = mysql_fetch_assoc($result))

	{

	    $arr_cats_id[$row['categories_id']] = $row['categories_id'];

	}

	$arr_cats_id = implode($arr_cats_id,',');

	 */

	//xÃ³a danh má»¥c gá»‘c

	global $mysql;

	$sql = 'delete from categories where categories_id in (' . $arr_id . ')';

	$mysql->setQuery($sql);

	$mysql->query();

	/*

	//xÃ³a danh má»¥c con

	$sql = 'delete from categories where parent_id in ('.$arr_id.')';

	$mysql->setQuery($sql);

	$mysql->query();

	//xÃ³a hÃ¬nh sáº£n pháº©m thuá»™c danh má»¥c

	delete_productImg_in_cat($arr_cats_id);

	//xÃ³a sáº£n pháº©m thuá»™c danh má»¥c

	delete_product_in_cat($arr_cats_id);

	}

	 */

}

///end



//xÃ³a danh má»¥c TIN Tá»¨C

function delete_cats_news($arr_id) {

	//xÃ³a danh má»¥c gá»‘c

	global $mysql;

	if (!empty($arr_id)) {

		$sql = 'delete from news_catalogue where categories_id in (' . $arr_id

				. ')';

		$mysql->setQuery($sql);

		$mysql->query();

		delete_img_news_in_cats($arr_id);

		delete_news_in_cats($arr_id);

	}

}

///-------------------------------------------------------------------end



//-------------------------------------------------------------------adver - liÃªn káº¿t

function delete_logo($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "select adver_logo from adver where adver_id in (" . $arr_id

				. ")";

		$mysql->setQuery($sql);

		$result = $mysql->query();

		while ($row = mysql_fetch_assoc($result)) {

			$logo = $row['adver_logo'];

			if (file_exists(_UPLOAD_AD . $logo)) {

				@unlink(_UPLOAD_AD . $logo);

			}

			if (file_exists(_UPLOAD_AD_THUMB . $logo)) {

				@unlink(_UPLOAD_AD_THUMB . $logo);

			}

		}

	}

}

function delete_adver($arr_id) {

	global $mysql;

	if (!empty($arr_id)) {

		$sql = "delete from adver where adver_id in (" . $arr_id . ")";

		$mysql->setQuery($sql);

		$mysql->query();

	}

}



function Set_status_adver($arr_id) {

	global $mysql;

	$sql = "select adver_id,adver_status from adver where adver_id in ("

			. $arr_id . ")";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$row = $mysql->loadAllRow();

	$n = count($row);

	for ($i = 0; $i < $n; ++$i) {

		if ($row[$i]['adver_status'] == '0') {

			$sql = "update adver set adver_status = 1 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		} else {

			$sql = "update adver set adver_status = 0 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		}

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

function Set_status_game($arr_id) {

	global $mysql;

	$sql = "select adver_id,adver_status from game where adver_id in ("

			. $arr_id . ")";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$row = $mysql->loadAllRow();

	$n = count($row);

	for ($i = 0; $i < $n; ++$i) {

		if ($row[$i]['adver_status'] == '0') {

			$sql = "update game set adver_status = 1 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		} else {

			$sql = "update game set adver_status = 0 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		}

		$mysql->setQuery($sql);

		$mysql->query();

	}

}



function get_adver_cats_name($id = '', $page_id = '') {

	global $mysql;

	if (($id == 1) and ($page_id == 0)) {

		return 'Trang chá»§ ';

	}

	$sql = "select categories_name from categories where categories_id  = '"

			. intval($id) . "'";

	$mysql->setQuery($sql);

	$mysql->query();

	$arr = $mysql->loadOneRow();

	return $arr['categories_name'];

}



///-------------------------------------------------------------------end



//-------------------------------------------------------------------adver - liÃªn káº¿t

function delete_file_game($arr_id) {

	global $mysql;

	$sql = "select adver_logo from game where adver_id in (" . $arr_id . ")";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	while ($row = mysql_fetch_assoc($result)) {

		$logo = $row['adver_logo'];

		if (file_exists(_UPLOAD_GAME . $logo)) {

			@unlink(_UPLOAD_GAME . $logo);

		}

	}

}

function delete_game($arr_id) {

	global $mysql;

	$sql = "delete from game where adver_id in (" . $arr_id . ")";

	$mysql->setQuery($sql);

	$mysql->query();

}



//ads  quáº£ng cÃ¡o

function delete_logo_ads($arr_id) {

	global $mysql;

	$sql = "select adver_logo from ads where adver_id in (" . $arr_id . ")";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	while ($row = mysql_fetch_assoc($result)) {

		$logo = $row['adver_logo'];

		if (file_exists(_UPLOAD_AD . $logo)) {

			@unlink(_UPLOAD_AD . $logo);

		}

		if (file_exists(_UPLOAD_AD_THUMB . $logo)) {

			@unlink(_UPLOAD_AD_THUMB . $logo);

		}

	}

}

function delete_ads($arr_id) {

	global $mysql;

	$sql = "delete from ads where adver_id in (" . $arr_id . ")";

	$mysql->setQuery($sql);

	$mysql->query();

}

function Set_status_ads($arr_id) {

	global $mysql;

	$sql = "select adver_id,adver_status from ads where adver_id in ("

			. $arr_id . ")";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$row = $mysql->loadAllRow();

	$n = count($row);

	for ($i = 0; $i < $n; ++$i) {

		if ($row[$i]['adver_status'] == '0') {

			$sql = "update ads set adver_status = 1 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		} else {

			$sql = "update ads set adver_status = 0 where adver_id ='"

					. $row[$i]['adver_id'] . "'";

		}

		$mysql->setQuery($sql);

		$mysql->query();

	}

}

///end



//kiá»ƒm tra chuyÃªn má»¥c cÃ³ media hay chÆ°a

function check_file_update_allow($id, $ext) {

	global $mysql;

	$mysql->setQuery("select adver_logo from ads where adver_pos='" . $id . "'");

	$result = $mysql->query();

	$i = 0;

	while ($row = mysql_fetch_assoc($result)) {

		if (checkExtentFile($row['adver_logo'], $ext)) {

			++$i;

		}

	}

	return $i;

}

function dlcontent($id) {

	global $mysql;

	$sql = "select content_id,content_name from contents where language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select name = 'dlcontent' id = 'dlcontent'>";

	while ($row = mysql_fetch_assoc($result)) {

		if ($id == $row['content_id'])

			$select .= "<option value ='" . $row['content_id'] . "' selected>"

					. $row['content_name'] . "</option>";

		else

			$select .= "<option value ='" . $row['content_id'] . "'>"

					. $row['content_name'] . "</option>";

	}

	$select .= '</select>';

	return $select;

}

//Xoa thanh vien

function deteleUser($id) {

	global $mysql;

	if (!empty($id)) 
	{

		$mysql->setQuery("update user set status ='-1',date_delete='" . time() . "' where id in(" . $id . ")");

		$mysql->query();
	}

}

function restoreUser($id) {

	global $mysql;

	if (!empty($id)) {

		$mysql->setQuery("update user set status ='1' where id in(" . $id . ")");

		$mysql->query();

	}

}

function total_topic($username) {

	global $mysql;

	$mysql

			->setQuery(

					"select products_id from products where username ='"

							. $username . "'");

	$mysql->query();

	return $mysql->getNumRows();

}

//Tá»•ng dung lÆ°á»£ng CSDL

function total_mysql() {

	global $obj_config;

	$size = 0;

	$mysql = new mysql();

	$mysql->setQuery("SHOW TABLE STATUS FROM " . $obj_config->db);

	$result = $mysql->query();

	while ($row = mysql_fetch_assoc($result)) {

		$size += $row['Data_length'] + $row['Index_length'];

	}

	return $size;

}

//-->

function style($path, $c, $w = '200') {

	$dir = opendir($path);

	$style = array();

	while (($file = readdir($dir)) !== false) {

		if (is_dir($path . $file) and $file != '.' and $file != '..') {

			$style[] = $file;

		}

	}

	closedir($dir);

	$select = "<select name='themes' style='width:" . $w . "px'>";

	foreach ($style as $themes) {

		if ($c == $themes) {

			$select .= "<option value='" . $themes . "' selected>" . $themes

					. "</option>";

		} else {

			$select .= "<option value='" . $themes . "'>" . $themes

					. "</option>";

		}

	}

	$select .= "</select>";

	return $select;

}

function dl_visitor($value, $width = 120) {

	$select = "<select onchange='form.submit()' name='visitor' style='width:"

			. $width . "px'>";

	global $mysql;

	$row = selectRow('mon', 'visitor',

			"year='" . date('Y', time()) . "' group by mon  order by mon");

	foreach ($row as $k) {

		if ($value == $k['mon']) {

			$select .= "<option value='" . $k['mon'] . "' selected> Tháng "

					. $k['mon'] . "</option>";

		} else {

			$select .= "<option value='" . $k['mon'] . "'> Tháng " . $k['mon']

					. "</option>";

		}

	}

	$select .= '</select>';

	return $select;

}

function cat_fillter($id) {

	global $mysql;

	$submit = " onchange ='form.submit()' ";

	if ($id == 0) {

		$option = "<option value ='0' selected>=== Xem tất cả ==</option>";

	} else {

		$option = "<option value ='0' selected>=== Xem tất cả ==</option>";

	}

	$sql = "select categories_id,categories_name from categories where level = 1  and language = '"

			. $_SESSION['lag'] . "'";

	$mysql->setQuery($sql);

	$result = $mysql->query();

	$select = "<select " . $submit

			. " name = 'catlist' id = 'catlist' style = 'width:" . $width

			. "'>" . $option;

	while ($row = mysql_fetch_assoc($result)) {

		if ($id == $row['categories_id'])

			$select .= "<option value ='" . $row['categories_id']

					. "' selected>" . $row['categories_name'] . "</option>";

		else

			$select .= "<option value ='" . $row['categories_id'] . "'>"

					. $row['categories_name'] . "</option>";



		$sql2 = "select categories_id,categories_name from categories where level = 2 and parent_id ='"

				. $row['categories_id'] . "' and language = '"

				. $_SESSION['lag'] . "'";

		$mysql->setQuery($sql2);

		$result2 = $mysql->query();

		while ($row2 = mysql_fetch_assoc($result2)) {

			if ($id == $row2['categories_id'])

				$select .= "<option value ='" . $row2['categories_id']

						. "' selected>===" . $row2['categories_name']

						. "</option>";

			else

				$select .= "<option value ='" . $row2['categories_id']

						. "'>===" . $row2['categories_name'] . "</option>";

			$sql3 = "select categories_id,categories_name from categories where level = 3 and parent_id ='"

					. $row2['categories_id'] . "' and language = '"

					. $_SESSION['lag'] . "'";

			$mysql->setQuery($sql3);

			$result3 = $mysql->query();

			while ($row3 = mysql_fetch_assoc($result3)) {

				if ($id == $row3['categories_id'])

					$select .= "<option value ='" . $row3['categories_id']

							. "' selected>--------" . $row3['categories_name']

							. "</option>";

				else

					$select .= "<option value ='" . $row3['categories_id']

							. "'>--------" . $row3['categories_name']

							. "</option>";

			}

		}

	}

	$select .= '</select>';

	return $select;

}

function pos_adver($id = '') {

	global $mysql;

	$name = 'name_' . $_SESSION['lag'];

	$sql = "select id,$name from cats_adver";

	$mysql->setQuery($sql);

	$mysql->query();

	$arr = $mysql->loadAllRow();

	$n = count($arr);

	$select = "<select name = 'pos_adver'>";

	for ($i = 0; $i < $n; $i++) {

		if ($id == $arr[$i]['id'])

			$select .= "<option value ='" . $arr[$i]['id'] . "' selected>"

					. $arr[$i][$name] . "</option>";

		else

			$select .= "<option value ='" . $arr[$i]['id'] . "'>"

					. $arr[$i][$name] . "</option>";

	}

	$select .= '</select>';

	return $select;

}

function get_adver_pos_name($id = '') {

	global $mysql;

	$name = 'name_' . $_SESSION['lag'];

	$sql = "select $name from cats_adver where id = '" . intval($id) . "'";

	$mysql->setQuery($sql);

	$mysql->query();

	$arr = $mysql->loadOneRow();



	if (empty($arr[$name])) {

		$sql = "select categories_name from categories where categories_id = '"

				. str_replace('c-', '', $id) . "'";

		$mysql->setQuery($sql);

		$mysql->query();

		$arr = $mysql->loadOneRow();

		return $arr['categories_name'];

	}

	return $arr[$name];

}



function convertIntToFormatMoney($str){

	$strm =  number_format($str);

	$arrC = array(',');

	$arrB = array('.');

	$strm = str_replace($arrC, $arrB, $strm);

	return $strm;

}



function convertFormatMoneyToInt($str){

	$arrC = array('.');

	$arrB = array('');

	$strm = str_replace($arrC, $arrB, $str);

	return $strm;

}

?>