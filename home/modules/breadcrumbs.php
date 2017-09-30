<?php
	$type = input($_POST['type']);//type and price
	$price = input($_POST['color']);//color 
	//echo $type.' '.$price;
	$cart = $xtemplate->load('cart');
	$cart  = $xtemplate->replace($cart,array(
						
	));
	$content = $cart;
?>