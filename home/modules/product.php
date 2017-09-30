<?php
	
	function getpercent($str1,$str2)
	{ 			
		$encourage = (int)str_replace(".","",$str1);  		
		$price = (int)str_replace(".","",$str2);		
		if($encourage > $price)
		{
				$saleoff = round(($encourage - $price) / $encourage * 100);	
		}		
		$saleoff = $saleoff.'%';
		return $saleoff;        
	} 
	$category_key = input($_GET['category_key']);

	if(isset($_GET['category_sub_key'])){

		$category_key = input($_GET['category_sub_key']);
	}

	$product = $xtemplate->load('product');
	
	$Product = new Product();

	$Category = new Category();
	
	$disCountVIPCustomer = 0;
	
	if($_SESSION['username']!='')
	{
		// LAY THONG TIN DUOC KHUYEN MAI CUA KHACH HANG

		$Discount_honorUser = $Product -> getDiscountOfCustomer($_SESSION['username']);

		if(intval($Discount_honorUser) > 0)
		{
			$disCountVIPCustomer = (int)$Discount_honorUser;
		}
	}					

	$linkPage = '';

	$PromotionSale='';

	$breadcrumbs =$Category->getCategoryPath($category_key);

	$breadcrumbs_path = '<a href="{linkS}">Trang chủ</a>';

	$k = count($breadcrumbs);

	$tilte_page = '';

	for ($i=$k ; $i>=0 ; $i--)
	{
		if($breadcrumbs[$i]['name'] != '')
		{

			if($i>0){

				$linkPage .= $breadcrumbs[$i]['key'].'/';

				$breadcrumbs_path .= ' &raquo; <a href="{linkS}'.$breadcrumbs[$i]['key'].'.htm">'.$breadcrumbs[$i]['name'].'</a>';

				$tilte_page .=  $breadcrumbs[$i]['name'];
			}

			else 
			{
				$linkPage .= $breadcrumbs[$i]['key'];

				$breadcrumbs_path .= ' &raquo; '.$breadcrumbs[$i]['name'];

				$tilte_page .=   ' | '.$breadcrumbs[$i]['name']. " | ASIASILK";
			}
			
		}

	}	

	if($category_key == 'sale-off')
	{
		$breadcrumbs_path .= ' &raquo; Sale off';
		
		$linkPage = 'sale-off';
	}
	
	if($k == 1)
	{
		$linkPage .= '.htm';
	}

	//get all products

	$products_t = $Product -> getProductsByCategoryKey($category_key);

	$total = count($products_t);
	
	//Phan trang

	if(isset($_GET['num'])){

		$pp_quan = input($_GET['num']);

		$_SESSION['pp_quan'] = $pp_quan;

	}

	$pp_quan = $_SESSION['pp_quan'];

	$pp = 21;

	if($pp_quan > 0)
	{
		$pp = $pp_quan;
	}

	$p_now 	= intval($_GET ['page']);

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

	//end phan trang
	
	if(isset($_GET['order_by']))
	{

		$order_by = input($_GET['order_by']);

		$_SESSION['order_by'] = $order_by;
	}

	$products = $Product-> getProductsByCategoryKeyLimitOrderBy($category_key, $limitvalue, $pp, $_SESSION['order_by']);

	$n = count($products);
	
	$tpl = '';

	$tpl_temp = '<ul>';

	$block = $xtemplate->get_block_from_str($product,'PRODUCT');

	$flag = 0;

	for( $i = 0 ; $i<$n; ++$i )
	{
		$flag ++;								
	
		$price_encourage = $products[$i]['products_price'];		
		
		$price_not_discount_product = "";		

		// GIAM GIA CHO NHUNG SAN PHAM KHONG DUOC GIAM GIA
		
		//if($products[$i]['product_encourage'] == '' && $disCountVIPCustomer > 0 && $products[$i]['p_type'] == '')
		//{
			//$price_not_discount_product = $products[$i]['products_price'];																																											
			
			//$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
			
			//$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
			//$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;

			//$priceVIPCustomer = round($priceVIPCustomer / 1000);

			//$priceVIPCustomer = $priceVIPCustomer * 1000;
							
			//$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);			
														
			//$price_not_discount_product = $price_not_discount_product." VNĐ";			
			
			//$PromotionSale='<span class="promotion">
							//<span class="promotion_sale">-'.$disCountVIPCustomer.'%'.'</span>
                            //</span>';																	
		//}					
		
		if($products[$i]['product_encourage'] != '' && $products[$i]['p_type'] == '')
		{										
			$price_not_discount_product = $products[$i]['products_price'];		

			$price_encourage = (int)str_replace(".","",$products[$i]['product_encourage']);																																										
			
			$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
			
			$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
			$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;

			if( $price_encourage > $priceVIPCustomer)
			{			
				$priceVIPCustomer = round($priceVIPCustomer / 1000);

				$priceVIPCustomer = $priceVIPCustomer * 1000;
				
				$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);
				
				/*$PromotionSale='<span class="promotion">
								<span class="promotion_sale">-'.$disCountVIPCustomer.'%'.'</span>
        	                    </span>';	*/
			}												
			
			else
			{
				$price_encourage = common::convertIntToFormatMoney($price_encourage);
				
				$percent = getpercent($products[$i]['products_price'], $price_encourage);
			
				/*$PromotionSale='<span class="promotion">
								<span class="promotion_sale">-'.$percent.'</span>
        	                    </span>';	*/
			}
														
			$price_not_discount_product = $price_not_discount_product." VNĐ";																						
		}

		else
		{ 
			$PromotionSale='';
		}							

		$tpl_temp .= $xtemplate->assign_vars($block,array(

					'product_img'		 => $products[$i]['products_image'],
										
					'product_name'  	 => cut_string($products[$i]['products_name'],50),

					'product_name_nocut' => $products[$i]['products_name'],					
					
					/*'promotion_Sale'     => $PromotionSale,*/

					'product_price'   	 => $price_encourage,

					'product_price_old'  => $price_not_discount_product,

					'product_short'   	 => common::limitContent($products[$i]['products_description'],40),

					'product_key' 		 => $products[$i]['products_key'],

					'category'			 => $category_key

		));
				
		if($flag % 3 == 0 || $i > $n-2)
		{
			$tpl_temp .= ' </ul>';

			$line = '<div class="line"> </div>';

			$tpl .= $tpl_temp.$line;

			$tpl_temp = '<ul>';
		}		
	}
	
	$product = $xtemplate->assign_blocks_content($product ,array(

													'PRODUCTS'=>$tpl

	));	

	$url =  getFullUrlNotParameter();

	$url .= '/';

	$url1 = $url.'order/';

	if($pp_quan > 0)
	{
		$nav_page = pagination($linkS.$linkPage."/".$pp.'/',ceil ( $numofpages ), $page);
	}

	else
	{
		$nav_page = pagination($linkS.$linkPage."/",ceil ( $numofpages ), $page);
	}

	$product = $xtemplate->replace($product,array(

			'page'	=> $nav_page,

			'url'	=> $url,

			'url1'	=> $url1,

			'quannum' => $_SESSION['pp_quan'],

			'order_by' => $_SESSION['order_by'],

			'total_product'	=> $total,

			'self_total'	=> ((($page-1)*$pp)+1).' - '.(((($page-1)*$pp+$pp)<=$total)?(($page-1)*$pp+$pp):$total)

	));

	$content = $product;
?>

