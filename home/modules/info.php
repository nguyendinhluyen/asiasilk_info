<?php
	$flag = input($_GET['flag']);
	$info = '';
	//echo $flag;
	//gioi-thie flag=1
	//nhan-nuoi-pet flag=2
	//thu-vien flag=3
	//kuyen-mai flag=4
	//thu-gian flag=5
	//lien-he flag=6
	//tin tuc flag=7
	$news = new News();
	switch($flag)
	{
		case 1:
			$about_active = 'about_active';
			$info = $xtemplate->load('introduce');
			$introduce = $news->getIntroduce();
			$info  = $xtemplate->replace($info,array(
								'gioithieuchung'		=> $introduce[1]['news_content'],
								'thuongmaidientu'		=> $introduce[0]['news_content'],
								'titlegioithieuchung'	=> $introduce[1]['news_name'],
								'titlethuongmaidientu'	=> $introduce[0]['news_name'],								
								));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo;'.' Giới thiệu';
			$tilte_page =   'Giới thiệu'. " | ASIASILK";
			break;

		case 2:
			$adoption_active = 'adoption_active';
			$info = $xtemplate->load('pet');
			$pet = $news->getPet();
			$info  = $xtemplate->replace($info,array(
											'gioithieu'			=> $pet[1]['news_content'],
											'diendanyeudongvat'	=> $pet[0]['news_content'],
											'titlegioithieu' 	=> $pet[1]['news_name'],
											'titlediendanyeudongvat' => $pet[0]['news_name'],
											
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo;'.' Nhận nuôi Pet';
			$tilte_page =   'Nhận nuôi Pet'. " | ASIASILK";
			break;

		case 3:
					
			///$library_active = 'library_active';
			//$imageSlider = new ImageSlider();
			///$info = $xtemplate->load('media');			
			//$block = $xtemplate->get_block_from_str($info,'IMAGE');
			//$images = $imageSlider->getAllImages();
			//$tpl ='';
			//foreach ($images as $value) {
			//	$tpl.= $xtemplate->assign_vars($block,array(
			//					'image_name' => $value['recordText']
			//					));
			//}
			//$info  = $xtemplate->assign_blocks_content($info ,array(
			//															'IMAGES'=>$tpl
			//));			
			///$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			///$breadcrumbs_path .= ' &raquo; '.'Thư viện';
			///$tilte_page =   'Thư viện'. " | ASIASILK";
			
			
			if(input($_GET['type']) == 'dinhduong')
			{
				$libaries = $news->getNewsListDinhDuong();												
			}
			
			else if(input($_GET['type']) == 'chamsoc')
			{
				$libaries = $news->getNewsListChamSoc();												
			}
			
			else if(input($_GET['type']) == 'thuy')
			{
				$libaries = $news->getNewsListThuY();															
			}
			
			else if(input($_GET['choose']) == "choose-dog")
			{
				$libaries = $news->getNewsListAllLibaryDog();				
			}
			
			else if(input($_GET['choose']) == "choose-cat")
			{
				$libaries = $news->getNewsListAllLibaryCat();				
			}
			
			else
			{
				$libaries = $news->getNewsListAllLibary();												
			}
						
			$library_active = 'library_active';
			
			$info = $xtemplate->load('libary');				
			
			$total = count($libaries);
				
			//Phan trang			
			
			$pp = 5;
			
			$p_now = intval($_GET ['page']);			
				
			$numofpages = $total / $pp;

			$page = 0;

			if ($p_now <= 0)
			{
				$page = 1;
			}
			else
			{
				if($p_now <= ceil($numofpages))

					$page = $p_now;
				else

					$page = 1;
			}

			$limitvalue = $page * $pp - ($pp);
			//end phan trang
				
			// LAY TUY THEO LOAI DANH MUC DUOC CHON	
					
			$begin = $limitvalue;

			if($numofpages != $p_now)
			{	
				$end =  $begin + $pp;	
			}
			else
			{
				$end =  $total;					
			}
									
			$block = $xtemplate->get_block_from_str($info,'PROMOTION');
	
			$tpl = '';
	
			$n = count($libaries);
	
			for($i = $begin; $i < $end; $i++)
			{					
				if($libaries[$i]['news_name'] != "")
				{
					$tpl.= $xtemplate->assign_vars($block,array(
						'news_name'   => $libaries[$i]['news_name'],
						'news_short'  => $libaries[$i]['news_shortcontent'],
						'news_key' 	  => $libaries[$i]['news_key'],
						'news_image'  => $libaries[$i]['news_image'],
						'date'   	  => date('d',$libaries[$i]['date_added']),
						'month'   	  => date('m',$libaries[$i]['date_added']),
						'year'   	  => date('y',$libaries[$i]['date_added']),
						'person_up'   => 'Đăng bởi: '. $libaries[$i]['translator'],
						));
				}
			}
				
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Tin tức - Sự kiện';
			$tilte_page =   'Tin tức - Sự kiện'. " | ASIASILK";	
			$info  = $xtemplate->assign_blocks_content($info ,array(
															'PROMOTION'=>$tpl
							));											
			
			if(input($_GET['type']) == 'dinhduong')
			{
			
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."dinh-duong/",ceil($numofpages), $page),
							));							
			}
			else if(input($_GET['type']) == 'chamsoc')
			{
			
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."cham-soc/",ceil($numofpages), $page),
							));							
			}
			else if(input($_GET['type']) == 'thuy')
			{
			
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."thu-y/",ceil($numofpages), $page),
							));							
			}
			
			else if(input($_GET['choose']) == "choose-dog")
			{
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."thu-vien/choose-dog.html/",ceil($numofpages), $page),
							));							
			}

			else if(input($_GET['choose']) == "choose-cat")
			{
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."thu-vien/choose-cat.html/",ceil($numofpages), $page),
							));							
			}

			else if(input($_GET['choose']) == "choose-all")
			{
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."thu-vien/choose-all.html/",ceil($numofpages), $page),
							));							
			}

			else
			{
			
				$info = $xtemplate->replace($info,array(
							'page'	=> pagination($linkS."thu-vien/",ceil($numofpages), $page),
							));							
			}
								
			break;
			
		case 4:
			$promotion_active = 'promotion_active';
			$info = $xtemplate->load('promotion');
			$promotions = $news->getNewsListPromotion();
			
			$total = count($promotions);
			//Phan trang
			//echo 'key:'.$key;
			$pp = 5;
			$p_now 		= intval($_GET ['page']);
			$numofpages = $total / $pp;
			$page = 0;
			if ($p_now <= 0)
			{
				$page = 1;
			}
			else
			{
				if($p_now <= ceil($numofpages))
				$page = $p_now;
				else
				$page = 1;
			}
			$limitvalue = $page * $pp - ($pp);
			//end phan trang
			
			
			$promotion = $news->getNewsListPromotionLimit($limitvalue,$pp);
			
			$block = $xtemplate->get_block_from_str($info,'PROMOTION');
			$tpl = '';
			$n = count($promotion);
			
			for($i=0;$i<$n;++$i)
			{
				
				$tpl.= $xtemplate->assign_vars($block,array(
						'news_name'   => $promotion[$i]['news_name'],
						'news_short'  => $promotion[$i]['news_shortcontent'],
						'news_key' 	  => $promotion[$i]['news_key'],
						//'type' 		  => $type,
						//'category' 	  => $category
					));
			}
			//echo $tpl;
			
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Khuyến mãi';
			$tilte_page =   'Khuyến mãi'. " | ASIASILK";
			$info  = $xtemplate->assign_blocks_content($info ,array(
															'PROMOTION'=>$tpl
			));
			
			$info = $xtemplate->replace($info,array(
						'page'	=> pagination($linkS."khuyen-mai/",ceil ( $numofpages ), $page),
			));
			
			break;
		case 5:
			$relax_active = 'relax_active';
			$info = $xtemplate->load('relax');
			$pet = $news->getPet();
			
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Tuyển dụng';
			$tilte_page =   'Giải trí'. " | ASIASILK";
			break;
		case 6:
			$contact_active = 'contact_active';
			$info = $xtemplate->load('contact');
			$contact = $news->getContact();
			$info  = $xtemplate->replace($info,array(
										'contact'		=> $contact[0]['news_content'],
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Liên hệ';
			$tilte_page =   'Liên hệ'. " | ASIASILK";
			break;
		
		case 7:
			$info = $xtemplate->load('promotion');
			$promotions = $news->getNews();
				
			$total = count($promotions);
			//Phan trang
			//echo 'key:'.$key;
			$pp = 1;
			$p_now 		= 	intval($_GET ['page']);
			$numofpages = $total / $pp;
			$page = 0;
			if ($p_now <= 0)
			{
				$page = 1;
			}
			else
			{
				if($p_now <= ceil($numofpages))
				$page = $p_now;
				else
				$page = 1;
			}
			$limitvalue = $page * $pp - ($pp);
			//end phan trang
				
				
			$promotion = $news->getNewsListPromotionLimit($limitvalue,$pp);
				
			$block = $xtemplate->get_block_from_str($info,'PROMOTION');
			$tpl = '';
			$n = count($promotion);
			for($i=0;$i<$n;++$i)
			{
		
				$tpl.= $xtemplate->assign_vars($block,array(
								'news_name'   => $promotion[$i]['news_name'],
								'news_short'  => $promotion[$i]['news_shortcontent'],
								'news_key' 	  => $promotion[$i]['news_key'],
				//'type' 		  => $type,
				//'category' 	  => $category
				));
			}
			//echo $tpl;
				
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Thư giãn';
			$tilte_page =   'Thư giãn'. " | ASIASILK";
			$info  = $xtemplate->assign_blocks_content($info ,array(
																	'PROMOTION'=>$tpl
			));
				
			$info = $xtemplate->replace($info,array(
								'page'	=> pagination($linkS."khuyen-mai/",ceil ( $numofpages ), $page),
			));
				
			break;
		case 8://Câu hỏi thường gặp
			$info = $xtemplate->load('contact1');
			$contact = $news->getFAQ();
			$info  = $xtemplate->replace($info,array(
													'contact'		=> $contact[0]['news_content'],
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Câu hỏi thường gặp';
			$tilte_page =   'Câu hỏi thường gặp'. " | ASIASILK";
			break;
		case 9://huong dan mua hang
			$info = $xtemplate->load('contact1');
			$contact = $news->getCartHelp();
			$info  = $xtemplate->replace($info,array(
															'contact'		=> $contact[0]['news_content'],
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Hướng dẫn mua hàng';
			$tilte_page =   'Hướng dẫn mua hàng'. " | ASIASILK";
			break;

		case 10://thanh toan
			$info = $xtemplate->load('contact1');
			$contact = $news->getCoupon();
			$info  = $xtemplate->replace($info,array(
															'contact'		=> $contact[0]['news_content'],
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Câu hỏi thường gặp';
			$tilte_page =   'Câu hỏi thường gặp'. " | ASIASILK";
			break;
		case 11://van chuyen 
			$info = $xtemplate->load('contact1');
			$contact = $news->getVanChuyen();
			$info  = $xtemplate->replace($info,array(
																	'contact'		=> $contact[0]['news_content'],
			));
			$breadcrumbs_path .= '<a href="{linkS}">ASIASILK</a>';
			$breadcrumbs_path .= ' &raquo; '.'Hướng dẫn mua hàng';
			$tilte_page =   'Hướng dẫn mua hàng'. " | ASIASILK";
			break;
			
			
		default:
			$info = $xtemplate->load('introduce');
			break;
	}

	
	$content = $info ;
	
?>
