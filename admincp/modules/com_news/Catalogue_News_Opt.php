<?php

		$title = $arr_lang['addcat'] .' tin tức';
		$id = intval($_GET['id']);
		$btn = $arr_lang['add_cat'];
		$panel = $arr_lang['add_cat'];
		$update = 0;
		if(check_valid_cats_news($id))		//fill data on textbox
		{
			$title = $arr_lang['updatecat'] .' tin tức';
			$btn = $arr_lang['update'];
			$panel = $arr_lang['update_cat'];
			$update = 1;
			$sql = "Select categories_name,categories_order from news_catalogue where categories_id = '".$id."'";
			$mysql -> setQuery($sql);
			$row = $mysql ->loadOneRow();
			$catname = output($row['categories_name']);
			$catname_old = $catname;
			$catorder = $row['categories_order'];
		}		
		if(isset($_POST['btnadd']))
		{
			$catname = output($_POST['txtname']);
			$catorder = intval($_POST['txtorder']);
			$catkey	 = vitoen($catname,'-');
			if(!isset($catname{1})) {$error = 'Tên chuyên mục quá ngắn !';}
			//echo input($catname).' '.$id.' '.$arr_lang['err_cat_name_valid'];
			if(check_cats_name_news(input($catname),$id)) {$error = $arr_lang['err_cat_name_valid'].' !';$catname = $catname_old;}
			if(empty($error))
			{
				if($update == 1) //update
				{
					$sql = "update news_catalogue set categories_name = '".input($catname)."',categories_key = '".input($catkey)."',categories_order = '".$catorder."',categories_modified_date = ".time()." where categories_id = ".$id."";
					$mysql -> setQuery($sql);
					$mysql -> query();
					header('location:./?show=CatalogueNewsList&p='.intval($_GET['p']));
				}
				else//insert
				{
					$sql = "Insert into news_catalogue(categories_name,categories_key,categories_order,categories_date_added,language)
									values('".input($catname)."','".input($catkey)."',".$catorder.",".time().",'".$_SESSION['lag']."')";
					$mysql -> setQuery($sql);
					$mysql -> query();
					header('location:./?show=CatalogueNewsList');
					//echo $sql;
				}
			}
			//echo $sql;
		}
	

	$xtemplate -> path = 'com_news/';
	$content = $xtemplate -> load('Catalogue_News_Opt');
	$content = $xtemplate ->replace($content,array(
	'add_cat'			=> $panel,
	'reset'				=> $arr_lang['reset'],
	'lag_show'			=> $arr_lang['show'],
	'btn'				=> $btn,
	'txtname'			=> output($catname),
	'txtorder'			=> $catorder,
	'error'				=> $error
	));
?>