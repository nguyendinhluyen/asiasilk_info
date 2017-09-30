<?php
//===============================================
//(Khiem)
// Tim kiem theo san pham (kha giong voi code tim kiem luc truoc)
	$Product = new Product();
	$Category = new Category();
	$linkPage = '';//link Page

	//get all products
	$elements = 'products_id,
						products_key,
						products_name,
						keywords,
						description,
						products_description,
						product_detail,
						products_image,
						products_price,
						product_encourage,
						price_unit,
						categories_id,
						p_encourage,
						manufacturer';
	$from_table = 'products';
	$where = "products_status = 1 and products_name like '%".$search_key."%'";
	$sql = 'select '.$elements.' from '.$from_table.' where '.$where;
	
	global $mysql;
	$products = $mysql->query_command($sql);
	//$products = $Product -> getProductsByKeySearch($search_key);
	$total = count($products);

	$pp = 16;
	$p_now 		= 	intval($_GET ['product_page']);
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
	$products = $mysql->query_command($sql);
	//die(var_dump($products));
	//$products = $Product-> getProductsByKeySearchLimit($search_key,$limitvalue,$pp);
	$n = count($products);
	$tpl = '';
	$tpl_temp = '<ul>';
	$block = $xtemplate->get_block_from_str($template,'PRODUCT');

	$flag = 0;
	for($i=0;$i<$n;++$i)
	{
		$flag ++;
		$encourage ='';
		if(intval($products[$i]['products_price']) >0)
			$pro_price = $products[$i]['products_price']. ' vnd';
		else 
			$pro_price = "";
		if($products[$i]['p_encourage'] != '' && intval($products[$i]['p_encourage']) > 0)
		{
			$pro_price = $products[$i]['p_encourage']. ' vnd';
			$encourage = $products[$i]['products_price']. ' vnđ';
		}

		$category_key = $Category->getCategoryKeyByProductKey($products[$i]['products_key']);
		$tpl_temp .= $xtemplate->assign_vars($block,array(
					'product_img'		=> $products[$i]['products_image'],
					'product_name'  	=> $products[$i]['products_name'],
					'product_price'   	=> $pro_price,
					'product_short'   	=> common::limitContent($products[$i]['products_description'],40),
					'product_key' 		=> $products[$i]['products_key'],
					'category'			=> $category_key,
					'product_price_old'	=> $encourage 
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
													'PRODUCTS'=>$tpl
	));
	
	$news_page = input($_GET['news_page']);
	if (!isset($news_page) || $news_page<=0)
		$news_page = 1 ;
	$entertainment_page = input($_GET['entertainment_page']);
	if (!isset($entertainment_page) || $entertainment_page<=0)
		$entertainment_page = 1 ;
	$template = $xtemplate->replace($template,array(
			'product_page'	=> pagination_multipage($linkS."tim-kiem/key=".$search_key.'/',ceil ( $numofpages ), $page,'product_page',"&news_page=$news_page&entertainment_page=$entertainment_page&tabID=1"),
	));	
?>

