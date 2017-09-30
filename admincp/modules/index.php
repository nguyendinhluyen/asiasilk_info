<?php
	ob_start();
	@session_start();
	
	if(isset($_SESSION['admin']))
	{
		define('_INCLUDEA','../include/');
		include(_INCLUDEA."admin_start.php");
		include(_INCLUDE."lag_config.php");
		include(_INCLUDE."function.php");
		include(_INCLUDEA."function_admin.php");
		include(_CLASS."xtemplate.php");
		include(_INCLUDEA."Product.php");

		$xtemplate = new Template();
		$show = input($_GET['show']);
	
		//kiểm tra xem có session lưu hình ảnh hay không , nếu có xóa hết
		if(($show!='OptProduct')&&(isset($_SESSION['UFILE'])))
		{
			$arrfile = $_SESSION['UFILE'];
			$n = sizeof($arrfile);
			$tempArr = array();
			if($n > 0)
			{
				foreach($arrfile as $fvalue)
				{
					@unlink(_UPLOAD_FILE.$fvalue);
				}
			}
			unset($_SESSION['UFILE']);
		}	
		include('com_admin/menu.php');

		switch($show)
		{
			case 'logout':
				session_destroy();
				header("location:../index.php");
				break;

			// Admin Control Panel
			case 'report':							
				if(strpos($_SESSION['admin'][3], ';1;') !== false)
				{
					include('com_report/report.php');			
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}
				break;
				
			// Admin Control Users
			case 'com_control_user_account':	
				if(strpos($_SESSION['admin'][3], ';2;') !== false)
				{
					include('com_control_user_account/imgGalary.php');
				}		
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;			
				
			case 'Opt_com_control_user_account':
				if(strpos($_SESSION['admin'][3], ';2;') !== false)
				{
					include('com_control_user_account/Opt_imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
				
			// General Information (Thong tin chung)
			case 'content':	
				if(strpos($_SESSION['admin'][3], ';3;') !== false)
				{
					include('com_content/content.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;				
				
			// Keywords (Quan ly tu khoa)	
			case 'keywords':
				if(strpos($_SESSION['admin'][3], ';4;') !== false)
				{
					include('com_keywords/keywords.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;				
			case 'Optkeywords':			
				if(strpos($_SESSION['admin'][3], ';4;') !== false)
				{
					include('com_keywords/Optkeywords.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;				
				
			// Statictis Vistors (Thong ke truy cap)
			case 'visitor':
				if(strpos($_SESSION['admin'][3], ';5;') !== false)
				{
					include('com_visitor/visitor.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
	
			// Online Persons (Ai dang online)
			case 'who':
				if(strpos($_SESSION['admin'][3], ';6;') !== false)
				{
					include('com_who/who.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			
			// Contact (Lien he)				
			case 'contact':
				if(strpos($_SESSION['admin'][3], ';7;') !== false)
				{
					include('com_contact/contactList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'contactdetail':
				if(strpos($_SESSION['admin'][3], ';7;') !== false)
				{
					include('com_contact/contactDetail.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
																																	
			// Catalogue (Danh mục)
			case 'catalogue':
				if(strpos($_SESSION['admin'][3], ';8;') !== false)
				{
					include('com_catalogue/ListCatalogue.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'catalogueTree':
				if(strpos($_SESSION['admin'][3], ';8;') !== false)
				{
					include('com_catalogue/ListCatalogueTree.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'CatalogueOpt':
				if(strpos($_SESSION['admin'][3], ';8;') !== false)
				{
					include('com_catalogue/CatalogueOpt.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
												
			// Product (Danh sach san pham)
			case 'product':
				if(strpos($_SESSION['admin'][3], ';9;') !== false)
				{
					include('com_product/ProductList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'OptProduct':
				if(strpos($_SESSION['admin'][3], ';9;') !== false)
				{
					include('com_product/OptProduct.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;			
				
			//San pham khuyen mai
			case 'khuyenmai':
				if(strpos($_SESSION['admin'][3], ';10;') !== false)
				{
					include('com_product/khuyenmai.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			
			//San pham ban chay
			case 'sanphambanchay':
				if(strpos($_SESSION['admin'][3], ';11;') !== false)
				{
					include('com_product/sanphambanchay.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;

			// Phi van chuyen
			case 'imgGallery':
				if(strpos($_SESSION['admin'][3], ';12;') !== false)
				{
					include('com_img_galary/imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;												
			case 'Opt_imgGallery':
				if(strpos($_SESSION['admin'][3], ';12;') !== false)
				{
					include('com_img_galary/Opt_imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;	
						
			// Order from Customer (Danh sach hoa don)
			case 'order':
				if(strpos($_SESSION['admin'][3], ';13;') !== false)
				{
					include('com_order/orderList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'orderdetail':
				if(strpos($_SESSION['admin'][3], ';13;') !== false)
				{
					include('com_order/orderDetail.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'edit_orderdetail':
				if(strpos($_SESSION['admin'][3], ';13;') !== false)
				{
					include('com_order/Opt_imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;					
			case 'neworder':
				if(strpos($_SESSION['admin'][3], ';13;') !== false)
				{
					include('com_order/neworder.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;	
				
			// VIP Customer (Quan ly KHTT)
			case 'VIPCustomer':
				if(strpos($_SESSION['admin'][3], ';14;') !== false)
				{
					include('com_VIPCustomer/imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'Opt_VipCusomer':
				if(strpos($_SESSION['admin'][3], ';14;') !== false)
				{
					include('com_VIPCustomer/Opt_imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;		
			
			// Fee Memeber (Danh sach phi KHTT)
			case 'feeMember':						
				if(strpos($_SESSION['admin'][3], ';15;') !== false)
				{
					include('com_Fee_GroupMember/FeeList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
				
			// Quan ly Group Member
			case 'GroupMember':
				if(strpos($_SESSION['admin'][3], ';16;') !== false)
				{
					include('com_AdminMember/imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'Opt_GroupMember':
				if(strpos($_SESSION['admin'][3], ';16;') !== false)
				{
					include('com_AdminMember/Opt_imgGalary.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
						
			// Danh sach GroupMember
			case 'ListGroupMember':
				if(strpos($_SESSION['admin'][3], ';17;') !== false)
				{
					include('com_Fee_GroupMember/FeeListMember.php');					
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}
				break;
																			
			// CHUA BAO MAT 
			case 'newsList':
				include('com_news/NewsList.php');
				break;
				
			case 'newsList_opt_1':
				include('com_news/NewsList_opt_1.php');
				break;
																			
			case 'OptNews':
				include('com_news/OptNews.php');
				break;

			// Ads (Danh sach anh)
			case 'Ads':
				if(strpos($_SESSION['admin'][3], ';21;') !== false)
				{
					include('com_ads/ListAds.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'AdsOpt':
				if(strpos($_SESSION['admin'][3], ';21;') !== false)
				{
					include('com_ads/AdsOpt.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
						
			// Danh sach tai khoan
			case 'memberList':
				if(strpos($_SESSION['admin'][3], ';22;') !== false)
				{
					include('com_user/memberList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'memberUpdate':
				if(strpos($_SESSION['admin'][3], ';22;') !== false)
				{
					include('com_user/memberUpdate.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			
			// Ho tro khach hang
			case 'support':
				if(strpos($_SESSION['admin'][3], ';23;') !== false)
				{
					include('com_support/SupportList.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}		
				break;
			case 'SupportOpt':
				if(strpos($_SESSION['admin'][3], ';23;') !== false)
				{
					include('com_support/SupportOpt.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}	
				break;

			// Cau hinh
			case 'config':
				if(strpos($_SESSION['admin'][3], ';25;') !== false)
				{
					include('com_config/config.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}	
				break;
			
			// Cam IP truy cap
			case 'iba':
				if(strpos($_SESSION['admin'][3], ';26;') !== false)
				{
					include('com_iba/iba.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}	
				break;
			
			// Cap Nhat Super Admin
			case 'account':
				if(strpos($_SESSION['admin'][3], ';27;') !== false)
				{
					include('com_account/account.php');
				}
				else
				{
					?>
						<script>
							alert("Bạn không được cấp quyền truy cập trang này!");
						</script>
                    <?php
				}	
				break;			
														
			
									
				
			/*case 'comment':
				include('com_product/ProductComment.php');
				break;	
			case 'template':
				include('com_template/template.php');
				break;
			case 'Opttemplate':
				include('com_template/Opttemplate.php');
				break;			
			case 'downloadOpt':
				include('com_download/DownloadOpt.php');
				break;
			case 'downloadList':
				include('com_download/ListDownload.php');
				break;*/															
				
			// Catalogue News
			/*case 'CatalogueNewsList':
				include('com_news/Catalogue_News_list.php');
				break;
			case 'CatalogueNewsOpt':
				include('com_news/Catalogue_News_Opt.php');
				break;*/						
			
			// Send mail
			/*case 'mail':
				include('com_mail/mail.php');
				break;		
			case 'mailAds':
				include('com_mail/mailAds.php');
				break;*/								
	
			// Replace Word
			/*case 'wordsReplace':
				include('com_word/word.php');
				break;*/
																												
			// Website
			/*case 'webList':
				include('com_web/webList.php');
				break;
			case 'Optweb':
				include('com_web/Optweb.php');
				break;				
			case 'memberScore':
				include('com_user/memberScore.php');
				break;*/																									
			/*case 'sanphammoi':
				include('com_product/sanphammoi.php');
				break;*/
			/*case 'NewsOpt':
				include('com_news/NewsOpt.php');
				break;*/
			/*case 'productOpt':
				include('com_product/ProductOpt.php');
				break;*/
			/*case 'memberListB':
				include('com_user/memberListB.php');
				break;*/
			/*case 'memberGroup':
				include('com_user/memberGroup.php');
				break;*/
				
			default:							
				include('com_report/report.php');
				break;
		}
	
		$xtemplate -> path = "com_admin/";
		$html = $xtemplate -> load("index");
		$html = $xtemplate -> replace($html,array(
													'title'	  => $title,
													'meta'	  => $meta,
													'script'  => $script,
													'content' => $content,
													'menu'	  => $menu,													
												  ));
		$xtemplate -> show($html);
		include(_INCLUDEA."admin_end.php");
	}
	else
	{	
		$_SESSION['return'] = $_SERVER['QUERY_STRING'];
		header("location:../");
	}
?>