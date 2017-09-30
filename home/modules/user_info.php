<?php 	

	if(($_SESSION['username']==''))
	{

		$_SESSION['cart_login'] = 1;

		?>

		<script>

			window.location="<?php echo $linkS.'dang-nhap'; ?>";

		</script>

		<?php 

	}

	$user_info = $xtemplate->load('user_update');
	
	if(isset($_SESSION['username']))
	{				
	
		if(isset($_GET['type']))
		{
	
			$error =0;
	
			$type = input($_GET['type']);
	
			$sql ='';
	
			if($type == 'update')
			{
				// Lay thong tin dia chi				
				
				$number_address = $_POST['text_edit_number_address'];
							
				$number_street = $_POST['text_edit_number_street'];
				
				$number_street = str_replace("Đường","",$number_street);
										
				$number_ward = $_POST['text_edit_number_ward'];
				
				$number_ward = str_replace("Phường","",$number_ward);																											
							
				$buildings = $_POST['text_edit_number_address_Chung_Cu'];
				
				$floor = $_POST['text_edit_floor_Chung_Cu'];
				
				$room = $_POST['text_edit_room_Chung_Cu'];
																			
				$number_city = $_POST['list_city_buy'];									
				
				$number_district = $_POST['list_district_buy'];						
				
				if($number_address == '' || $number_street == '' || $number_ward == '' || $number_city == 'Chưa chọn tỉnh/thành' || $number_district == 'Chưa chọn quận/huyện')
				{
				
					?>				
						<script>                    
							alert('Chưa điền / chọn đầy đủ thông tin địa chỉ bắt buộc! Cập nhật thất bại');
							window.location="<?php echo $linkS.'thong-tin-tai-khoan'; ?>";
						</script>
	
					<?php									
				}
				
				else
				{
					$user = input($_SESSION['username'],1);
		
					$email = input($_POST['email'],1);
		
					$name = input($_POST['name'],1);
		
					$phone = input($_POST['phone'],1);
		
					$birthday = input(strtotime($_POST['birthday']),1);
																																																										
					// VI TRI CAN CHINH SUA KHI UPDATE DIA CHI CAN HO																					
					$address =  trim($number_address). ' nanapet.com Đường '.trim($number_street).' nanapet.com Phường '.trim($number_ward).'  nanapet.com Chung cư/Tòa nhà '.trim($buildings).' nanapet.com Lầu '.trim($floor).' nanapet.com Căn hộ '.trim($room).' nanapet.com '.$number_district.' nanapet.com '.$number_city;
																																																																																												
					$yahoo = input($_POST['yahoo'],1);
		
					$sex = input($_POST['gender']);
		
					$sql = "update user set name ='".$name."', phone='".$phone."',address='".$address."',birthday ='".$birthday."',sex = ".$sex.",yahoo ='".$yahoo."',update_flag = 1 where email = '$user' and status >-1";
		
					$_SESSION['name'] = $name;		
				
				}																								
			}
	
			if($type == 'changepass')
	
			{				
				$user = input($_SESSION['username'],1);
	
				$pass_old = md5($_POST['pass_old']);
	
				$pass_new = input($_POST['pass_new'],1);
	
				$pass_confirm = input($_POST['pass_confirm'],1);
	
				$numrow = GetNumRow('id,email','user',"email ='$user' and password = '$pass_old'");
	
				if($numrow ==0)
				{
					$error =1;
	
					?>
	
					<script>
	
						alert('Mật khẩu cũ không chính xác.');
	
						window.location="thong-tin-tai-khoan";
	
					</script>
	
				<?php
	
				}			
	
				if($pass_new != $pass_confirm)
	
				{
	
					$error =1;
	
				?>
	
					<script>
	
						alert('Mật khẩu xác nhận không chính xác.');
	
						window.location="thong-tin-tai-khoan";
	
					</script>
	
				<?php
	
				}			
	
				$sql = "update user set password ='".md5($pass_new)."' where email = '$user' and status >-1";
			}
	
			if(	$error == 0)	
			{
	
				//$usrUp = GetOneRow("update_flag","user","email = '".$user."'");
	
				//if($usrUp['update_flag'] == 0)
				//{
	
					//updateScore($user,"add",20,ACTION_UPDATEUSER);
	
				//}			
	
				$mysql->setQuery($sql);
	
				if($mysql->query()){
	
					//$lastId = mysql_insert_id();
	
					$usInfo = GetOneRow('id,username','user',"email ='$user' and status >-1");
	
					$image = renameFile($_FILES["avatar"]["name"],$usInfo['username'].'-'.$usInfo['id']);				
	
					//Resize ảnh và di chuyển vào thư mục
	
					if(move_uploaded_file($_FILES ["avatar"]["tmp_name"],'../upload/avatar/'.$image))
	
					{					
	
						@imagejpeg(resize('../upload/avatar/'.$image,100,120),'../upload/avatar/'.$image);
	
						$sql_u = "update user set avarta = '".$image."' where email = '".$user."' and status >-1";
	
						$mysql->setQuery($sql_u);
	
						$mysql->query();
	
					}
	
			?>
				<script>
	
					alert('Cập nhật thành công.');
	
					window.location="thong-tin-tai-khoan";
	
				</script>
	
			<?php
	
				}
	
			}
		}
		
		$user = input($_SESSION['username'],1);
	
		$row_ac = GetOneRow('email,name,phone,date,last_login,address,birthday,yahoo,sex,avarta','user',"email = '$user' and status >-1");
	
		$scoreModel = new ScoreModel();
	
		//GET LEVEL
	
		$user_type = $scoreModel -> getLevelByUser($user);			
	
		//GET SCORE
	
		$GroupMember = GetOneRow("GroupMember","user","email = '".$user."'");
	
		$score = 0;
			
		$scoreUnused = 0;
	
		if($GroupMember['GroupMember'] == "Chưa là thành viên")
		{
			$score = $scoreModel -> getScoreByUser($user);	
			
			$listScoreUnused = GetRows('username , total', 'tbl_order', ' status = 0 AND username = "'.$user.'"');			
		
			// Lay Price Of Unit
			
			$sql = "Select * from PriceOfUnit";	
				
			$mysql -> setQuery($sql);
			
			$PriceOfUnit = $mysql->loadAllRow();	
					
			if(count($listScoreUnused) > 0)
			{	
				for($i = 0; $i < count($listScoreUnused); $i++)
				{															
						$listScoreUnused[$i]["total"]= str_replace('.','',$listScoreUnused[$i]["total"]);
						// ScoreUnused
						$scoreUnused = $scoreUnused  + floor(intval($listScoreUnused[$i]["total"]) / $PriceOfUnit[0]['PriceScore']);					
				}
			}		
		}					
	
		if($score == '')
		{
			$score = 0;
		}	
		
		if(	$user_type == '')	
		{
			$user_type = 'Normal';
		}										
		
		$selected1 = "";
	
		$selected2 = "";
	
		$selected3 = "";
	
		if($row_ac['sex'] == 0)
		{
	
			$selected2 = "selected";
	
		}
	
		if($row_ac['sex'] == 1)
		{
	
			$selected1 = "selected";
	
		}
	
		if($row_ac['sex'] == 2)
		{
	
			$selected3 = "selected";
	
		}
	
		$adressformat = "";
	
		$selected4 = "selected";
	
		if(trim($row_ac['address']) != "")
		{		
			list($text_address, $text_street, $text_ward, $text_chung_cu, $text_lau, $text_can_ho,$text_district, $text_city ) = split(' nanapet.com ', $row_ac['address']);
											
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
			
			$selected4 ="";
			
			$selected5 = "selected";
		}
		
		$selected_city = "selected_".$text_city;
		
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
		
	
		$user_info = $xtemplate->replace($user_info,array(
	
			'username' => $user,
	
			'date_register'	=> date('d/m/Y H:i',$row_ac['date']),
	
			'phone'	=> $row_ac['phone'],
	
			'name' => $row_ac['name'],
	
			'email'	=> $row_ac['email'],
			
			'text_address' => $text_address,
			
			'text_street' => $text_street,
			
			'text_ward' => $text_ward,
			
			$selected_city	=> "selected",						
			
			'district_value' => $text_district,
	
			'selected_district ' => $selected4,
			
			'selected_district_value' => $selected5,
			
			'address' => $adressformat,
									
			'text_address_Chung_Cu' => $text_chung_cu,
			
			'text_edit_floor_Chung_Cu' => $text_lau,
			
			'text_edit_room_Chung_Cu' => $text_can_ho,
							
			'birthday'	=>  date("d-m-Y",$row_ac['birthday']),
	
			'yahoo'		=> $row_ac['yahoo'],
	
			'sex'		=> $row_ac['sex'],
	
			'score'		=> $score,
	
			'unusedscore' => $scoreUnused,
	
			'avatar'	=>  ($row_ac['avarta']!='')?$row_ac['avarta']:'default.png',
	
			'level'		=> $user_type,
	
			'selected1'	=> $selected1,
	
			'selected2'	=> $selected2,
	
			'selected3'	=> $selected3,

			'discount_level' => $disCountVIPCustomer.'%',
	
			));
	
		$content = $user_info;			
	}
	
	else
	{
	?>
		<script>
	
			alert('Bạn chưa đăng nhập. Mời bạn đăng nhập');
	
			window.location="dang-nhap";
	
		</script>
	
	<?php
	
	}
	
	$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
	
	$breadcrumbs_path .= ' &raquo; '.'Thông tin tài khoản';
	
	$tilte_page ='Thông tin tài khoản | '.'ASIASILK';
	
	$content = $user_info;
	
?>

