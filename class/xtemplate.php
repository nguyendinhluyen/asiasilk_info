<?php
class Template 
{
	var $ext = ".tpl";
	var $path = "xtemplate/";
	function load($filename) 
	{
		$full_link = $this->path.$filename.$this->ext;
		if (!file_exists($full_link)) 
		{
			die("Không tìm thấy file : <b>".$full_link."</b>");
		}
		else 
		{
			$file_content = file_get_contents($full_link);
		}
		return $file_content;
	}
	// Thay thế các biến trong mảng
	function replace($code,$arr) 
	{
		foreach ($arr as $block => $val) 
		{
			$code = str_replace('{'.$block.'}',$val,$code);
		}
		return $code;	
	}
	// Lấy ra nội dung nằm giữa <!-- BEGIN--> <!-- END-->
	function get_block_from_str($code,$block) 
	{
		preg_replace('#<!--BEGIN_'.$block.'-->(.*?)<!--END_'.$block.'-->#se','$assign_str = stripslashes("\\1");',$code);
		return $assign_str;
	}
	// Thay thế trong mảng các biến
	function assign_vars($code,$arr) 
	{
		foreach ($arr as $block => $val) 
		{
			$code = str_replace('{'.$block.'}',$val,$code);
		}
		return $code;	
	}	
	// Thay thế <!--BEGINLIST--> <!--ENDLIST--> thành các giá trị trong mảng
	function assign_blocks_content($code,$arr) 
	{
		foreach ($arr as $block => $val) 
		{
			$code = preg_replace('#<!--BEGINLIST_'.$block.'-->[\r\n]*(.*?)[\r\n]*<!--ENDLIST_'.$block.'-->#s', $val, $code);
		}
		return $code;
	}
	//hiển thị ra trình duyệt
	function show($code)
	{
		echo $code;
	}

}	
?>