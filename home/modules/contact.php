<?php

	if(isset($_POST['butSub']))
	{

		$txtCode 		= input($_POST['txtCode']);

		$txtHoten 		= input($_POST['txtHoten']);

		$txtDienthoai 	= input($_POST['txtDienthoai']);

		$txtEmail 		= input($_POST['txtEmail']);

		$txtNoidung 	= input($_POST['txtNoidung']);

		if($_SESSION['security_codeTDW']==$txtCode)
		{

			$data = array(

				'name'	=> $txtHoten,

				'title'	=> cut_string($txtNoidung,30,'..'),

				'comment'	=> $txtNoidung,

				'phone'	=> $txtDienthoai,

				'email'	=> $txtEmail,

				'date'	=> time(),

				'ip'	=> $_SERVER['REMOTE_ADDR']

			);

			insert('contact',$data); //insert vào database

			$mailAdmin = GetOnef('config_value','config','config_name="mail_admin"');
			
			//==================================================================
			//Thay doi cach thuc gui mail gop y
			$mailBody = '<br/><b>Họ tên : </b>'.$txtHoten;

			$mailBody .= '<br/><b>Điện thoại : </b>'.$txtDienthoai;

			$mailBody .= '<br/><b>Email : </b>'.$txtEmail;

			$mailBody .= '<br/><b>Nội dung liên hệ : </b>'.$txtNoidung;

			$mail_subject = "Góp ý";

			$mail_to = GetConfig('mail_admin');

			$mail_nameto = 'admin';

			$headers  = 'MIME-Version: 1.0' . "\r\n";

			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";				

			// Additional headers
			$headers .= 'To: '.$mail_nameto. "\r\n";

			$headers .= 'From:'.'ASIASILK Website - Contact' . "\r\n";					
			
			if(mail($mail_to, $mail_subject, $mailBody, $headers))
			{
				
				$success = 'Thông tin của bạn đã được gửi thành công! Cảm ơn bạn!';
							  
			}
			else
			{
				$success = 'Thông tin của bạn đã được gửi thất bại! Vui lòng gửi lại sau ít phút!';
			}
		}
		
		else
		{
				$success = 'Thông tin của bạn đã được gửi thất bại! Vui lòng gửi lại sau ít phút!';
				
		}

	}
	
	$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';

	$breadcrumbs_path .= ' &raquo; '.'Liên hệ';

	$tilte_page =   'Liên hệ'. " | ASIASILK";

	$content = $xtemplate->load('contact');

	$content = $xtemplate->replace($content,array(

		'contact'		=> GetOnef('content_value','contents','content_key="contact"'),

		'bandoTPHCM'	=> GetOnef('content_value','contents','content_key="bandoTPHCM"'),

		'bandoHaNoi'	=> GetOnef('content_value','contents','content_key="bandoHaNoi"'),

		'rand'			=> md5(rand()),

		'errCode'		=> $errCode,

		'txtHoten'		=> $txtHoten,

		'txtDienthoai'	=> $txtDienthoai,

		'txtEmail'		=> $txtEmail,

		'txtNoidung'	=> $txtNoidung,

		'success'		=> $success


	));

?>