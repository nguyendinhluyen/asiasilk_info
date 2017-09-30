<?php

	$news_key = input($_GET['news_key']);

	$info = '';
	
	$cate = input($_GET['cate']);
	
	$news = new News();
	
	$info = $xtemplate->load('info_detail_libary');

	$promotionNews = $news->getDetailNews($news_key);		
	
	//CHO DUONG LINK REFERENCE		
	//Dung cho noi dung
	for ($i = 1; $i < 100;$i++)
	{
		if($i < 10)
		{
			$promotionNews['news_content'] = str_replace('begin'.$i,'<A href="#section'.$i.'"style="color:#000; text-decoration:underline">',$promotionNews['news_content']);
			
			$promotionNews['news_content'] = str_replace('end'.$i,'</A>',$promotionNews['news_content']);		
			
			$promotionNews['news_content'] = str_replace('beginreference'.$i,'<A name="section'.$i.'"style="color:#000">',$promotionNews['news_content']);
			$promotionNews['news_content'] = str_replace('endreference'.$i,'</A>',$promotionNews['news_content']);
		}
		else
		{
			$promotionNews['news_content'] = str_replace('begin0'.$i,'<A href="#section'.$i.'"style="color:#000; text-decoration:underline">',$promotionNews['news_content']);
			
			$promotionNews['news_content'] = str_replace('end0'.$i,'</A>',$promotionNews['news_content']);		
			
			$promotionNews['news_content'] = str_replace('beginreference0'.$i,'<A name="section'.$i.'"style="color:#000">',$promotionNews['news_content']);
			$promotionNews['news_content'] = str_replace('endreference0'.$i,'</A>',$promotionNews['news_content']);
		}
	}
		
	//Thay cho toppage
	
	$promotionNews['news_content'] = str_replace('toppage','<A href="#section0" style="text-decoration:underline"> <b>Về đầu trang</b> </A>',$promotionNews['news_content']);
	
	$promotionNews['resource'] = str_replace('beginnanapet','<a href = "', $promotionNews['resource']);
	
	$promotionNews['resource'] = str_replace('referencenanapet','" target="_blank">', $promotionNews['resource']);
		
	$promotionNews['resource'] = str_replace('endnanapet','</a>', $promotionNews['resource']);
		
	$info  = $xtemplate->replace($info,array(

								'news_name'			=> $promotionNews['news_name'],

								'news_content'		=> $promotionNews['news_content'],
								
								'news_shortcontent'	=> $promotionNews['news_shortcontent'],

								'news_key'			=> "thu-vien/".$promotionNews['news_key']."/",

								'news_name_twitter' => $promotionNews['news_name']." - ",

								'linkResource' 		=> $promotionNews['resource'],
								
								'author'			=> $promotionNews['author'],	

								'translator'        => $promotionNews['translator'],
								
								'date_added'        => date('d/m/y',$promotionNews['date_added']),
									
								));	

	$library_active = 'library_active';

	$bread = "Tin tức - Sự kiện";

	$link = "{linkS}thu-vien";
		

	$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
		
	if($news_key != ''){

		$breadcrumbs_path .= ' &raquo; <a href="'.$link.'">'.$bread.'</a>'.'&raquo; &nbsp;'.$promotionNews['news_name'];

	}

	else{

		$breadcrumbs_path .= ' &raquo; '.$bread;

	}	

	$content = $info ;

	

?>

