<?php 

	$logout = input($_GET['out']);
	
	if($logout == 1)
	{
	
		unset($_SESSION['username']);
	
		unset($_SESSION['name']);
		
		unset($_SESSION['cart']);
		
		setcookie ("UsNanapetCookie", "", time() - 3600);
	
		?>
        	
		<script>
	
			alert('Cảm ơn bạn đã ghé thăm!');
	
			window.location='<?php echo $linkS; ?>';
	
		</script>
	
		<?php

		return;
	
	}
	
	$Users = new User();
	
	$user = input($_POST['username'],1);
	
	$password = md5($_POST['passwd']);
	
	$remember = $_POST['remember'];
	
	$numrow = GetNumRow('email','user',"email ='$user' and password = '$password' and status > -1");
	
	if($numrow >0)
	
	{
	
		$_SESSION['username'] = $user;
	
		if($remember == 1)//remember pass
		{
	
			include('../class/rsa.class.php');
	
			$RSA = new RSA();
	
			$keys = $RSA->generate_keys ('9990454949', '9990450271');
	
			$Userencoded = $RSA->encrypt ($user, $keys[1], $keys[0], 5);		
	
			setcookie("UsNanapetCookie",$Userencoded, time()+3600*24*100);
	
		}
	
		$usr_info = $Users->getUserInfo($_SESSION['username']);	
	
		$_SESSION['name'] = $usr_info['name'];
	
		$sql = "update user set last_login  = ".time()." where email = '$user'";
	
		$mysql -> setQuery($sql);
	
		$mysql -> query();
			
		//ACTION_BIRTHDAY ACTION_NEWYEAR
	
		//$date_now = getdate();			
	
		//birthday
	
		//$hisScore = GetOneRow("action_date","tbl_history_score","user = '".$_SESSION['username']."' and comment = '".ACTION_BIRTHDAY."' order by action_date desc");
	
		//$usrRe = GetOneRow("u.date,u.birthday,u.birthday_flag","user u","email = '".$_SESSION['username']."' and u.status >=0");
	
		//$dateBir = date('Y-m-d',$usrRe['birthday']);
	
		//$dateBir = split("-",$dateBir);
	
		//$yearBir = $dateBir[0];
	
		//$monthBir = intval($dateBir[1]);
	
		//$dayBir = intval($dateBir[2]);
	
		//if(empty($hisScore)){
	
			//if($yearBir < $date_now['year']){
	
				//if(($date_now['mon'] > $monthBir) || ($date_now['mon'] == $monthBir &&  $date_now['mday'] >= $dayBir)){
	
					//if($usrRe['birthday_flag'] == 0)
	
					//{ //die($date_now['mon'].' '.$monthBir.' '.$date_now['mday'].' '.$dayBir);
	
						//updateScore($_SESSION['username'],"add",30,ACTION_BIRTHDAY);
	
						//$arr = array("birthday_flag" => 1);
	
						//update("user",$arr,"email = '".$_SESSION['username']."'");
	
					//}
	
				//}
	
			//}
	
			//else
			
			//{
	
				//$dateHis = date('Y-m-d',$hisScore["action_date"]);
	
				//$dateHis = split("-",$dateHis);
	
				//$yearHis = $dateBir[0];
	
				//$monthHis = intval($dateBir[1]);
	
				//$dayHis = intval($dateBir[2]);
	
				//if($yearHis < $date_now['year']){
	
					//$arr = array("birthday_flag" => 0);
	
					//update("user",$arr,"email = '".$_SESSION['username']."'");				
	
					//if(($date_now['mon'] > $monthHis) || ($date_now['mon'] == $monthHis &&  $date_now['mday'] >= $dayHis))
	
					//{
	
						//if($usrRe['birthday_flag'] == 0)
	
						//{
	
							//updateScore($_SESSION['username'],"add",30,ACTION_BIRTHDAY);
		
							//$arr = array("birthday_flag" => 1);
	
							//update("user",$arr,"email = '".$_SESSION['username']."'");
	
						//}
	
					//}
	
				//}
	
			//}
					
		//}		
		
		
		//End update score
		
		if($_SESSION['cart_login'] == 1)
		{
				
			unset($_SESSION['cart_login']);
	
			?>
	
			<script>
	
				window.location="<?php echo $linkS.'ket-thuc-mua-hang';?>";
	
			</script>
	
			<?php
			
		}
	
		else
		{
	
			?>
		
				<script>
		
					alert('Đăng nhập thành công.');
		
					window.location='thong-tin-tai-khoan';
		
				</script>
		
			<?php
	
		}	
	}
	else
	{	
		?>
		
			<script>
		
				alert('Tên đăng nhập hoặc mật khẩu không đúng. Mời bạn đăng nhập lại');
		
				window.location='dang-nhap';
		
			</script>
		
		<?php
	
	}
	
?>