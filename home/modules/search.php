<?php
	$search_key = input($_POST['search_box']);	
	if($_GET['search_box']){
		$search_key = input($_GET['search_box']);
	}
	$tabID = input($_GET['tabID']);
	if(!isset($tabID) || $tabID > 3 || $tabID < 1)
		$tabID = 1;
	$template= '';
	switch ($tabID)
	{
		case 1:
			$template = $xtemplate->load('search_1');
			break;
		case 2:
			$template = $xtemplate->load('search_2');				
			break;
		case 3:
			break;
			$template = $xtemplate->load('search_3');		

		default:
			$template = $xtemplate->load('search_1');
			break;
	}
	$breadcrumbs_path = '<a href="{linkS}">Trang chủ</a>';
	$linkPage .= $breadcrumbs[$i]['key'].'/';
	$breadcrumbs_path .= ' &raquo; Tìm kiếm';
	$tilte_page =  'Tìm kiếm';
	
//======================================================
//(Khiem)
//	phan tach viec tim kien tren 3 linh vuc (san pham, tin tuc, giai tri) vao 3 file php 
	include 'search_news.php';
	include 'search_product.php';
	include 'search_entertainment.php';
	
	$content = $template;
?>

