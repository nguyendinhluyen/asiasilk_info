<?php

	$forget_pass = $xtemplate->load('forgot_pass');
	$breadcrumbs_path .= '<a href="{linkS}">Nanapet</a>';
	$breadcrumbs_path .= ' &raquo; '.'Quên mật khẩu';
	$tilte_page =   'Quên mật khẩu'. " | Nanapet";
	$msg = '';
	$User = new User();
	$mailAdmin = GetOnef('config_value','config','config_name="mail_admin"');
	//change pass
	if(isset($_GET['ser_key'])){
		$ser_key = input($_GET['ser_key']);
		$usr_inf = $User->getUserInfoByActiveLink($ser_key);
		if(empty($usr_inf)){
			$msg = MSG_NOT_FORGOT_PASS;
		}
		else {
			$pass_got = rand(1111111111,9999999999);
			$email_got = $usr_inf['email'];
	
			$tpl_mail = $xtemplate->load('forgot_pass_mail_success');
			$link_login = getFullDomain();
			$link_login .= $linkS.'dang-nhap';
			$tpl_mail  = $xtemplate->replace($tpl_mail,array(
					'email'			=> $email_got,
					'link_login' 	=> $link_login,
					'pass'			=> $pass_got
				));
			
			if(!sendmail_smtp($mailAdmin,$email_got,'Nanapet - Đổi mật khẩu',$tpl_mail))
			{
				if(!sendmail_phpmailer($mailAdmin,$email_got,'Nanapet - Đổi mật khẩu',$tpl_mail))
				{
					if(sendmail($mailAdmin,$email_got,'Nanapet - Đổi mật khẩu',$tpl_mail))
					{
						$User->updateAfterForgotPass($email_got, md5($pass_got));
						$msg = MSG_SEND_FORGOT_PASS_SUCCESS;
					}
					else
					{
						$msg = MSG_ERROR_FORGOT_PASS;
					}
				}
				else {
					$User->updateAfterForgotPass($email_got, md5($pass_got));
					$msg = MSG_SEND_FORGOT_PASS_SUCCESS;
				}
			}
			else{
				$User->updateAfterForgotPass($email_got, md5($pass_got));
				$msg = MSG_SEND_FORGOT_PASS_SUCCESS;
			}
		}
	}
	//end chang pass
	
	
	if(isset($_POST['forgot'])){
		$email = input($_POST['email']);
		$usr = $User->getUserInfo($email);
		if(empty($usr)){
			$msg = 'Lỗi! Email không tồn tại trong hệ thống!';
		}
		else{
			$rad = rand(1111111111,9999999999);
			$keylink = md5($rad).$rad.time();
			$tpl_mail = $xtemplate->load('forgot_pass_mail');
			$link_active = getFullDomain();
			$link_active .= $linkS.'quen-mat-khau.html/'.$keylink;
			
			$tpl_mail  = $xtemplate->replace($tpl_mail,array(
															'email'			=> $email,
															'link_active' 	=> $link_active,
													));
			if(!sendmail_smtp($mailAdmin,$email,'Nanapet - Quên mật khẩu',$tpl_mail))
			{
				if(!sendmail_phpmailer($mailAdmin,$email,'Nanapet - Quên mật khẩu',$tpl_mail))
				{
					if(sendmail($mailAdmin,$email,'Nanapet - Quên mật khẩu',$tpl_mail))
					{
						$User->updateActiveLink($email, $keylink);//active link
						$msg = MSG_SEND_FORGOT_PASS;
					}
					else
					{
						$msg = MSG_ERROR_FORGOT_PASS;
					}
				}
				else {
					$User->updateActiveLink($email, $keylink);//active link
					$msg = MSG_SEND_FORGOT_PASS;
				}
			}
			else{
				$User->updateActiveLink($email, $keylink);//active link
				$msg = MSG_SEND_FORGOT_PASS;
			}
			
		}
	}
	
	$forget_pass = $xtemplate->assign_vars( $forget_pass,array(
																	'msg' 		=> $msg,
																));
	$content = $forget_pass ;
	
?>