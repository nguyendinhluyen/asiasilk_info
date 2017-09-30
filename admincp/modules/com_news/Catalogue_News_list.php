<?php
	$title = 'Danh mục tin tức';
	if(($_GET['action']== 'del')&&(isset($_GET['id'])))
	{
		delete_cats_news(intval($_GET['id']));
		header('location:./?show=CatalogueNewsList&p='.intval($_GET['p']));
	}
	else if(isset($_POST['btndel']))
	{
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';
		delete_cats_news($id);
		header('location:./?show=CatalogueNewsList&p='.intval($_GET['p']));
	}
	else if(isset($_POST['btnstatus']))
	{
		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';	
		Set_status_cats_news($id );
		header('location:./?show=CatalogueNewsList&p='.intval($_GET['p']));
	}
	$xtemplate -> path = 'com_news/';
	$content = $xtemplate -> load('Catalogue_News_list');
	$code_cats = $xtemplate ->get_block_from_str($content,"CATSNEWS");
	//Phan trang
	$p_now 		= 	intval($_GET ['p']);
	$mysql 		->	setQuery("Select categories_id from news_catalogue where language ='".$_SESSION['lag']."'");
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
	$sql = "Select categories_id,categories_name,categories_order,categories_date_added,categories_modified_date,categories_status from news_catalogue where language ='".$_SESSION['lag']."' order by categories_order limit $limitvalue,$pp";
	$mysql -> setQuery($sql);
	$row = $mysql->loadAllRow();
	$n = count($row);
	$temp = '';
	for($i = 0 ; $i < $n ; ++$i)
	{
		$color = ($i%2==0)?'#d5d5d5':'#e5e5e5';
		$temp.= $xtemplate ->assign_vars($code_cats,array(
											'categories_id'	=> $row[$i]['categories_id'],
											'categories_name'=> $row[$i]['categories_name'],
											'categories_order'=> $row[$i]['categories_order'],
											'categories_date_added'=> date('H:i d/m/Y',$row[$i]['categories_date_added']),
											'categories_status'=> ($row[$i]['categories_status']=='1')?$arr_lang['show']:$arr_lang['hidden'],
											'categories_modified_date'	=> ($row[$i]['categories_modified_date']=='0')?'0':date('h:i d/m/Y',$row[$i]['categories_modified_date']),
											'color'				=> $color));
	}
	$content = $xtemplate ->assign_blocks_content($content,array("CATSNEWS" => $temp));
	$content = $xtemplate ->replace($content,array(
	'lag_page'			=> $arr_lang['page'],
	'page'				=> page_div("./?show=CatalogueNewsList&p=%d_pg", "10", ceil ( $numofpages ), $page),
	'p'					=> ($_GET['p']=='')?'1':intval($_GET['p']),
	'lag_delete'		=> $arr_lang['del'],
	'lag_edit'			=> $arr_lang['edit'],
	'lag_status'		=> $arr_lang['status'],
	'lag_date_modifiled'=> $arr_lang['date_modifiled'],
	'delete_check'		=> $arr_lang['del_check'],
	'lag_order'      	=> $arr_lang['order'],
	'del_confirm' 		=> $arr_lang['del_confirm'],
	));	
?>