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
	
	$Product = new Product();

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
				
	$home = $xtemplate->load('home');

	$Category = new Category();

	$products = $Product-> getProductsNewLimit(0,15);

	$n = count($products);
			
	$tpl = '';

	$tpl_temp = '<ul>';

	$block = $xtemplate->get_block_from_str($home,'PRODUCTNEW');

	$flag = 0;

	for( $i=0 ; $i<$n ; ++$i)
	{
		$flag ++;
		
		$price_encourage = $products[$i]['products_price'];		
		
		$price_not_discount_product = "<div style='height:50px'> </div>";		
		
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
							
				$PromotionSale='<span  class="promotion">
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

					'price_not_discount_product' => $price_not_discount_product,
										
					'product_short'   	=> common::limitContent($products[$i]['description'],50),

					'product_key' 		=> $products[$i]['products_key'],

					'category'			=> $category_key

		));		

		if($flag % 3 == 0 || $i > $n-2)
		{
			$tpl_temp .= ' </ul>';

			$line = '<div class="line"> </div>';

			$tpl .= $tpl_temp.$line;

			$tpl_temp = '<ul>';			
		}
		
	}

	$home = $xtemplate->assign_blocks_content($home ,array(

													'PRODUCTSNEW'=>$tpl
	));
			
	//the best sell

	$products = $Product-> getProductsBestSellLimit(0,30);

	$n = count($products);

	$tpl = '';	

	$block = $xtemplate->get_block_from_str($home,'PRODUCT_SELL');
	
	for($i=0; $i < $n; ++$i)
	{
				
		$price_encourage = $products[$i]['products_price'];		

		$price_not_discount_product = "";				

		$margin_best_img = "style = 'margin-bottom: 25px; margin-top: 10px'";
		
		// GIAM GIA CHO NHUNG SAN PHAM KHONG DUOC GIAM GIA
		
		//if($products[$i]['product_encourage'] == '' && $disCountVIPCustomer > 0)
		//{
			//$price_not_discount_product = $products[$i]['products_price'];																																											
			
			//$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
			
			//$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
			//$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;

			//$priceVIPCustomer = round($priceVIPCustomer / 1000);

			//$priceVIPCustomer = $priceVIPCustomer * 1000;
							
			//$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);			
														
			//$price_not_discount_product = $price_not_discount_product." VNĐ";			
			
			//$PromotionSale='<span class="promotionBestSale" style = "margin-right: -5px">
							//<span class="promotionBestSale_sale">-'.$disCountVIPCustomer.'%</span>
                            //</span>';
			//$margin_best_img = "";																			
		//}	
										
		if($products[$i]['product_encourage'] != '')
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
				
				$PromotionSale='<span class="promotionBestSale" style = "margin-right: -5px">
								<span class="promotionBestSale_sale">-'.$disCountVIPCustomer.'%</span>
                    	        </span>';											
			}												
			
			else
			{
				$price_encourage = common::convertIntToFormatMoney($price_encourage);
				
				$percent = getpercent($products[$i]['products_price'], $price_encourage);
			
				$PromotionSale='<span class="promotionBestSale" style = "margin-right: -5px">
								<span class="promotionBestSale_sale">-'.$percent.'</span>
                           		</span>';											
			}
																					
			$price_not_discount_product = $price_not_discount_product." VNĐ";
			
			$margin_best_img = "";
		}

		else
		{ 
			$PromotionSale='';
		}								
				
		$category_key_sell = $Category->getCategoryKeyByProductKey($products[$i]['products_key']);

		$tpl .= $xtemplate->assign_vars($block,array(

						'product_img_sell'		=> $products[$i]['products_image'],

						'product_name_sell'  	=> $products[$i]['products_name'],
																		
						'promotion_Best_Sale'   => $PromotionSale,

						'product_price_sell'   	=> $price_encourage,
	
						'price_not_discount_price_sell' => $price_not_discount_product,
						
						'margin_best_img' => $margin_best_img,																		
						
						'product_key_sell' 		=> $products[$i]['products_key'],

						'category_sell'			=> $category_key_sell

		));	
	}

	$home = $xtemplate->assign_blocks_content($home ,array(

														'PRODUCTS_SELL'=>$tpl

	));
		
	//the best 

	//$products = $Product-> getProductsPromotionLimit(0,6);

	$products = $Product-> getProductsBestSellLimit(0,30);

	$n = count($products);

	$tpl = '';

	$tpl_temp = '<ul>';

	$block = $xtemplate->get_block_from_str($home,'PRODUCT_BEST');

	$flag = 0;

	for( $i=0 ; $i<$n ;++$i)
	{
		$flag ++;		

		$price_not_discount_product = "";		

		if($products[$i]['product_encourage'] != '')
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
				
				$PromotionSale_week = '<span class="promotion" >
									   <span class="promotion_sale">-'.$disCountVIPCustomer.'%</span>
                	                   </span> ';								
			}												
			else
			{
				$price_encourage = common::convertIntToFormatMoney($price_encourage);
				
				$percent = getpercent($products[$i]['products_price'], $price_encourage);						
			
				$PromotionSale_week = '<span class="promotion" >
									   <span class="promotion_sale">-'.$percent.'</span>
                	                   </span> ';								
			}
																		
			$price_not_discount_product = $price_not_discount_product." VNĐ";
					
		}
		else 
			$PromotionSale_week = "";

		$category_key_best = $Category->getCategoryKeyByProductKey($products[$i]['products_key']);

		$tpl_temp .= $xtemplate->assign_vars($block,array(

							'product_img_best'		=> $products[$i]['products_image'],

							'product_name_best'  	=> $products[$i]['products_name'],
							
							'promotionsale_week'    => $PromotionSale_week,

							'product_price_best'   	=> $price_encourage,

							'product_price_best_old' => $price_not_discount_product,

							'product_key_best' 		=> $products[$i]['products_key'],

							'category_best'			=> $category_key_best

		));		

		if($flag % 3 == 0 || $i> $n-2)
		{
			$tpl_temp .= ' </ul>';

			$line = '<div class="line"> </div>';

			$tpl .= $tpl_temp.$line;

			$tpl_temp = '<ul>';				
		}	
	}

	$home = $xtemplate->assign_blocks_content($home ,array(

															'PRODUCTS_BEST'=>$tpl

	));
	
	//list advs home

	$arrAdvs = GetRows('adver_id,adver_logo,adver_link', 'ads', "adver_pos = 1 and adver_status = 1");

	$list_advs = '';

	foreach($arrAdvs as $adv){

		$list_advs .= '<a target="_blank"  href="'.$adv['adver_link'].'"><img src="{linkS}upload/adver/thumb/'.$adv['adver_logo'].'" /></a> ';

	}

	//end list advs

	$home = $xtemplate->replace($home,array('list_advs'	=> $list_advs));

	$content = $home;	

?>