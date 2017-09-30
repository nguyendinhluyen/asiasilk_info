<?php
	
	$news_left = $xtemplate->load('news_left');

	$News = new News();

	$_news = $News->getNewsNewest(10);

	$n = count($_news);

	//print_r($products);

	$tpl = '';

	$tpl_temp = '';			

	$block = $xtemplate->get_block_from_str($news_left,'NEWSLEFT');					
	
	for($i=0 ; $i<$n;++$i)
	{	
		if($_news[$i]['news_catalogue'] == 27 || $_news[$i]['news_catalogue'] == 28 || $_news[$i]['news_catalogue'] == 29)
		{
			$newlink = "thu-vien";
		}
		
		else if($_news[$i]['help_flag'] == 1)
		{
			$newlink = "tro-giup";			
			
			$_news[$i]['news_key'] =  $_news[$i]['news_key'].'.html';
									
		}
		else
		{
			$newlink = "thu-gian";
		}
				
		$tpl_temp .= $xtemplate->assign_vars($block,array(

						'news_name'		=> $_news[$i]['news_name'],

						'news_key'		=> $_news[$i]['news_key'],

						'new_link'      => $newlink,

		));			
		
	}	

	$tpl = '<ul>'.$tpl_temp.'</ul>';
		
	$tpl = str_replace (".html/",".html",$tpl);					

	$news_left = $xtemplate->assign_blocks_content($news_left ,array(

														'NEWSLEFTS'=>$tpl

	));

?>