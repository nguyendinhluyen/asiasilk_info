<?php
	$title = 'Lỗi : không tìm thấy trang này';
	$keywords = 'lỗi,error,không tìm thấy trang này,404,error page';
	$description = 'Không tìm thấy trang này';
	
	$not_find = $xtemplate->load('not_find');
	$content = $xtemplate->replace($not_find,array(
	'error'	=>'Không tìm thấy trang này'
	));
?>