<?php
class iba 
{
    var $script ='';
   function iba()
   {
   	 delete('ip_based_access',"time <".time());
	  if(checkExit('ip','ip_based_access',"ip='{$_SERVER['REMOTE_ADDR']}'"))
	  {
		$reason = GetOneRow('time,reason','ip_based_access',"ip='{$_SERVER['REMOTE_ADDR']}'");
		$this->exit_iba($reason['reason'],$reason['time'] - time());
	  }
	  //Chống spam webiste
	  $anti_spam = GetConfig('anti_spam');
	  if($anti_spam)
	  {
		 if($_SESSION['ANTI_HACK'] + 3 > time())
		 {
			$_SESSION['REFRESH_COUNT']+=1;
		 }
		 elseif($_SESSION['ANTI_HACK'] + 20 < time())
		 {
			$_SESSION['REFRESH_COUNT'] = 0;
		 }
		 $_SESSION['ANTI_HACK'] = time();
		 if($_SESSION['REFRESH_COUNT'] > 50)
		 {
			$script = '<script language="javascript">alert("Cảnh cáo : Webiste nhận thấy IP '.$_SERVER['REMOTE_ADDR'].' có hành vi phá hoại,nếu bạn vẫn tiếp tục phá hoại webiste,chúng tôi sẽ tiến hành span IP của bạn .")</script>';
			if($_SESSION['REFRESH_COUNT'] > 52)
			{
				$data = array(
				'ip'=>"{$_SERVER['REMOTE_ADDR']}",
				'reason' =>'Phá hoại,spam webiste',
				'time'=>(time()+60*30),
				'date'=>time()
				);
				insert('ip_based_access',$data);
			}
			
		 }
		 else
		 {
			$script ='';
		 }
		 $this->script=$script;
	 //end chống spam
	 }
   }
   function exit_iba($reason,$sec)
   {
	echo '<?xml version="1.0" encoding="iso-8859-1"?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>Ip của bạn đã bị chặn</title>
		<meta http-equiv="keywords" content="chặn ip , lỗi webiste,bảo mật,ngăn chặn phá web">
		<meta http-equiv="description" content="Nếu website nhận có hành vi phá hoại web,thì hệ thống website sẽ ngăn chặn lại hành vi này">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Refresh" content="'.($sec+2).';url=./">
		<style type="text/css">
		<!--
		body {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			font-style: normal;
			color: #000000;
		}
		-->
		</style>
		</head>
		<body>
        
        
			<div style="width:980px;margin: 0 auto">
            <div style="border:1px solid #ccc;padding:10px;background:#F3F3F3">
            <div align="center">
			<span style="font-weight:bold;font-size:14px;color:red">Bạn không thể truy cập vào website</span>
            </div>
             <br>Lý do : '.$reason.'<br>Bạn vui lòng chờ trong <form name="counter">
			<input value="0.0" size="10" name="d2" style="border:0px;color:red" type="text">
			</form>hoặc liên hệ với ban quản trị webiste email <b>noho501@gmail.com</b> <br>Hoặc ym : <img border="0" src="http://mail.opi.yahoo.com/online?u=ngoho88&m=g&t=0" align="left"><a class="a7" href="ymsgr:sendIM?ngoho88">ngoho88</a> <br>Hoặc số điện thoại 098 72 77 329 <br><a href="http://www.thienduongweb.com">www.thienduongweb.com</a>
            </div>
			</div>
            
            
			<script> 
				<!-- 
				// 
				var milisec=0 ;
				var seconds='.$sec.' ;
				document.counter.d2.value='.$sec.';
				function display(){ 
				if (milisec<=0)
				{ 
					milisec=9 ;
					seconds-=1 ;
				} 
				if (seconds<=-1)
				{ 
					milisec=0 ;
					seconds+=1 ;
				}
				else
					milisec-=1 ;
					document.counter.d2.value=seconds+"."+milisec+"s" ;
					setTimeout("display()",100) ;
				}
				display() 
				--> 
			</script>  
		</body>
		</html>';
		
		exit();
   }
}
?>