<?php

$tilte_page = 'Công Ty Cổ Phần Tơ Tằm Á Châu (ASIASILK Corporation) | Lụa tơ tằm';

include('home_start.php');

include('process/loadModel.php');

include('process/process_frame.php');

$html = $xtemplate->load('layout');

$chatlive = '<script type="text/javascript" src="https://mylivechat.com/chatinline.aspx?hccid=37788612"></script>';

$giohang = '
			<span style="margin-right: 0px;"><a href="{linkS}gio-hang">
				<span>
					<img src="{linkS}layout/images/shop.png" width="50px" height="50px"></a>
				</span>				
			</span>
			
            <!--<span id="main-cart">
            	{cart_right}
            </span> -->

			<!--<div class="sales_time">
            	<a href="" onclick="showSales(); return false;"><b style="color: #ED1B24;font-size: 16px;">SALES HOUR </b></a>
            </div>-->
			';

$hidden = "";

$hiddenbannerleft = 'style="display: none"';

$hiddenbannerleft3 = 'style="display: none"';

$main_banner = '';



if (!empty($banner)) {
    $main_banner .= '<img src="{linkS}layout/images/logo/banner/' . $banner . '"/>';
}
if (!empty($banner_2)) {
    $main_banner .= '<img src="{linkS}layout/images/logo/banner/' . $banner_2 . '"/>';
}
if (!empty($banner_3)) {
    $main_banner .= '<img src="{linkS}layout/images/logo/banner/' . $banner_3 . '"/>';
}
if (!empty($banner_4)) {
    $main_banner .= '<img src="{linkS}layout/images/logo/banner/' . $banner_4 . '"/>';
}
if (!empty($banner_5)) {
    $main_banner .= '<img src="{linkS}layout/images/logo/banner/' . $banner_5 . '"/>';
}

$left_banner_1 = '';

if (!empty($banner_left_1_1)) {

    $left_banner_1 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_1/'
            . $banner_left_1_1 . '"/></a>';
}
if (!empty($banner_left_1_2)) {
    $left_banner_1 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_1/'
            . $banner_left_1_2 . '"/></a>';
}
if (!empty($banner_left_1_3)) {
    $left_banner_1 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_1/'
            . $banner_left_1_3 . '"/></a>';
}
if (!empty($banner_left_1_4)) {
    $left_banner_1 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_1/'
            . $banner_left_1_4 . '"/></a>';
}
if (!empty($banner_left_1_5)) {
    $left_banner_1 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_1/'
            . $banner_left_1_5 . '"/></a>';
}

$left_banner_2 = '';

if (!empty($banner_left_2_1)) {

    $left_banner_2 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_2/'
            . $banner_left_2_1 . '"/></a>';
}
if (!empty($banner_left_2_2)) {
    $left_banner_2 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_2/'
            . $banner_left_2_2 . '"/></a>';
}
if (!empty($banner_left_2_3)) {
    $left_banner_2 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_2/'
            . $banner_left_2_3 . '"/></a>';
}
if (!empty($banner_left_2_4)) {
    $left_banner_2 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_2/'
            . $banner_left_2_4 . '"/></a>';
}
if (!empty($banner_left_2_5)) {
    $left_banner_2 .= '<a href="{linkS}"><img src="{linkS}layout/images/logo/banner_left_2/'
            . $banner_left_2_5 . '"/></a>';
}

switch ($show) {

    case 'cart-finish':

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    case 'register':

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,			

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;


    case 'login':

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,			

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    case 'info':

        if ($_GET['flag'] == "3") {
            $hidden = 'style="display: none"';

            $tpl = '<li class="danhmuc_main"><a href="{linkS}dinh-duong">TIN TỨC CHUNG</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}cham-soc">TIN TỨC THẾ GIỚI</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}thu-y">TIN TỨC TRONG NƯỚC</a></li>';

            $category = $tpl;

            $title_category = "TIN TỨC - SỰ KIỆN";

            $hiddenbannerleft = "style = 'margin-top:15px'";
        }
        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,			

            'hidden' => $hidden,
            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'hidden-banner-left-3' => $hiddenbannerleft3,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    case 'cart':

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;


    case 'contact':

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'hidden-banner-left-3' => $hiddenbannerleft3,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    case 'info_detail':

        if (input($_GET['cate']) == 'thuvien') {

            $hidden = 'style="display: none"';

            $tpl = '<li class="danhmuc_main"><a href="{linkS}dinh-duong">TIN TỨC CHUNG</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}cham-soc">TIN TỨC THẾ GIỚI</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}thu-y">TIN TỨC TRONG NƯỚC</a></li>';

            $category = $tpl;

            $hiddenbannerleft = "style = 'margin-top:15px'";
        }

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,			

            'hidden' => $hidden,
            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'hidden-banner-left-3' => $hiddenbannerleft3,
            'title_category' => "TIN TỨC - SỰ KIỆN",
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    case 'info_detail_libary':

        if (input($_GET['cate']) == 'thuvien') {

            $hidden = 'style="display: none"';

            $tpl = '<li class="danhmuc_main"><a href="{linkS}dinh-duong">TIN TỨC CHUNG</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}cham-soc">TIN TỨC THẾ GIỚI</a></li>';

            $tpl .= '<li class="danhmuc_main"><a href="{linkS}thu-y">TIN TỨC TRONG NƯỚC</a></li>';

            $category = $tpl;

            $hiddenbannerleft = "style = 'margin-top:15px'";
        }

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,			

            'hidden' => $hidden,
            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'hidden-banner-left-3' => $hiddenbannerleft3,
            'title_category' => "TIN TỨC - SỰ KIỆN",
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkSf' => "http://www.asiasilk.info.vn/",
            //'linkSf'				=> $linkS,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => "",
        ));

        $xtemplate->show($html);

        break;

    default:

        $html = $xtemplate->replace($html, array(
            //'time_sale_tpl' 		=> $time_sale_tpl,

            'show_sales1' => $show_sales1,
            'show_sales2' => $show_sales2,
            'time_sale' => $time_sale,
            'server_time' => $server_time,
            'category' => $category,
            'hidden-banner-left' => $hiddenbannerleft,
            'title_category' => $title_category,
            'product_typical_left' => $product_typical_left,
            'news_left' => $news_left,
            'content' => $content,
            'breadcrumbs_path' => $breadcrumbs_path,
            'acount' => $acount,
            'title' => $tilte_page,
            //'ngaythang'			=> common::showDate(),
            'giohang' => $giohang,
            //cart_right'			=> $cart_right,
            'main_banner' => $main_banner,
            'left_banner_1' => $left_banner_1,
            'left_banner_2' => $left_banner_2,
            'linkS' => $linkS,
            'home_active' => $home_active,
            'about_active' => $about_active,
            'adoption_active' => $adoption_active,
            'library_active' => $library_active,
            'promotion_active' => $promotion_active,
            'relax_active' => $relax_active,
            'contact_active' => $contact_active,
            'logo_web' => $logo_web,
            'img_adv_lelf' => $img_adv_lelf,
            'img_adv_bottom' => $img_adv_bottom,
            'chatlive' => $chatlive,
        ));

        $xtemplate->show($html);
}
?>