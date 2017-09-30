<?php
if($_SESSION['timeout'] + 3 < time())
{
	$title = 'Thêm tin tức';
	$id = intval($_GET['id']);
	$btn = $arr_lang['add'];
	$panel = $title;
	$imagesrc = _STYLE_IMG.'noimages.gif';
	$update = 0;
	$error = '';
	if(check_id_news($id))//fill data on textbox : check_valid($id)
	{
		$update=1;
		$btn = $arr_lang['update'];
		$panel = 'Cập nhật tin tức';
		$title = $panel;
		$sql = "Select news_name,news_image,news_catalogue,news_source,news_shortcontent,news_content from news where news_id = '".$id."' and language='".$_SESSION['lag']."'";
		$mysql -> setQuery($sql);
		$row = $mysql ->loadOneRow();
		$news_title = output($row['news_name']);
		if(!empty($row['news_image']))
		{
			$imagesrc = _UPLOAD_IMG_NEWS.$row['news_image'];
			$ImgDel = "<img src='"._STYLE_IMG."delete.gif'>";
			$ImgThumb = "<img src='"._STYLE_IMG."piconover.gif'>";
		}
		
		$source = output($row['news_source']);
		$decription = output($row['news_shortcontent']);
		$categories_id	 = $row['news_catalogue'];
		$detail = output($row['news_content']);
	}
	if(isset($_POST['btnadd']))
	{
		$news_title = output($_POST['txtname']);
		$news_key = vitoen($news_title,'-');
		$image = '';
		$source = output($_POST['txtsource']);
		$categories_id = $_POST['catlist'];
		$decription = output($_POST['decription']);
		$detail = output($_POST['detail']);
		if(!isset($categories_id{0})) {$error.= '<li>Bạn chưa chọn danh mục tin tức</li>';}
		if(!isset($news_title{4})) $error.= '<li>Tiêu đề tin tức quá ngắn</li>';
		if(!isset($detail{19})) $error.='<li>Nội dung tin tức quá ngắn</li>';
		if($_FILES ["image"]["name"])
		{
			//Kiểm tra file ảnh
			if (!checkExtentFile($_FILES["image"]["name"],$imgExtent )){$error.='<li>'.$arr_lang['err_checkExtent'].' '.str_replace('|',',',$imgExtent).'</li>';}
			else
			{
				//Kiểm tra dung lượng ảnh
				if ($_FILES["image"]["size"] > $imgSize){$error.='<li>'.$arr_lang['err_size'] .' > '.formatsize($imgSize).'</li>';}
			}
		}
		else
		{
			$image = 'default.jpg';
		}
		if(empty($error))
		{
			if($update==1)//update
			{
				$sql = "update news set news_name='".input($news_title)."',news_source='".$source."',last_modified=".time().",news_shortcontent='".input($decription)."',news_content='".input($detail)."',news_catalogue='".$categories_id."' where news_id = '".$id."'";
			}
			else //insert
			{
				$sql = "insert into news(news_name,news_source,date_added,news_shortcontent,news_content,news_catalogue,language) values ('".input($news_title)."','".$source."',".time().",'".input($decription)."','".input($detail)."',".$categories_id.",'".$_SESSION['lag']."')";
			}
			$mysql->setQuery($sql);
			if($mysql -> query())
			{
				$lastId = mysql_insert_id();
				if($image != "default.jpg")
				{
					if($update==1)//update image
					{
						if(file_exists($imagesrc))
						{
							@unlink($imagesrc);
							@unlink(_UPLOAD_IMG_NEWS_THUMB.$row['news_image']);
						}
						$lastId = $id;
					}
					//Resize ảnh và di chuyển vào thư mục
					$image = renameFile($_FILES["image"]["name"],'p-'.input($news_key).'-'.$lastId);//Đổi tên hình
					move_uploaded_file($_FILES ["image"]["tmp_name"],_UPLOAD_IMG_NEWS_THUMB.$image);
					imagejpeg(resize(_UPLOAD_IMG_NEWS_THUMB.$image,$ImgW),_UPLOAD_IMG_NEWS.$image);
					$sql = "update news set news_image = '".$image."' where news_id = '".$lastId."'";
					$mysql -> setQuery($sql);
					$mysql -> query();
				}
				if($update==1){$lastId = $id;}
				$sql = "update news set news_key = '".input($news_key.'-'.$lastId)."' where news_id = '".$lastId."'";
				$mysql -> setQuery($sql);
				$mysql -> query();
			}
			$_SESSION['timeout'] = time();
			header('location:./?show=newsList&p='.intval($_GET['p']).'&order='.$_GET['order']);
		}
		else
		{
			$error = '<ul class=err><b>'.$arr_lang['error'].'</b>'.$error.'</ul>';
		}
	}
	$xtemplate -> path = 'com_news/';
	$content = $xtemplate -> load('OptNews');
	$content = $xtemplate ->replace($content,array(
	'error'						=> $error,
	'cat_list'					=> LoadAllCatalogue($categories_id),
	'imagesrc'					=> $imagesrc,
	'ImgThumb'					=> $ImgThumb,
	'ImgDel'					=> $ImgDel,
	'panel_add_update_product'	=> $panel,
	'news_title'				=> 'Tiêu đề',
	'image'						=> $arr_lang['image'],
	'source'					=> 'Nguồn',
	'txtsource'					=> $source,
	'product_of_catalogue'		=> $arr_lang['product_of_catalogue'],
	'decription'				=> $arr_lang['decription'],
	'news_detail'				=> 'Chi tiết tin tức',
	'reset'						=> $arr_lang['reset'],
	'btn'						=> $btn,
	'txtname'					=> $news_title,
	'txtprice'					=> $price,
	'txtdecripton'				=> $decription,
	'txtdetail'					=> $detail,
	));
	$script = $xtemplate ->get_block_from_str($content,"SCRIPT");
	$content = $xtemplate ->assign_blocks_content($content,array("SCRIPT" => ''));
}
else
{
	header("location:./?show=newsList");
}
?>