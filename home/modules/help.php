<?php

	$News  = new News();
	
	$news_key = '';
	
	if(isset($_GET['news_key']))
	{
		$news_key = $_GET['news_key'];		
	}		
	
	//VI TRI THEM

	//MAC DINH CAI DAU TIEN SE XUAT HIEN KHI CLICK VAO TRO GIUP
	
	if($news_key == '')		
	{
		$allHelpRows = $News->getFistRowsOfHelp();
	
		$firstRow = $allHelpRows[0];	
		
		$news_key = $firstRow['news_key'];				
	}
		
	$arNewsHelp = $News->getHelp();
	
	$menu_help = "";

	$style = "";

	foreach($arNewsHelp as $help)
	{
		if($news_key == $help['news_key'])
		{
			
			$style = 'color: black; font-weight: bold;';
			
		}
		
		$menu_help .='<li class="danhmuc" style="'.$style.'"><a href="'.$linkS.'tro-giup/'.$help['news_key'].'.html">'.$help['news_name'].'</a></li>';

	    $style = '';
	}
	

	//get detail

	$news_detail = $News->getDetailNews($news_key);

	//end get detail	

	$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';

	$tilte_page =  'Trợ giúp'. " | ASIASILK";

	if($news_key != '')
	{

		$breadcrumbs_path .= ' &raquo; '.'<a href="{linkS}tro-giup">Trợ giúp</a>';

		$breadcrumbs_path .= ' &raquo; '.$news_detail['news_name'];

	}

	else{

		$breadcrumbs_path .= ' &raquo; '.'Trợ giúp';

	}		
	
	//CHO DUONG LINK REFERENCE		
	//Dung cho noi dung
	for ($i = 1; $i < 100;$i++)
	{
		if($i < 10)
		{
			$news_detail['news_content'] = str_replace('begin'.$i,'<A href="#section'.$i.'"style="color:#000; text-decoration:underline">',$news_detail['news_content']);
			
			$news_detail['news_content'] = str_replace('end'.$i,'</A>',$news_detail['news_content']);		
			
			$news_detail['news_content'] = str_replace('beginreference'.$i,'<A name="section'.$i.'"style="color:#000">',$news_detail['news_content']);
			$news_detail['news_content'] = str_replace('endreference'.$i,'</A>',$news_detail['news_content']);
		}
		else
		{
			$news_detail['news_content'] = str_replace('begin0'.$i,'<A href="#section'.$i.'"style="color:#000; text-decoration:underline">',$news_detail['news_content']);
			
			$news_detail['news_content'] = str_replace('end0'.$i,'</A>',$news_detail['news_content']);		
			
			$news_detail['news_content'] = str_replace('beginreference0'.$i,'<A name="section'.$i.'"style="color:#000">',$news_detail['news_content']);
			$news_detail['news_content'] = str_replace('endreference0'.$i,'</A>',$news_detail['news_content']);
		}
	}
		
	//Thay cho toppage
	$news_detail['news_content'] = str_replace('toppage','<A href="#section0" style="text-decoration:underline"> <b>Về đầu trang</b> </A>',$news_detail['news_content']);
	
	//Thay cho dau trang cuoi doan trang
	$news_detail['news_content'] = $news_detail['news_content'].'<br><A href="#section0" style="text-decoration:underline" ><b>Về đầu trang</b></A></br>';
				
	//$news_detail['news_name'] = '<A name="section0">'.$news_detail['news_name'].'</A>';
	
	$content = $xtemplate->load('help');

	$content = $xtemplate->replace($content,array(

			'menu_help'			=> $menu_help,

			'tieude'			=> $news_detail['news_name'],

			'noidung'			=> $news_detail['news_content'],
	));

?>