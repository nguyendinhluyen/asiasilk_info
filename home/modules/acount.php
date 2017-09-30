<?php 
$Pet = new Pet();
if(isset($_SESSION['username']))
{
	//$pets = $Pet->getListPetByUser($_SESSION['username']);
}
//$count_pet = count($pets);
$acount = '<a href="{linkS}dang-nhap">Đăng nhập</a> | <a href="{linkS}dang-ky"> Đăng ký </a> | <a href="'.$linkS.'tro-giup"> Trợ giúp </a>';
if(isset($_SESSION['username']) && $_SESSION['username'] !=''){
	$acount = '<a>Chào bạn,'.$_SESSION['name'].'!<a href="{linkS}logout"> (Thoát)</a></a> | <a href="{linkS}thong-tin-tai-khoan">'.'Tài khoản của bạn '.'</a>'.'| <a href="'.$linkS.'tro-giup"> Trợ giúp </a>';
}
	
?>
