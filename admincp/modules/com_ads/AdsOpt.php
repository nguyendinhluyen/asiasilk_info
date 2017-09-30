<?php
	$title = 'Thêm quảng cáo';
	$checked = 'checked';
	$update = 0;
	$up_new_file = 0;
	$show_logo = "<img src='"._STYLE_IMG."cat.png' width='60px'/>";
	$xtemplate -> path = 'com_ads/';
	$content = $xtemplate -> load('AdsOpt');
	$flash = $xtemplate -> get_block_from_str($content , 'FLASH');
	$content = $xtemplate ->assign_blocks_content($content , array('FLASH' =>''));
	if(isset($_GET['id']))
	{
		$id = intval($_GET['id']);
			$update = 1;
			$title = 'Cập nhật quảng cáo';
			$sql = "select adver_pos,description_ads,description_ads_en,adver_webname,adver_logo,adver_link,adver_width,adver_height,adver_status,adver_order from ads where adver_id = '$id'";
			$mysql -> setQuery($sql);
			$row = $mysql -> loadOneRow();
			$checked = ($row['adver_status']==1)?'checked':'';
			$txtwebname = output($row['adver_webname']);
			$adver_logo	= output($row['adver_logo']);
			$txtlink = output($row['adver_link']);
			$txtwidth = intval($row['adver_width']);
			$txtheight = intval($row['adver_height']);
			$txtorder = intval($row['adver_order']);
			$id_pos = $row['adver_pos'];
			$description_ads_en = $row['description_ads_en'];
			
			$description_ads= $row['description_ads'];
			if(checkExtentFile($adver_logo,'swf'))
			{
				$show_logo = $xtemplate -> replace($flash,array(
				'logo' => _UPLOAD_AD_THUMB.$adver_logo,
				));
			}
			else
			{
				$show_logo ="<img src='"._UPLOAD_AD.$adver_logo."' width='60px'/>";
			}
			$view_adver = _UPLOAD_AD_THUMB.$adver_logo;
	}
	if(isset($_POST['btnSub']))
	{
		$fileAdver = $_FILES["fileAdver"]["name"];
		$checked = ($_POST['cbstatus']=='on')?'checked':'';
		$txtwebname = output($_POST['txtwebname']);
		$txtlink = output($_POST['txtlink']);
		$txtwidth = intval($_POST['txtwidth']);
		$txtheight = intval($_POST['txtheight']);
		$txtorder = intval($_POST['txtorder']);
		$id_pos = $_POST['pos_adver'];
		$description_ads = $_POST['description_ads'];
		$description_ads_en = $_POST['description_ads_en'];
		//insert
		if(($update != 1)||(!empty($fileAdver)))
		{
			if(empty($fileAdver)) {$error.= '<li>Bạn chưa chọn file </li>';}
			else if(!checkExtentFile($_FILES["fileAdver"]["name"],$imgExtent.'|'.$mediaExtent)){$error.= '<li>'.$arr_lang['err_checkExtent'].' '.str_replace('|',',',$imgExtent.'|'.$mediaExtent).'</li>';}
			else 
			{
				if(checkExtentFile($_FILES["fileAdver"]["name"],$mediaExtent))
				{
					if ($_FILES["fileAdver"]["size"] > $mediaSize)
					{
						$error.='<li>Media quá dung lượng cho phép > '.formatsize($mediaSize).'</li>';
					}			
				}
				else
				{
					if($_FILES["fileAdver"]["size"] > $imgSize)
					{
						$error.='<li>Hình ảnh quá dung lượng cho phép > '.formatsize($imgSize).'</li>';
					}
				}
			}
			if(!empty($fileAdver))
			{
				$up_new_file = 1;
			}

		}
		if(empty($error))
		{
			$status = ($_POST['cbstatus']=='on')?'1':'0';
			if($update!=1)
			{
				$sql = "insert into ads(description_ads_en,description_ads,adver_pos,adver_webname,adver_link,adver_width,adver_height,adver_status,adver_order,date_added)
					values ('".$description_ads_en."','".$description_ads."','".$id_pos."','".input($txtwebname)."','".input($txtlink)."',".$txtwidth.",".$txtheight.",".$status.",".$txtorder.",".time().")";
			}
			else
			{
				$sql = "update ads set description_ads_en='".$description_ads_en."',description_ads='".$description_ads."', adver_pos = '".$id_pos."',adver_webname = '".input($txtwebname)."',adver_link = '".$txtlink."',adver_width = ".$txtwidth.",adver_height =".$txtheight.",adver_status =".$status.",adver_order =".$txtorder.",date_modifile =".time()." where adver_id = $id";//update
			}
			$mysql -> setQuery($sql);
			if($mysql -> query())
			{
				if(($update == 0)||($up_new_file == 1))
				{
					if($update ==0)
					{
						$lastId = mysql_insert_id();
					}
					else
					{
						$lastId = $id;
						if(file_exists(_UPLOAD_AD_THUMB.$adver_logo)) {@unlink(_UPLOAD_AD_THUMB.$adver_logo);}
						if(file_exists(_UPLOAD_AD.$adver_logo)) {@unlink(_UPLOAD_AD.$adver_logo);}
					}
					//đổi tên file
					$fileAdver = renameFile($_FILES["fileAdver"]["name"],'ads-'.input(vitoen($txtwebname,'-').'-'.$lastId));
					//Di chuyển vào thư mục
					move_uploaded_file($_FILES ["fileAdver"]["tmp_name"],_UPLOAD_AD_THUMB.$fileAdver);
					if(!checkExtentFile($fileAdver,$mediaExtent))
					{
						//resize ảnh
						imagejpeg(resize(_UPLOAD_AD_THUMB.$fileAdver,$ImgW),_UPLOAD_AD.$fileAdver);
					}
					$sql = "update ads set adver_logo = '".$fileAdver."' where adver_id ='".$lastId."'";
					$mysql -> setQuery($sql);
					$result = $mysql -> query();
					
				}
			}
			header("location:./?show=Ads&p=".intval($_GET['p']));
		}
		else
		{
			$error = '<ul>'.$error.'</ul>';
		}
	}
	$content = $xtemplate -> replace($content  , array(
									'title'=>$title,
									'show_logo' => $show_logo, 
									'pos_adver' => pos_adver($id_pos),
									'txtwebname' => $txtwebname,
									'view_adver' => $view_adver,
									'txtlink' => $txtlink,
									'description_ads'=>$description_ads,
									'description_ads_en'=>$description_ads_en,
									'txtwidth' => $txtwidth,
									'txtheight' => $txtheight,
									'txtorder' => $txtorder,
									'checked' => $checked,
									'error' => $error,
									));
?>