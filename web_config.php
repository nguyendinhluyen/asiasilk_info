<?php

	$timeout = 1; 

	$pp = 1;//san pham hien thi

	$imgExtent = 'jpg|gif|png|jpeg';//file anh upload

	$mediaExtent ='swf|flv';//file media upload

	$imgSize = '512000';//dung luong cho phep

	$mediaSize = '1024000';//dung luong media cho phep

	$ImgW	= 140;//resize anh theo width

	$upMedia = 2;

	$upImg = 5;

	$linkS ='/';
	
	//===========================================================	

	//dinh nghia servername cho viec chinh sua thong tin don hang
	//, account google dung chung thuc mail khi send
	//$server_name = 'http://nanapet.com/';
	//$SMTP_Host = "ssl://fpt02.bin.com.vn";
	//$SMTP_Port = 465;
	//$SMTP_account = "info@nanapet.com";
	//$SMTP_password = "123456";
	
	if($_SERVER['SERVER_NAME']=='118.69.195.172')
	{
		$server_name = 'http://asiasilk.info.vn/';
	}
	//===========================================================
	if($_SERVER['SERVER_NAME']=='localhost' or $_SERVER['SERVER_NAME']=='118.69.195.172')
	{
		$linkS ='/asiasilk/';
	}

?>