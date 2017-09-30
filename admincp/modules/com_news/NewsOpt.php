<?php
	switch($_GET['opt'])
	{
		case 'newswait':
			$opt = 'newswait';
			$fill = 'news_wait';
			$t2 = 'tin đón đợi';
			break;
		default:
			header("location:./?show=newsList");
	}
	if(($_GET['action'] == 'del')&&isset($_GET['id']))
	{
		$id = intval($_GET['id']);
		$sql = 'update news set '.$fill.' = 0 where news_id ='.$id;
		$mysql -> setQuery($sql);
		$mysql -> query();
		header('location:./?show=NewsOpt&opt='.$_GET['opt'].'&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	if(isset($_POST['btndel']))
	{
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';
		$sql = 'update news set '.$fill.' = 0 where news_id ='.$id;
		$mysql -> setQuery($sql);
		$mysql -> query();
		header('location:./?show=NewsOpt&opt='.$_GET['opt'].'&p='.intval($_GET['p']).'&order='.$_GET['order']);
	}
	$title = 'Quản lý tin tức - '.$t2;
	$xtemplate -> path = 'com_news/';
	$content = $xtemplate -> load('NewsOpt');
	$code_cats = $xtemplate ->get_block_from_str($content,"NEWS");
	//Phan trang
	$p_now 		= 	intval($_GET ['p']);
	$mysql 		->	setQuery("Select news_id from news where language ='".$lag."' and ".$fill.'=1');	
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
	$sql = "Select news_id,news_name,news_image,news_catalogue,status,date_added,last_modified from news where language ='".$_SESSION['lag']."' and ".$fill." =1 order by $orderby limit $limitvalue,$pp";
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
											'news_name' => $row[$i]['news_name'],	
											'news_catalogue'		=> get_catsnews_name($row[$i]['news_catalogue']),	
											'news_image'		=> $img,
											'status'		=> ($row[$i]['status']=='1')?$arr_lang['show']:$arr_lang['hidden'],	
											'date_added'		=> date('h:i d/m/Y',$row[$i]['date_added']),
											'last_modified'		=> ($row[$i]['last_modified']=='0')?'0':date('h:i d/m/Y',$row[$i]['last_modified']),
											'color'				=> $color));
	}
	$content = $xtemplate ->assign_blocks_content($content,array("NEWS" => $temp));
	$content = $xtemplate ->replace($content,array(
	'lag_product_manager'	=> $title,
	'lag_page'			=> $arr_lang['page'],
	'p'					=> ($_GET['p']=='')?'1':intval($_GET['p']),
	'oderby'			=> $_GET['order'],
	'opt'				=> $opt,
	'page'				=> page_div("./?show=".$opt."&p=%d_pg&order=".$_GET['order'], "10", ceil ( $numofpages ), $page),
	'lag_delete'		=> $arr_lang['del'],
	'lag_status'		=> $arr_lang['status'],
	'lag_date_create'	=> $arr_lang['date_added'],
	'lag_date_modifiled'=> $arr_lang['date_modifiled'],
	'delete_check'		=> $arr_lang['del_check'],
	'del_confirm' 		=> $arr_lang['del_confirm'],
	));
	$script = $xtemplate ->get_block_from_str($content,"SCRIPT");
	$content = $xtemplate ->assign_blocks_content($content,array("SCRIPT" =>''));
	
?>