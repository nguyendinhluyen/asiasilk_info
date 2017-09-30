<?php
//==========================================================
//(Khiem)
//tim kiem theo tin giai tri (các record trong bang NEWS 
//voi catalogue thuoc: game va phim)
	$news = new News();
	$linkPage = '';//link Page

	//get all products
	$elements = 'news_id,
						news_key,
						news_name,
						keywords,
						description,
						news_shortcontent,
						news_image';
	$from_table = 'news';
	$where = "(news_catalogue in (23, 24)) and status = 1 and news_name like '%".$search_key."%'";
	$sql = 'select '.$elements.' from '.$from_table.' where '.$where;
	//$sql = "select * from $from_table where $where";
	global $mysql;
	$listnews = $mysql->query_command($sql);
	//$products = $Product -> getProductsByKeySearch($search_key);

	$total = count($listnews);

	$pp = 16;
	$p_now 		= 	intval($_GET ['entertainment_page']);
	$numofpages = $total / $pp;
	$page = 0;

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

	$sql = "select $elements from $from_table where $where limit $limitvalue, $pp";
	$listnews = $mysql->query_command($sql);
	//$products = $Product-> getProductsByKeySearchLimit($search_key,$limitvalue,$pp);
	$n = count($listnews);
	$tpl = '';
	$tpl_temp = '<ul>';
	$block = $xtemplate->get_block_from_str($template,'ENTERTAINMENT');

	$flag = 0;
	for($i=0;$i<$n;++$i)
	{
		$flag ++;
		$tpl_temp .= $xtemplate->assign_vars($block,array(
					'news_img'		=> $listnews[$i]['news_image'],
					'news_name'  	=> common::limitContent($listnews[$i]['news_name'], 40),
					'news_key' 		=> $listnews[$i]['news_key'],
		));	

		if($flag%4==0 || $i>$n-2)
		{
			$tpl_temp .= ' </ul>';
			$line = '<div class="line"> </div>';
			$tpl .= $tpl_temp.$line;
			$tpl_temp = '<ul>';
		}
	}

	//echo $tpl;
	//die(var_dump($product));
	
	$template = $xtemplate->assign_blocks_content($template ,array(
													'ENTERTAINMENT'=>$tpl
	));
	$product_page = input($_GET['product_page']);
	if(!isset($product_page) || $product_page<=0)
		$product_page=1;
	$news_page = input($_GET['news_page']);
	if(!isset($news_page) || $news_page<=0)
		$news_page=1;
	$template = $xtemplate->replace($template,array(
			'entertainment_page'	=> pagination_multipage($linkS."tim-kiem/key=".$search_key."/product_page=$product_page&news_page=$news_page",ceil ( $numofpages ), $page, 'intertainment_page',"&tabID=3"),
	));	
?>

