<?php
	if(($_GET['action'] == 'del')&&isset($_GET['id']))
	{
		$id = intval($_GET['id']);
		delete_img_news($id);
		delete_news($id);
		header('location:./?show=newsList&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	if(isset($_POST['btndel']))
	{
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';
		delete_img_news($id);
		delete_news($id);
		header('location:./?show=newsList&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	else if(isset($_POST['btnStatus']))
	{
		
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';
		Set_status_news($id);
		header('location:./?show=newsList&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	else if(isset($_POST['btnNewswait']))
	{
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';
		Set_news_waitting($id);
		header('location:./?show=newsList&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	$title = 'Danh sách các tin tức';
	$xtemplate -> path = 'com_news/';
	$content = $xtemplate -> load('NewsList');
	$code_cats = $xtemplate ->get_block_from_str($content,"NEWS");
	//Phan trang
	$p_now 		= 	intval($_GET ['p']);
	$mysql 		->	setQuery("Select news_id from news where language ='".$lag."'");	
	$mysql 		->	query();
	$total		=	$mysql -> getNumRows();
	$numofpages = $total / $pp;
	if ($p_now <= 0)
	{
		$page = 1;
	} 
	else
	{
		if($p_now <= ceil($numofpages))
			$page = $p_now;
		else
			$page = 1;
	}
	$limitvalue = $page * $pp - ($pp);
	//end phan trang
	switch($_GET['order'])
	{
		case 'name':
			$orderby = ' news_name';
			break;
		case 'catalogue':
			$orderby = ' news_id';
			break;
		case 'status':
			$orderby = ' status';
			break;
		case 'dateadd':
			$orderby = ' date_added';
			break;
		case 'datemodifiled':
			$orderby = ' last_modified';
			break;
		default:
			$orderby = ' news_catalogue';
		break;
	}
	$sql = "Select news_id,news_name,news_image,news_catalogue,status,date_added,last_modified from news where language ='".$_SESSION['lag']."' order by $orderby limit $limitvalue,$pp";
	$mysql -> setQuery($sql);
	$row = $mysql->loadAllRow();
	$n = count($row);
	$temp = '';
	for($i = 0 ; $i < $n ; ++$i)
	{
		$color = ($i%2==0)?'#d5d5d5':'#e5e5e5';
		$img = $row[$i]['news_image'];
		$imgSrc = _UPLOAD_IMG_NEWS.$img;
		$imgThumb = _UPLOAD_IMG_NEWS_THUMB.$img;
		$img = ($img=='')?"<img src ='"._STYLE_IMG."picoff.gif'>":"<a href ='$imgThumb'><img border=0 style=\"cursor:hand\" src=\""._STYLE_IMG."picon.gif\" onmouseover=\"this.src='"._STYLE_IMG."piconover.gif';return overlib('<div><table border=0 cellpadding=2 cellspacing=0><tr><td class=titleImg>Click to Thumbnails</td></tr><tr><td><img src=$imgSrc></a></td></tr></table></div>');\" onmouseout=\"this.src='"._STYLE_IMG."picon.gif';return nd();\"></a>";
		$temp.= $xtemplate ->assign_vars($code_cats,array(
											'id'	=>$row[$i]['news_id'],	
											'news_name' => cut_string($row[$i]['news_name'],40,'...'),	
											'news_image'		=> $img,
											'status'		=> ($row[$i]['status']=='1')?$arr_lang['show']:$arr_lang['hidden'],	
											'date_added'		=> date('h:i d/m/Y',$row[$i]['date_added']),
											'last_modified'		=> ($row[$i]['last_modified']==0)?'0':date('h:i d/m/Y',$row[$i]['last_modified']),
											'color'				=> $color));
	}
	$content = $xtemplate ->assign_blocks_content($content,array("NEWS" => $temp));
	$content = $xtemplate ->replace($content,array(
	'lag_product_manager'	=> $title,
	'title'			=> 'Tiêu đề tin',
	'lag_page'			=> $arr_lang['page'],
	'p'					=> ($_GET['p']=='')?'1':intval($_GET['p']),
	'oderby'			=> $_GET['order'],
	'page'				=> page_div("./?show=newsList&p=%d_pg&order=".$_GET['order'], "10", ceil ( $numofpages ), $page),
	'lag_delete'		=> $arr_lang['del'],
	'lag_edit'			=> $arr_lang['edit'],
	'lag_status'		=> $arr_lang['status'],
	'lag_date_create'	=> $arr_lang['date_added'],
	'lag_date_modifiled'=> $arr_lang['date_modifiled'],
	'delete_check'		=> $arr_lang['del_check'],
	'del_confirm' 		=> $arr_lang['del_confirm'],
	'newsmanager'		=> 'Quản lý tin tức',
	'image'				=> $arr_lang['image'],
	'ofcatalogue'		=> $arr_lang['ofcatalogue'],
	'shi'				=> $arr_lang['shi'],
		'addnews'				=> 'Thêm tin tức',
	));
	$script = $xtemplate ->get_block_from_str($content,"SCRIPT");
	$content = $xtemplate ->assign_blocks_content($content,array("SCRIPT" =>''));
	
?>