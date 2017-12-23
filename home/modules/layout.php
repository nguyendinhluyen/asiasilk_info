<?php

//logo web

$logo_web = GetOnef('config_value','config','config_name="logo"');

$banner   = GetOnef('config_value','config','config_name="banner"');
$banner_2 = GetOnef('config_value','config','config_name="banner_2"');
$banner_3 = GetOnef('config_value','config','config_name="banner_3"');
$banner_4 = GetOnef('config_value','config','config_name="banner_4"');
$banner_5 = GetOnef('config_value','config','config_name="banner_5"');

$banner_left_1_1 = GetOnef('config_value','config','config_name="banner_left_1_1"');
$banner_left_1_2 = GetOnef('config_value','config','config_name="banner_left_1_2"');
$banner_left_1_3 = GetOnef('config_value','config','config_name="banner_left_1_3"');
$banner_left_1_4 = GetOnef('config_value','config','config_name="banner_left_1_4"');
$banner_left_1_5 = GetOnef('config_value','config','config_name="banner_left_1_5"');

$banner_left_2_1 = GetOnef('config_value','config','config_name="banner_left_2_1"');
$banner_left_2_2 = GetOnef('config_value','config','config_name="banner_left_2_2"');
$banner_left_2_3 = GetOnef('config_value','config','config_name="banner_left_2_3"');
$banner_left_2_4 = GetOnef('config_value','config','config_name="banner_left_2_4"');
$banner_left_2_5 = GetOnef('config_value','config','config_name="banner_left_2_5"');

//end

//adver left

$arrAdvsLelf = GetRows('adver_id,adver_logo,adver_link', 'ads', "adver_pos = 8 and adver_status = 1");

$img_adv_lelf = '';

foreach($arrAdvsLelf as $adv){

 	$img_adv_lelf .= '<a target="_blank"  href="'.$adv['adver_link'].'" ><img src="'.$linkS.'upload/adver/thumb/'.$adv['adver_logo'].'" width="200px"/></a>';

}

//adver bottom

$arrAdvsBottom = GetRows('adver_id,adver_logo,adver_link', 'ads', "adver_pos = 14 and adver_status = 1");

$img_adv_bottom = '';

foreach($arrAdvsBottom as $adv){

	$img_adv_bottom .= '<a target="_blank"  href="'.$adv['adver_link'].'" ><img src="'.$linkS.'upload/adver/thumb/'.$adv['adver_logo'].'" height="72px"/></a> ';

}

//end adver bottom

//$server_time = time()*1000;
// $time_config = GetOnef('config_value','config','config_name="time_encourage"');
// $date_now = getDateNow();
// $date_expr = convertToDate($time_config);
// if($time_config)
// {
// 	if($date_now >= $date_expr){
// 		$Product = new Product();
// 		$Product->resetPromotion();
// 	}
// }
// $time_sale = GetOnef('config_value','config','config_name="time_encourage"');
// $show_sales1 = "display: none;";
// $show_sales2 = "";
// if($time_sale != ''){	
// 	$show_sales1 = "";
// 	$show_sales2 = "display: none;";
// }

?>