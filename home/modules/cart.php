<?php

	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		//GET DISCOUNT USER		
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

		$Cart = new Cart();
	
		//Edit Cart sau khi da gui don dat hang cho khach hang
		//Can kiem tra don hang da duoc giao hay chua
		
		if(isset($_GET['order_id']))
		{
			if($_GET['order_id'] > 0)
			{
				if(($_SESSION['username']==''))
				{
					$_SESSION['cart_login'] = 1;
					?>
						<script>
							window.location="<?php echo $linkS.'dang-nhap'; ?>";
						</script>                                                
					<?php					
				}

				else
				{
					if($Cart -> checkOrderOfUser($_GET['order_id'], $_SESSION['username']) == 1)
					{
					   	$Cart -> getOrderToCart($_GET['order_id']);
						
						$_SESSION['order_id'] = $_GET['order_id'];
					}
				}
			}
		}
					
		//end edit cart
	
		//delete item cart
		if(isset($_POST['deleteItem']))
		{
			$proItemStt = ($_POST['check_cart']);

			$proKey = ($_POST['product_key']);

			$proType = ($_POST['type']);

			$proColor = ($_POST['color']);
			
			foreach ($proItemStt as $val)
			{
			
				$Cart->removeProduct($proKey[$val],$proType[$val],$proColor[$val]);
				
			}
		}
		//end delete item cart
	
		//update quantity item cart
		if(isset($_POST['updateQuan'])){
			$proKey = ($_POST['product_key']);
			$proType = ($_POST['type']);
			$proColor = ($_POST['color']);
			$quantity = ($_POST['quantity']);
			$prices = ($_POST['prices']);
			
			$n = count($proKey);
			for($i = 0; $i < $n; ++$i){
				$Cart->addProduct($proKey[$i], $proColor[$i],$proType[$i],$prices[$i],$quantity[$i], 1);//0 add; 1 edit
			}
		}
		//end update quantity item cart
	
		$product_key = input($_GET['product_key']);
		$quantity = input($_POST['quantity']);
		$typeS = input($_POST['type']); //type and price
		$color = input($_POST['color']);
		$add = input($_GET['add']);
		$empty = input($_GET['em']);
		
		//get edit
		$edit = input($_GET['edit']);
		
		//get delete
		$del = input($_GET['del']);
		
		$arType = explode('::',$typeS);//array type and price

		$type = $arType[0];

		$price = $arType[1];																		
		
		if($price == '')
		{												

			$product_detail = $Product->getProductsByProductKey($product_key);
			
			$price = $product_detail['products_price'];			
			
			// GIAM GIA CHO NHUNG SAN PHAM KHONG DUOC GIAM GIA
		
			if($product_detail['product_encourage'] == '' && $disCountVIPCustomer > 0)
			{
				$price_not_discount_product = $product_detail['products_price'];																																											
				
				$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
				
				$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
										
				$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;
	
				$priceVIPCustomer = round($priceVIPCustomer / 1000);
	
				$priceVIPCustomer = $priceVIPCustomer * 1000;
								
				$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);																				

				$price = $price_encourage;
							
			}	
																											
			else if($product_detail['product_encourage'] != '')
			{				
								
				$price_not_discount_product = $product_detail['products_price'];		

				$price_encourage = (int)str_replace(".","",$product_detail['product_encourage']);																																										
			
				$price_of_product = (int)str_replace(".","",$price_not_discount_product);					
			
				$priceDiscountVIPCustomer = ($price_of_product * $disCountVIPCustomer)/100;	
									
				$priceVIPCustomer = $price_of_product - $priceDiscountVIPCustomer;

				if( $price_encourage > $priceVIPCustomer)
				{			
					$priceVIPCustomer = round($priceVIPCustomer / 1000);
		
					$priceVIPCustomer = $priceVIPCustomer * 1000;
					
					$price_encourage = common::convertIntToFormatMoney($priceVIPCustomer);
				}												
			
				else
				{
					$price_encourage = common::convertIntToFormatMoney($price_encourage);
				}														

				$price = $price_encourage;
			}
		}																		
			
		//remove cart
		if($del == 1)
		{
			$Cart->removeProduct($product_key,$type,$color);
		}

		//edit cart
		$flag = 0;
		
		if($edit == 1)
		{
			$flag = 1;
		}
		
		if($edit==1 || $add == 'add')
		{
			$Cart->addProduct($product_key, $color,$type,$price,$quantity, $flag);//0 add; 1 edit
		}
		
		$emty_cart = 0;
		
		if($empty == 1)
		{
			$Cart->emptyProduct();
			$emty_cart = 1;
		}

		$cart = $xtemplate->load('cart2');		

		$blocks = $xtemplate->get_block_from_str($cart,'LISTCART');

		if(isset($_SESSION['cart']))
		{						
			$total =0;

			$cartList ='';

			$i = 0;

			$Category = new  Category();

			$list_product = "";

			foreach ($_SESSION['cart'] as $keys)
			{	
				$rows_pro_detail = $Product->getProductsByProductKey($keys['product_key']);
				
				$category_key = $Category->getCategoryKeyByProductKey($keys['product_key']);				
				
				if($keys['price'] != '')
				{
					$p_price = $keys['price'];
				}
								
				if($keys['color'] !='')
				{
					
					$color_des = "<li><span>".$rows_pro_detail['p_attribute'].":</span> <b style ='font-size:10px'>".$keys['color']."</b>&nbsp;</li>";
				}
																
				if($keys['type'] !='')
				{
					$type_des = "<li><span>Loại:</span> <b style ='font-size:10px'>".$keys['type']."</b>&nbsp;</li>";
				}
				
				$sua_don_hang = '';
				
				if(isset($_SESSION['order_id']) && $_SESSION['order_id'] >0)
				{
					$sua_don_hang = '<b style="color: red;">Bạn đang ở chế độ sửa đơn hàng số '.$_SESSION['order_id'].'</b>&nbsp;&nbsp;<a href="'.$linkS.'reset-update.chm">Hủy</a>';
				}
				
				$tmp_cart = $xtemplate->assign_vars($blocks,array(
										'product_image' => $rows_pro_detail['products_image'],
										'product_name'  => $rows_pro_detail['products_name'],
										'price'   		=> $p_price,
										'product_key' 	=> $rows_pro_detail['products_key'],
										'price_unit' 	=> "VNĐ",
										'product_id' 	=> $rows_pro_detail['products_id'],
										'quantity' 		=> $keys['quantity'],
										'total_one' 	=> common::convertIntToFormatMoney(common::convertFormatMoneyToInt($p_price) * $keys['quantity']),
										'type'			=> $keys['type'],
										'color'			=> $keys['color'],
										'color_des'		=> $color_des,
										'type_des'		=> $type_des,
										'stt'			=>  $i,
										'category'		=> $category_key,
										'stt_item'		=> ($i)							
				));
	
				$cartList .= $tmp_cart;
				$total += common::convertFormatMoneyToInt($p_price) * $keys['quantity'];
				$total_product += $keys['quantity'];//public
				$total_price = common::convertIntToFormatMoney($total);//public
				$i++;
				$list_product .= $rows_pro_detail['products_name'].',';
			}
		}
	
		$_SESSION['total_price'] = common::convertIntToFormatMoney($total);
		if(count($_SESSION['cart']) == 0)
		{
			$cart = '<div id="product">
						<div id="breakcrumb" style="margin-top:20px; font-size: 14px; font-family: Cambria">{breadcrumbs_path}</div>
						<div class="product_main" style="font-family:Cambria; font-size: 20px; padding-top: 20px"><center><i>Hiện chưa có sản phẩm nào trong giỏ hàng của bạn</i></center></div></div>';
			$cart.= '<script type="text/javascript">
						$(document).ready(function(){
						$.ajax({
							type: "POST",
							url: "{linkS}home/modules/ajax/cart_right.php",
							data: {},
							success: function(data)
							{
								//alert(msg);
								$("#main-cart").html(data);
							}
						});
					});
					</script>';
		}
	
		$cart= $xtemplate->assign_blocks_content($cart ,array(
																'LISTCART'=>$cartList,
													));
	
		$cart = $xtemplate->replace($cart,array(
												  'total' => common::convertIntToFormatMoney($total),
												   'price_unit' => 'VNĐ',
													'sua_don_hang'	=>$sua_don_hang,
													'emty_cart'	=> $emty_cart,
													'list_product'	=> ($list_product),
													'total_price'	=> $total,
												));
		$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
		$breadcrumbs_path .= ' &raquo; '.'Giỏ hàng';
		$tilte_page =   'Giỏ hàng'. " | ASIASILK";
		$content = $cart;
	}
	else
	{
		?>            
            <script>
				window.location="<?php echo $linkS.'dang-nhap'; ?>";
			</script>

        <?php
	}
?>