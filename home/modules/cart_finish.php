<?php
	$finish = input($_GET['finish']);
	if(($_SESSION['username']==''))
	{
		$_SESSION['cart_login'] = 1;		

		?>
			<script type="text/javascript">
                window.location = "<?php echo $linkS.'dang-nhap';?>";
            </script>
		<?php
		
	}
	else
	{
		if(isset($_POST['finish']))
		{
			$txtHoten 		= input($_POST['txtHoten'],1);
			$txtDienthoai 	= input($_POST['txtDienthoai'],1);
			$txtEmail 		= input($_POST['txtEmail'],1);
			$txtDiachi		= input($_POST['txtDiaChi'],1);
			$txtGhichu		= input($_POST['txtNoidung']);										
			// VI TRI THEM CAC THONG TIN NGUOI NHAN			
			$txtHotenNguoiNhan 		= input($_POST['txtHotenNguoiNhan'],1);
			$txtDienthoaiNguoiNhan 	= input($_POST['txtDienthoaiNguoiNhan'],1);
			$txtDiachiNguoiNhan		= input($_POST['txtDiachiNguoiNhan'],1);			
			$fee_transport  = input($_POST['txtfeetransport'],1);										
			$type_of_cash  = input($_POST['txttypeofcash'],1);										
			$total_product_fee  = input($_POST['txttotalproductfee'],1);													
			$userInfo = array(  'name'=>$txtHoten,
								'phone'=>$txtDienthoai,
								'email'=>$txtEmail,
								'address'=>$txtDiachi,								
								'namereceiver' =>$txtHotenNguoiNhan,
								'phonereceiver' =>$txtDienthoaiNguoiNhan,
								'addressreceiver' =>$txtDiachiNguoiNhan,
								'feetransport' => $fee_transport,
								'typeofcash'  => $type_of_cash,
								'totalproductfee' => $total_product_fee
								);
			
			$cartFinish = $xtemplate->load('cart_finish');
			
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'<a href="{linkS}gio-hang">Giỏ hàng</a>'.' &raquo; '.'Hoàn thành mua hàng';
			$cart = $_SESSION['cart'];
			
			//===========================================================================
			//Khiem
			
			//Thay doi cach update/insert 1 gio hang vao db
			$CartModel = new CartModel();
			
			$orderID = $_SESSION['order_id'];
			
			if(isset($_SESSION['order_id']) && $_SESSION['order_id'] >0)
			{				
				
				$tbl_order_status = GetOneRow("status","tbl_order","id = '".$_SESSION['order_id']."'");					
				
				if($tbl_order_status["status"] != 1)
				{
					$Cart = new Cart();
					
					$Cart -> updateCart($_SESSION['order_id'], $cart, $userInfo);				
					
					unset($_SESSION['order_id']);										
				}
				else
				{					
					?>
                    	<script>
                        	alert("Đơn hàng đã được giao! Không chỉnh sữa được");							
							window.location = "<?php echo $linkS.'gio-hang';?>";
						</script>
                    <?php
					return;
				}
			}
			else
			{
				$orderID = $CartModel->saveOrder($cart,$userInfo);
			}
														
			// Send mail to client
			$date_now = getdate();
			$m_now = $date_now["mon"]>9?$date_now["mon"]:'0'.$date_now["mon"];
			$d_now = $date_now["mday"]>9?$date_now["mday"]:'0'.$date_now["mday"];
			$y_now = $date_now['year'];
			$h_now = $date_now['hours'];
			$mi_now = $date_now['minutes'];
			$day_now = $m_now.'-'.$d_now;				
			$time = "ngày $d_now tháng $m_now năm $y_now, lúc $h_now : $mi_now";
			$User = new User();
			$_user = $User->getUserInfo($_SESSION['username']);
			$mail_to = $_user['email'];
			$mail_nameto = $_user['name'];
			$mail_body = $CartModel->Get_html_mail_body($cart, $userInfo, $_user,$time, $orderID, $txtGhichu,'mail_form_to_client');				
			$mail_subject = "ASIASILK - Don hang #$orderID tại ASIASILK";
			$sent_success = false;									
										
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
			// Additional headers
			$headers .= 'To: '.$mail_nameto. "\r\n";
			$headers .= 'From:'.'asiasilk.info.vn' . "\r\n";										
						
			if(mail($mail_to, $mail_subject, $mail_body, $headers))				
			{
				// Send mail to admin				
				$mail_to = GetConfig('mail_admin');				
				$mail_body = $CartModel->Get_html_mail_body($cart, $userInfo, $_user,$time, $orderID, $txtGhichu,'mail_form_to_admin');				
				$mail_nameto = 'admin';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";				
				// Additional headers
				$headers .= 'To: '.$mail_nameto. "\r\n";
				$headers .= 'From:'.'asiasilk.info.vn' . "\r\n";					
				if(!mail($mail_to, $mail_subject, $mail_body, $headers))
				{
					?>
                    	<script>
                        	alert("Đơn hàng quý khách đã lưu trên hệ thống! Cảm ơn quý khách");							
							window.location = "<?php echo $linkS;?>";
						</script>
                    <?php				
				}
			}
			else
			{
				?>
                    <script>
                        alert("Đơn hàng quý khách đã lưu trên hệ thống! Cảm ơn quý khách");							
						window.location = "<?php echo $linkS;?>";
					</script>
               	<?php
			}
			
			unset($_SESSION['total_price']);
		}
		
		else
		{
			$cartFinish = $xtemplate->load('cart_person');			
			$blocks = $xtemplate->get_block_from_str($cartFinish,'LISTCART');
			// Xu ly chuoi thong tin fee van chuyen			
			$transport_Fee = $Product->getGalaryTransportFee();
			$arrlength = count($transport_Fee);
			$dataFee = '';
			for($x = 0; $x < $arrlength; $x++)
  			{							
				if($x < $arrlength - 1)
				{
					$dataFee = $dataFee.$transport_Fee[$x]['galary_district_name'].'-'.$transport_Fee[$x]['galary_begin_price'].'-'.$transport_Fee[$x]['galary_end_price'].'-'.$transport_Fee[$x]['galary_fee'].' nanapet ';
				}
				if($x == $arrlength - 1)
				{
					$dataFee = $dataFee.$transport_Fee[$x]['galary_district_name'].'-'.$transport_Fee[$x]['galary_begin_price'].'-'.$transport_Fee[$x]['galary_end_price'].'-'.$transport_Fee[$x]['galary_fee'];
				}
			}
			
			$dataFee = str_replace('.','',$dataFee);												
						
			if(isset($_SESSION['cart']))
			{
				$total =0;
				$cartList ='';
				foreach ($_SESSION['cart'] as $keys)
				{
					$rows_pro_detail = $Product->getProductsByProductKey($keys['product_key']);
					$p_price = $rows_pro_detail['products_price'];
					if($keys['price'] != ''){
						$p_price = $keys['price'];
					}
					
					$description ='';
					if($keys['color'] !=''){
						$description .=  'Màu '.$keys['color'];
						$color_des = "<li><span>Màu sắc:</span>".$keys['color']."&nbsp;</li>";
					}
					if($description != ''){
						$description .= "-".$keys['type'].' (='.$keys['price'].' VNĐ)';
					}
					else{
						$description .= $keys['type'].' (='.$keys['price'].' VNĐ)';
					}

					if($keys['type'] !=''){
						$type_des = "<li><span>Loại:</span>".$keys['type']."&nbsp;</li>";
					}
						
					$tmp_cart = $xtemplate->assign_vars($blocks,array(
						                        'product_image' => $rows_pro_detail['products_image'],
						                        'product_name'  => $rows_pro_detail['products_name'],
						                        'price'   		=> $p_price,
						                        'product_key' 	=> $rows_pro_detail['products_key'],
						                        'price_unit' 	=> $rows_pro_detail['price_unit'],
						                        'product_id' 	=> $rows_pro_detail['products_id'],
						                        'quantity' 		=> $keys['quantity'],
						                        'total_one' 	=> common::convertIntToFormatMoney(common::convertFormatMoneyToInt($p_price) * $keys['quantity']),
												'description'	=> $description,
												'type'			=> $keys['type'],
												'color'			=> $keys['color'],
												'color_des'		=> $color_des,
												'type_des'		=> $type_des,												
												'linkS'			=> 'http://asiasilk.info.vn/'
					));
					$cartList .= $tmp_cart;
					$total += common::convertFormatMoneyToInt($p_price) * $keys['quantity'];
					$total_product += $keys['quantity'];//public
					$total_price = common::convertIntToFormatMoney($total);//public						
				}			
			}
			
			$_SESSION['total_price'] = common::convertIntToFormatMoney($total);
			$Score = new ScoreModel();
			$scoreUsr = $Score->getScoreByUser($_SESSION['username']);
			$percent = $Score->calculatorPromotionFromScore($scoreUsr);
			$tongtien = common::convertFormatMoneyToInt($_SESSION['total_price']);
			$tongtien = $tongtien - ($tongtien * ($percent/100));
			$_SESSION['total_price'] = common::convertIntToFormatMoney($tongtien);
			
			$cartFinish= $xtemplate->assign_blocks_content($cartFinish ,array(
				                                                        'LISTCART'=>$cartList,
			));
																				
			$cartFinish = $xtemplate->replace($cartFinish,array(
				                                          'total' => common::convertIntToFormatMoney($tongtien),
				                                           'price_unit' => 'VNĐ'
			));
			
			$_SESSION['mail_cart'] = $cartList;
			$_SESSION['total_mail'] = common::convertIntToFormatMoney($tongtien);

			$User = new User();
			$_user = $User->getUserInfo($_SESSION['username']);
			
			//VI TRI CHINH SUA
			// Lay danh sach cac tat ca cac dia chi 			
			$select = "";																		
			$adressformat = "";
			if(trim($_user['address'])!= "")
			{
				list($text_address, $text_street, $text_ward, $text_chung_cu, $text_lau, $text_can_ho,$text_district, $text_city ) = split(' nanapet.com ', $_user['address']);
										
				$adressformat = $text_can_ho.' '.$text_lau.' '.$text_chung_cu.' - '.$text_address.' '.$text_street.' '.$text_ward.' '.$text_district.' '.$text_city;
				
				$text_street = str_replace("Đường ","",$text_street);
				
				$text_ward = str_replace("Phường ","",$text_ward);				
							
				$text_chung_cu = str_replace("Chung cư/Tòa nhà ","",$text_chung_cu);
				
				$text_lau = str_replace("Lầu ","",$text_lau);
				
				$text_can_ho = str_replace("Căn hộ ","",$text_can_ho);
													
				if($text_can_ho == "")
				{
					$adressformat = str_replace("Căn hộ  ","",$adressformat);
				}
				
				if($text_lau == "")
				{
					$adressformat = str_replace("Lầu  ","",$adressformat);
				}		
				
				if($text_chung_cu == "")
				{
					$adressformat = str_replace("Chung cư/Tòa nhà  - ","",$adressformat);
				}			
			}
			
			$_user['address'] = $adressformat;
			
			// Trong bang user
			if($_user['address'] !="")
			{
				$select .= '<option selected="selected">'.trim($_user['name']).', '.trim($_user['address']).'</option>';
			}			
						
			// Trong bang tbl_contact_list
			$listAdd = GetRows('id,street,city,phone', 'tbl_contact_list', 'user = "'.$_user['email'].'"');			
			if(count($listAdd) != 0) // Neu co dia chi moi add vao
			{
				for($i = 0; $i < count($listAdd); $i++)
				{												
					list($text_address, $text_street, $text_ward, $text_chung_cu, $text_lau, $text_can_ho,$text_district, $text_city ) = split(' nanapet.com ', $listAdd[$i]['street']);
										
					$adressformat = $text_can_ho.' '.$text_lau.' '.$text_chung_cu.' - '.$text_address.' '.$text_street.' '.$text_ward.' '.$text_district.' '.$text_city;
					
					$text_street = str_replace("Đường ","",$text_street);
					
					$text_ward = str_replace("Phường ","",$text_ward);				
								
					$text_chung_cu = str_replace("Chung cư/Tòa nhà ","",$text_chung_cu);
					
					$text_lau = str_replace("Lầu ","",$text_lau);
					
					$text_can_ho = str_replace("Căn hộ ","",$text_can_ho);							
												
					if($text_can_ho == "")
					{
						$adressformat = str_replace("Căn hộ  ","",$adressformat);
					}
					
					if($text_lau == "")
					{
						$adressformat = str_replace("Lầu  ","",$adressformat);
					}		
					
					if($text_chung_cu == "")
					{
						$adressformat = str_replace("Chung cư/Tòa nhà  - ","",$adressformat);
					}
					$listAdd[$i]['street'] = $adressformat;
																																																															
					$select .= '<option>'.trim($_user['name']).', '.trim($listAdd[$i]['street']).' '.trim($listAdd[$i]['city']).'</option>';								
				}
			}												
			
			$cartFinish = $xtemplate->replace($cartFinish,array(														
														'txt_name_buyer' => $_user['name'],
														'txt_cellphone_buyer' => $_user['phone'],
														'list_address' => $select,														
														'txtHoten'		=> $_user['name'],
														'txtDienthoai'	=> $_user['phone'],
														'txtEmail'		=> $_user['email'],
														'txtNoidung'	=>'',
														'txtHoten_Info'	=> $_user['name'],
														'txtDienthoai_Info' => $_user['phone'],
														'transport_fee' => $dataFee,
														'txtEmail_Info' => $_user['email']
														
												));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'<a href="{linkS}gio-hang">Giỏ hàng</a>'.' &raquo; '.'Thông tin mua hàng';
		}
		$content = $cartFinish;
			
	}
?>