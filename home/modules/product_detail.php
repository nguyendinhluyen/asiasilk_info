<?php
	
	$user_name = $_SESSION['username'];		

	//VI TRI THEM DIEU CHINH TIEN TE
	function formatMoney($number, $fractional = false) 
	{ 
		if ($fractional) 
		{ 
			$number = sprintf('%.2f', $number); 
		} 
		while (true) 
		{ 
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number); 
			if ($replaced != $number) 
			{ 
				$number = $replaced; 
			} 
			else 
			{ 
				break; 
			} 
		} 
    	return $number; 
	} 	
	
	function newFunction($str1,$str2)
	{   		
        $encourage = (int)str_replace(".","",$str1);  		
		
		$price = (int)str_replace(".","",$str2);	
		
		if($encourage > $price)
		{
			$saleoff = $encourage - $price;				
		}

		return formatMoney($saleoff);
	} 
	
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
	
	$product_key = input($_GET['product_key']);

	$productdetail = $xtemplate->load('product_detail');	

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

	$product_detail = $Product->getProductsByProductKey($product_key); // home/model/Product.php

	$proType = $Product->getProductsType($product_detail['p_type']);

	$proColor = $Product->getProductsColor($product_detail['p_color']);

	$breadcrumbs = $Product->getProductPath($product_key);
	
	$breadcrumbs_path = '';

	$breadcrumbs_path .= '<a href="{linkS}">Trang chính</a>';

	$k = count($breadcrumbs);

	$num_bread = $k;

	$tilte = array();

	for ($i=$k;$i>=0;$i--){

		if($breadcrumbs[$i]['name'] != '')

		{

			$tilte[] =  $breadcrumbs[$i]['name'];

			$breadcrumbs_path .= ' &raquo; <a href="{linkS}'.$breadcrumbs[$i]['key'].'.htm">'.$breadcrumbs[$i]['name'].'</a>';

		}

	}

	$category_c = $breadcrumbs[0]['key'].".htm";//category;

	$breadcrumbs_path .= ' &raquo; '. $product_detail['products_name'];

	$tilte_page = $product_detail['products_name'] ." | ";

	$k = count($tilte);

	for ($i=$k;$i>=0;$i--){

		if($tilte[$i] !='')

			$tilte_page .= $tilte[$i]. " | ";

	}

	$tilte_page .='ASIASILK';

	$n = count($proColor);

	$m = count($proType);

	$colorTemplate = '';	

	$p_attribute = $product_detail['p_attribute'];

	if($p_attribute == ''){

		$p_attribute = "Đặc Điểm :";

	}

	if($proColor[0]!=''){

		$colorTemplate .= '<tr style="vertical-align:top;">

						<td class="sp_info1" ><span class="rect">'.$p_attribute.'</span></td>

						<td class="sp_info2" align="right"><span class="promotion1">';

		$colorTemplate .='<table border="0" cellpadding="0" cellspacing="0" style="" align="right">';//width:174%; 

		$i = 0;

		foreach ($proColor as $val){

			$colorTemplate .='<tr><td>';			   

			if($i==0){

				$colorTemplate .='<input type="radio" name="color" id="color" checked value="'.$val.'" />'.'</td> <td align="right" style="">'.$val;

			}

			else{

				$colorTemplate .='<input type="radio" name="color" id="color" value="'.$val.'" />'.'</td> <td align="right" style="">'.$val;

			}

			$colorTemplate .='</td></tr>';

			$i ++;

		}

		$colorTemplate .='</table>';

		$colorTemplate .= '</span></td></tr>';
	}
	
	$typeTemplate = '';

	if($proType[0]['price'] != null)
	{

		$typeTemplate .= '<tr style="vertical-align:top;">

							<td class="sp_info1"><span class="rect">Loại : </span></td>

							<td class="sp_info2"><span class="promotion1">';		

		$typeTemplate .='<table border="0" cellpadding="0" cellspacing="0" style="width:170px;" align="left>"';

		$i = 0;

		foreach ($proType as $val){ 

			$pri = $val['price'];

			if($pri ==''){

				$pri = $product_detail['products_price'];

			}

			$typeTemplate .='<tr><td>';

			if($i==0)
			{
				$typeTemplate .=$val['type'].' (='.$pri.')'.'&nbsp;</td> <td width="10px;"><input type="radio" id="type" name="type" checked value="'.$val['type'].'::'.$pri.'" />';

			}
			
			else
			{
				$typeTemplate .=$val['type'].' (='.$pri.')'.'&nbsp;</td> <td width="10px;"><input type="radio" id="type" name="type"  value="'.$val['type'].'::'.$pri.'" />';

			}

			$i++;

			$typeTemplate .='</td></tr>';
		}

		$typeTemplate .='</table>';

		$typeTemplate .= '</span></td></tr>';
	}		
	
	$price_encourage = $product_detail['products_price'];				
		
	//$typeTemplate = '' Dam bao san pham khong co loai san pham thì moi co khuyen mai va khuyen mai thanh vien
	
	// GIAM GIA CHO NHUNG SAN PHAM KHONG DUOC GIAM GIA
	
	if($product_detail['product_encourage'] == '' && $disCountVIPCustomer > 0 && $product_detail['p_type'] == '')
	{
		$price_not_discount_product = $product_detail['products_price'];																																											
			
		$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
			
		$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
		$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;

		$priceVIPCustomer = round($priceVIPCustomer / 1000);

		$priceVIPCustomer = $priceVIPCustomer * 1000;								
							
		$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);			
		
		$price_saleoff = $price_of_product - $priceVIPCustomer;		
		
		$price_saleoff = common::convertIntToFormatMoney($price_saleoff);	 
		
		$levelOfCustomer = $Product -> levelOfCustomer($_SESSION['username']);
	
		if($levelOfCustomer != 'normal' && $levelOfCustomer != 'Normal')
		{
			$khuyenmai = '
						<tr style="vertical-align:top;">
                        	<td class="sp_info1" ><span class="rect" style = "color:red">Khuyến mãi <span>('.$levelOfCustomer.')</span></span></td>
                          	<td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$price_encourage.'</span></td>
                        </tr>      
                       	
						<tr>
	                      	<td class="sp_info1"><span class="rect">Giá sản phẩm  </span></td>
	                      	<td class="sp_info2"><span class="promotion"> '.$product_detail['products_price'].'</span></td>
	                  	</tr>
	                   	
						<tr>
                          	<td class="sp_info1"><span class="rect">Tiết kiệm  </span></td>
                            <td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$price_saleoff.' (-'.$disCountVIPCustomer.'%)</span></td>
                        </tr>';
		}																						

	}	

	else if($product_detail['product_encourage'] != '' && $product_detail['p_type'] == '')
	{		
				
		$price_encourage = (int)str_replace(".","",$product_detail['product_encourage']);																																										

		$price_of_product = (int)str_replace(".","",$product_detail['products_price']);					
			
		$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
		$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;		

		if( $price_encourage > $priceVIPCustomer)
		{			
			$priceVIPCustomer = round($priceVIPCustomer / 1000);

			$priceVIPCustomer = $priceVIPCustomer * 1000;
				
			$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);

			$produce_discount = $disCountVIPCustomer."%";
																
		}										
		else
		{
			$price_encourage = common::convertIntToFormatMoney($price_encourage);
			
			$produce_discount = getpercent($product_detail['products_price'], $price_encourage);
		}		
		
		$produce_save = newFunction($product_detail['products_price'], $price_encourage);
				
		$levelOfCustomer = $Product -> levelOfCustomer($_SESSION['username']);
	
		if($levelOfCustomer != 'normal' && $levelOfCustomer != 'Normal')
		{
			$khuyenmai = '
						<tr style="vertical-align:top;">
                        	<td class="sp_info1" ><span class="rect" style = "color:red">Khuyến mãi <span>('.$levelOfCustomer.')</span></span></td>
                          	<td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$price_encourage.'</span></td>
                        </tr>      
                       	
						<tr>
	                      	<td class="sp_info1"><span class="rect">Giá sản phẩm  </span></td>
	                      	<td class="sp_info2"><span class="promotion"> '.$product_detail['products_price'].'</span></td>
	                  	</tr>
	                   	
						<tr>
                          	<td class="sp_info1"><span class="rect">Tiết kiệm  </span></td>
                            <td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$produce_save.' (-'.$produce_discount.')</span></td>
                        </tr>';
		}
		
		else
		{
			$khuyenmai = '
						<tr style="vertical-align:top;">
                        	<td class="sp_info1" ><span class="rect">Giá khuyến mãi</span></td>
                          	<td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$price_encourage.'</span></td>
                        </tr>      
                       	
						<tr>
	                      	<td class="sp_info1"><span class="rect">Giá sản phẩm  </span></td>
	                      	<td class="sp_info2"><span class="promotion"> '.$product_detail['products_price'].'</span></td>
	                  	</tr>
	                   	
						<tr>
                          	<td class="sp_info1"><span class="rect">Tiết kiệm  </span></td>
                            <td class="sp_info2"><span class="promotion" style="color: #ED1B24;">'.$produce_save.' (-'.$produce_discount.')</span></td>
                        </tr>';
		}
	}

	else 
	{
		$khuyenmai ='  
						<tr>
	                      <td class="sp_info1"><span class="rect">Giá sản phẩm</span></td>
	                      <td class="sp_info2"><span class="promotion"> '.$product_detail['products_price'].'</span></td>  

	                  	</tr>';
	}		
	

	if($product_detail['products_id'] > 0)
	{

		$imgs = $Product->getProductImagessByProductId($product_detail['products_id']);

		$k = count($imgs);

		$tpl_imgs = '';

		for($p = 0; $p<$k;++$p)
		{
			$tpl_imgs .= '<a href="'.$linkS.'upload/product_detail/'.$imgs[$p]['image_path'].'" class="cloud-zoom-gallery" title="Red" rel="useZoom: \'zoom1\', smallImage: \''.$linkS.'upload/product_detail/image.php?file='.$imgs[$p]['image_path'].'&sizex=200\' "><img  src="'.$linkS.'upload/product_detail/image.php?file='.$imgs[$p]['image_path'].'&sizex=40&sizey=50" /></a>';

		}

		if($k > 0 ){

			$tpl_imgs = '<a href="'.$linkS.'upload/product/thumb/'.$product_detail['products_image'].'" class="cloud-zoom-gallery" title="Red" rel="useZoom: \'zoom1\', smallImage: \''.$linkS.'upload/product/thumb/image.php?file='.$product_detail['products_image'].'&sizex=200\' "><img  src="'.$linkS.'upload/product/thumb/image.php?file='.$product_detail['products_image'].'&sizex=40&sizey=50" /></a>'.$tpl_imgs;

		}

	}	

	$category_key = input($_GET['category_key']);

	$product_name_prev = $Product->getProductsInfoPrevByProductKey($product_key,$breadcrumbs[0]['key']);// $category_key

	$product_name_next = $Product->getProductsInfoNextByProductKey($product_key,$breadcrumbs[0]['key']);//$category_key

	$pro_price_nodot = common::convertFormatMoneyToInt($price_encourage);
	
	$linkPrev = $breadcrumbs[0]['key'].'/'.$product_name_prev['products_key'].'.htm';

	$linkNext = $breadcrumbs[0]['key'].'/'.$product_name_next['products_key'].'.htm';
	
	$pre_name = '';

	$next_name = '';

	if($product_name_prev['products_name'] !=''){

		$pre_name = '<< '.$product_name_prev['products_name'];

	}

	if($product_name_next['products_name'] !=''){

		$next_name = $product_name_next['products_name'].' >>';

	}

	$species = $product_detail['species'];

	$img_catdog = '';

	if($species == '10')
	{
		
		$img_catdog = '<img src="{linkS}layout/images/animal_dog.png"/>';

	}

	if($species == '01')
	{

		$img_catdog = '<img src="{linkS}layout/images/animal_cat.png"/>';

	}

	if($species == '11')
	{

		$img_catdog = '<img src="{linkS}layout/images/animal_couple.png"/>';

	}	

	$ua_thich = '';//them vao ua thich

	if(isset($_SESSION['username']) && $_SESSION['username'] != ''){

		$ua_thich = 'Ưa Thích';

	}	

	//comment

	//$form_comment = $xtemplate->load('comment_product');	

	//end comment	

	$rate = $Product -> calculationAvgRate($product_detail['products_id']);	
	
	$result_sum_count = $Product -> calculationRate($product_detail['products_id']);	
	
	
	if($result_sum_count[0]['sum'] == "")
	{
		$rate_sum = 0;
	}
	else
	{
		$rate_sum = $result_sum_count[0]['sum'];
	}
	
	if( $result_sum_count[0]['total'] == "" )
	{
		$rate_count = 0;
	}
	else
	{
		$rate_count = $result_sum_count[0]['total'];	
	}	
	
	$rate_round = ceil($rate);

	if($rate_round > 0)
	{		
		for($j=0 ; $j<$rate_round ; $j++)
		{
			$listrate .= "<img src='".$linkS."layout/images/star.png' />";
		}
	}
	else if($rate == 0)
	{
		$listrate = '<a style="font-size: 10px;color:red">Chưa có đánh giá</a>';
	}
	
	//VI TRI THEM
	
	$product_status = $product_detail['status'];
	
	$hidden = '';
	
	$product_status_name  = '';
	
	if($product_status == 'Co Hang')
	{
		$product_status_name = 'Còn Hàng';
	}
		
	else if($product_status == 'Tam Thoi Het Hang')
	{
		$product_status_name = 'Hết Hàng';
		$hidden='hidden = "hidden"';
	}
	
	else if($product_status == 'Sap Co Hang')
	{
		$product_status_name = 'Sắp Có Hàng';
		$hidden='hidden = "hidden"';
	}
	
	else if($product_status == 'Dat Hang Truoc')
	{
		$product_status_name = 'Đặt Trước';		
	}
	
	else
		$product_status_name = 'Còn Hàng';			
		
	if(empty($product_detail['product_detail']) && empty($product_detail['product_detail_tacdung'])
	   &&empty($product_detail['product_detail_phuhopcho']) && empty($product_detail['product_detail_nguyenlieu_thanhphan'])
	   &&empty($product_detail['product_detail_phantichdambao']) && empty($product_detail['product_detail_huongdansudung'])
	   &&empty($product_detail['product_detail_huongdanbaoquan']) && empty($product_detail['product_detail_luuy'])
	   &&empty($product_detail['product_detail_khuyenkhich']) && empty($product_detail['product_detail_donggoi_thetich'])
	   &&empty($product_detail['product_detail_nhasanxuat']) && empty($product_detail['product_detail_xuatxu']))
	{
		$product_detail['product_detail'] = "Chưa có thông tin chi tiết về sản phẩm ". $product_detail['products_name'];
	}

	$facebook_comment = '
						<table style="float: left; margin-left: -10px">						
							<tr>								
								<td>
									<img src="{linkS}layout/images/talk-together.png" style="width:37px; height:40px; margin-left:25px; margin-bottom:10px; opacity:0.8" title="Ý kiến sản phẩm!"/>
								</td>							
								<td>
									<div style="font-family:Cambria; font-size: 15px; margin-bottom: 5px; color:#A00;  font-weight:bold;width: 670px">									
										<span style="float:left;">Hãy cho ý kiến của bạn về sản phẩm này</span>
										<span style="float:left; margin-left: 150px">Đánh giá sản phẩm : </span>
										<span id="jqxRating" style="float:right;"/>
									</div>																
								</td>							
							</tr>						
						</table>
						<div class="fb-comments" style = "margin-left:20px" data-href="{linkSf}{link_san-pham}" data-numposts="5" data-width ="710px">						
						</div>';
						
	$category_key = $_GET['category_key'];
		
	$display_product_detail = "block";
					
	$display_product_detail_tacdung = "block";
						
	$display_product_detail_phuhopcho = "block";
						
	$display_product_detail_nguyenlieu_thanhphan = "block";
						
	$display_product_detail_phantichdambao = "block";
						
	$display_product_detail_huongdansudung = "block";
						
	$display_product_detail_huongdanbaoquan = "block";
						
	$display_product_detail_luuy = "block";
						
	$display_product_detail_khuyenkhich = "block";
						
	$display_product_detail_donggoi_thetich = "block";
						
	$display_product_detail_nhasanxuat = "block";
						
	$display_product_detail_xuatxu = "block";
	

	if(empty($product_detail['product_detail']))
	{		
		$display_product_detail = "none";	
	}
	
	if(empty($product_detail['product_detail_tacdung']))
	{		
		$display_product_detail_tacdung = "none";	
	}
	
	if(empty($product_detail['product_detail_phuhopcho']))
	{		
		$display_product_detail_phuhopcho = "none";	
	}
	
	if(empty($product_detail['product_detail_nguyenlieu_thanhphan']))
	{		
		$display_product_detail_nguyenlieu_thanhphan = "none";	
	}
	
	if(empty($product_detail['product_detail_phantichdambao']))
	{		
		$display_product_detail_phantichdambao = "none";	
	}
	
	if(empty($product_detail['product_detail_huongdansudung']))
	{		
		$display_product_detail_huongdansudung = "none";	
	}
	
	if(empty($product_detail['product_detail_huongdanbaoquan']))
	{		
		$display_product_detail_huongdanbaoquan = "none";	
	}
	
	if(empty($product_detail['product_detail_luuy']))
	{		
		$display_product_detail_luuy = "none";	
	}
	
	if(empty($product_detail['product_detail_khuyenkhich']))
	{		
		$display_product_detail_khuyenkhich = "none";	
	}	
	
	if(empty($product_detail['product_detail_donggoi_thetich']))
	{		
		$display_product_detail_donggoi_thetich = "none";	
	}
	
	if(empty($product_detail['product_detail_nhasanxuat']))
	{		
		$display_product_detail_nhasanxuat = "none";	
	}
	
	if(empty($product_detail['product_detail_xuatxu']))
	{		
		$display_product_detail_xuatxu = "none";	
	}
	
	$productdetail  = $xtemplate->replace($productdetail,array(										
					
					'form_comment'		=> $facebook_comment,

					'linkSf'			=> "http://asiasilk.info.vn/",

					'link_san-pham' 	=> $category_key."/".$product_detail['products_key'].".htm",

					'khuyenmai'			=> $khuyenmai,

					'product_name'		=> $product_detail['products_name'],

					'product_image'		=> $product_detail['products_image'],

					'product_detail'	=> $product_detail['product_detail'],
					
					'product_detail_tacdung'				=> $product_detail['product_detail_tacdung'],
					
					'product_detail_phuhopcho'				=> $product_detail['product_detail_phuhopcho'],
					
					'product_detail_nguyenlieu_thanhphan'	=> $product_detail['product_detail_nguyenlieu_thanhphan'],
					
					'product_detail_phantichdambao'			=> $product_detail['product_detail_phantichdambao'],
					
					'product_detail_huongdansudung'			=> $product_detail['product_detail_huongdansudung'],
					
					'product_detail_huongdanbaoquan'		=> $product_detail['product_detail_huongdanbaoquan'],
					
					'product_detail_luuy'					=> $product_detail['product_detail_luuy'],
					
					'product_detail_khuyenkhich'			=> $product_detail['product_detail_khuyenkhich'],
					
					'product_detail_donggoi_thetich'		=> $product_detail['product_detail_donggoi_thetich'],
					
					'product_detail_nhasanxuat'				=> $product_detail['product_detail_nhasanxuat'],
					
					'product_detail_xuatxu'					=> $product_detail['product_detail_xuatxu'],															
										
					'display_product_detail'						=> $display_product_detail,
					
					'display_product_detail_tacdung'				=> $display_product_detail_tacdung,
					
					'display_product_detail_phuhopcho'				=> $display_product_detail_phuhopcho,
					
					'display_product_detail_nguyenlieu_thanhphan'	=> $display_product_detail_nguyenlieu_thanhphan,
					
					'display_product_detail_phantichdambao'			=> $display_product_detail_phantichdambao,
					
					'display_product_detail_huongdansudung'			=> $display_product_detail_huongdansudung,
					
					'display_product_detail_huongdanbaoquan'		=> $display_product_detail_huongdanbaoquan,
					
					'display_product_detail_luuy'					=> $display_product_detail_luuy,
					
					'display_product_detail_khuyenkhich'			=> $display_product_detail_khuyenkhich,
					
					'display_product_detail_donggoi_thetich'		=> $display_product_detail_donggoi_thetich,
					
					'display_product_detail_nhasanxuat'				=> $display_product_detail_nhasanxuat,
					
					'display_product_detail_xuatxu'					=> $display_product_detail_xuatxu,	
										
					'product_price'		=> $price_encourage,											
					
					'product_save'		=> newFunction(($product_detail['products_price']),($price_encourage)),
	
					'product_discount'	=> getpercent(($product_detail['products_price']),($price_encourage)),															
	
					'product_color'		=> $colorTemplate,

					'product_type'		=> $typeTemplate,

					'p_unit'			=> $product_detail['p_unit'],

					'product_key'		=> $product_detail['products_key'],

					'rate_data'			=> $product_detail['products_id'],

					'category'			=> $category_c,

					'nsx'				=> $product_detail['manufacturer'],

					'total_amount'			=> $pro_price_nodot,

					'product_price_nodot'	=> $pro_price_nodot,

					'product_quantity'		=> '1',

					'count_rates'		=> $listrate,

					'list_img_product'	=> $tpl_imgs,

					'product_name_prev'	=> $pre_name,

					'product_name_next' => $next_name,

					'linkPrev'			=> $linkPrev,

					'linkNext'			=> $linkNext,

					'img_catdog'		=> $img_catdog,

					'email'				=> $_SESSION['username'],

					'them_vao_ua_thich'	=> $ua_thich,

					'user'				=> $_SESSION['username'],

					'id_product'		=> $product_detail['products_id'],

					'xuatxu'			=> $product_detail['origin'],

					'linknsx'			=> $product_detail['manufacturer_link'],					
					
					'status'            => $product_status_name,
					
					'hidden' 			=> $hidden,
					
					'user_name'			=> $user_name,
					
					'rate_sum'			=> $rate_sum, 

					'rate_count'		=> $rate_count
	));	
	
	$content = $productdetail;	
?>

