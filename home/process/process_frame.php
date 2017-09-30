<?php

$show = input($_GET['show']);

//menu icon css

$home_active = 'home';

$about_active = 'about';

$adoption_active = 'adoption';

$library_active = 'library';

$promotion_active = 'promotion';

$relax_active = 'relax';

$contact_active = 'contact';

//end menu icon

$title_category = "Danh mục sản phẩm";

include 'modules/layout.php';//layot

include 'modules/category.php';//category

include 'modules/product_typical_left.php';//product_typical_left

include 'modules/news_left.php';//news left

include 'modules/acount.php';

include 'modules/cart_right.php';

if(isset($_SESSION['cart_login'])){

	if($show != 'cart-finish' && $show != 'process_login' && $show != 'login')
	{
		unset($_SESSION['cart_login']);
	}
}

switch($show)
{
	case 'product':

		include('modules/product.php');

		break;

	case 'allproduct':

		include('modules/allproduct.php');

		break;

	case 'product_detail':

		include('modules/product_detail.php');

		break;

	case 'cart':

		include('modules/cart.php');

		break;

	case 'info':

		include('modules/info.php');

		break;

	case 'info_detail':

		include('modules/info_detail.php');

		break;

	case 'info_detail_libary':

		include('modules/info_detail_libary.php');

		break;

	case 'search':

		include('modules/search.php');

		break;

	case 'cart-finish':

		include('modules/cart_finish.php');

		break;

	case 'register':

		include('modules/register.php');

		break;

	case 'process-register':

		include('modules/process_register.php');

		break;

	case 'login':

		include('modules/login.php');

		break;

	case 'process_login':

		include('modules/process_login.php');

		break;

	case 'user_info':

		include('modules/user_info.php');

		break;

	case 'change_pass':

		include('modules/user_info.php');

		break;

	case 'historyOrder':

		include('modules/history_order.php');

		break;

	case 'contact':

		$contact_active = 'contact_active';

		include('modules/contact.php');

		break;

	case 're_pet_profile':

		include('modules/re_pet_profile.php');

		break;

	case 'list_pet_profile':

		include('modules/list_pet_profile.php');

		break;

	case 'ed_pet_profile':

		include('modules/ed_pet_profile.php');

		break;

	case 'forgot_pass':

		include('modules/forgot_pass.php');

		break;

	case 'resetUpdate':

		include('modules/resetUpdateCart.php');

		break;

	case 'user_infomation':

		include('modules/user_infomation.php');

		break;

	case 'help':

		include("modules/help.php");

		$category = $menu_help;

		$title_category = "ASIASILK HỖ TRỢ";

		break;

	default:

		include('modules/home.php');

		$home_active = 'home_active';		

		break;

}

?>