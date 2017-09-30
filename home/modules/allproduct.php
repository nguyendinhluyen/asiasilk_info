<?php
	
	function getpercent($str1,$str2){ 				
		
		$encourage = (int)str_replace(".","",$str1);  		
		$price = (int)str_replace(".","",$str2);		
		if($encourage > $price)
		{
				$saleoff = round(($encourage - $price) / $encourage * 100);	
		}		
		$saleoff = $saleoff.'%';
		return $saleoff;                
	} 

	$content = $xtemplate->load('product');

	$Product = new Product();
	
	if($_SESSION['username']!='')
	{
		// LAY THONG TIN DUOC KHUYEN MAI CUA KHACH HANG

		$Discount_honorUser = $Product -> getDiscountOfCustomer($_SESSION['username']);

		if(intval($Discount_honorUser) > 0)
		{
			$disCountVIPCustomer = (int)$Discount_honorUser;
		}

	}

	$Category = new Category();

	$linkPage = '';

	$breadcrumbs =$Category->getCategoryPath($category_key);	

	$k = count($breadcrumbs);

	if($_GET['type']=='new')
	{

		$tilte_page = 'Sản phẩm mới';

		$breadcrumbs_path = '<a href="{linkS}">Trang chủ</a> » Sản phẩm mới';

		$products = $Product-> getProductsNewLimit(0,32);

	}else if($_GET['type']=='best'){

		$tilte_page = 'Top Sell In Week';

		$breadcrumbs_path = '<a href="{linkS}">Trang chủ</a> » Top Sell In Week';

		$products = $Product-> getProductsBestSellLimit(0,32);

	}else if($_GET['type']=='promo'){

		$tilte_page = 'Khuyến mãi trong tuần';

		$breadcrumbs_path = '<a href="{linkS}">Trang chủ</a> » Khuyến mãi trong tuần';

		$products = $Product-> getProductsPromotionLimit(0,32);
	}
		
	$n = count($products);

	$tpl = '';

	$tpl_temp ='';

	$flag = 0;

	$block = $xtemplate->get_block_from_str($content,'PRODUCT');

	for($i=0;$i<$n;++$i)
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
			
				$PromotionSale='<span class="promotion">
								<span class="promotion_sale">-'.$disCountVIPCustomer.'%'.'</span>
                            	</span>';
			}												
			
			else
			{
				$price_encourage = common::convertIntToFormatMoney($price_encourage);
				
				$percent = getpercent($products[$i]['products_price'], $price_encourage);
			
				$PromotionSale='<span class="promotion">
								<span class="promotion_sale">-'.$percent.'</span>
                            	</span>';	
			}
														
			$price_not_discount_product = $price_not_discount_product." VNĐ";
												
		}
		else 
		{	
			$PromotionSale='';		
		}
						

		$category_key = $Category->getCategoryKeyByProductKey($products[$i]['products_key']);

		$tpl_temp .= $xtemplate->assign_vars($block,array(

					'product_img'		=> $products[$i]['products_image'],

					'product_name'  	=> $products[$i]['products_name'],

					'promotion_Sale'    => $PromotionSale,			

					'product_price'   	=> $price_encourage,

					'product_price_old' => $price_not_discount_product,

					'product_short'   	=> '',

					'product_key' 		=> $products[$i]['products_key'],

					'category'			=> $category_key,
					
					'product_name_nocut' => $products[$i]['products_name']

		));
		
		if($flag%4==0 || $i>$n-2)

		{
			$tpl_temp .= ' </ul>';

			$line = '<div class="line"> </div>';

			$tpl .= $tpl_temp.$line;

			$tpl_temp = '<ul>';

		}
	}

	$content = $xtemplate->assign_blocks_content($content ,array(

													'PRODUCTS'=>$tpl,

	));
	
	$url =  getFullUrl();

	$url .="/";

	$url1  =$url."order/";

	$content = $xtemplate->replace($content,array(

			'page'	=> '',

			'url'	=> $url,

			'url1'	=> $url1,

			'self_total'=> '1 - 32',

			'total_product'	=> '32',
			
			'style_span' => 'style = "display:none"',
	));	

?>

