<head>
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.arctic.css" type="text/css"/>
    <script type="text/javascript" src="{linkS}layout/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxrating.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function () 
	{
     	// Create jqxRating
      	$("#jqxRating").jqxRating({ width: 100, height: 35, theme: 'classic'});			
		$('#jqxRating').jqxRating({singleVote:true});											
		$("#jqxRating").on('change', function (event)
		{																					
			var user_name = document.getElementById("user_name").innerHTML;								
			if(user_name == " ")
			{																										  						
				alert( "Bạn phải đăng nhập để đánh giá sản phẩm!");					
			}				
			else if(user_name != " ")
			{
	        	rate_count = 0;
				rate_sum = 0;
				rate_avg = 0;
				$("#rate").find('span').remove();
        	    $("#rate").append('<span>' + event.value + '</span');
				var ketqua = event.value;
				rate_sum = parseInt(document.getElementById("rate_sum").innerHTML);
				rate_sum += parseInt(ketqua);
				rate_count = parseInt(document.getElementById("rate_count").innerHTML);
				rate_count++;
				rate_avg = Math.ceil(rate_sum / rate_count);																
				var rating = document.getElementById("count_rates");
				listrate = "";
				for( i = 0 ; i < rate_avg; i++)
				{
					listrate += '<img src = {linkS}layout/images/star.png>';
				}		
				rating.innerHTML = listrate;
				document.getElementById("rate_count").innerHTML	= rate_count;
					alert("Bạn đánh giá sản phẩm " + ketqua + " sao!");					
					addVoteForProduct();										
				}				
            });
       });
</script>
<style>
	.showrate{
		height: 20px;
		float: left;
	}
	.list_images{
		margin-top:10px;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
	}
	.cloud-zoom-gallery{
		width: 60px;
		height: 70px;
		padding : 20px;

		
	}
	.share{
	float: left;
	width: 19px;
	}
</style>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="{linkS}layout/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$(".tab_content").hide(); 
	$("ul.tabs li:first").addClass("active").show(); 
	$(".tab_content:first").show(); 			
	$("ul.tabs li").click(function() 
	{		
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();		
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
	});		
	});
	var soc = document.createElement('script'); soc.type = 'text/javascript'; soc.async = true;
	soc.src = 'http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4bd00fcc4d8a7449';
	var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(soc, ss);
</script>
<div id="product">
	<div id="breakcrumb" style="font-family:Cambria; 
    							font-size:14px; margin-top:20px">{breadcrumbs_path}</div>
    <div style="height:30px; width:729px;float: left; margin-left: 11px;margin-top: 5px;">
        <div style="height:30px;float: left; font-family:Cambria; font-size:14px; margin-top:10px"> 
       		<a href="{linkS}{linkPrev}">{product_name_prev}</a>
        </div>        
        <div id = "user_name" style="display:none"> {user_name}</div>
        <div id = "rate_sum" style="display:none"> {rate_sum}</div>               
        <div style="height:30px;float: right; font-family:Cambria; font-size:14px; margin-top:10px">
        	<a href="{linkS}{linkNext}"> {product_name_next}</a>
        </div>
    </div>        
    <div class="col1_content">
    	<div id="detail1">
            <!--<div id="pro_big"></div>-->
           	<div class="list_images">
           	<a href="{linkS}upload/product/thumb/{product_image}"
                       class ="cloud-zoom" 
                       id="zoom1" 
                       rel="tint: '#666',tintOpacity:0.4 ,smoothMove:7,zoomWidth:355, zoomHeight:311, adjustY:-4, adjustX:10">
                       <h4>                      
                     		<img src="{linkS}upload/product/thumb/{product_image}" style="width:250px; height:315px;" 
                            	 class="img_big" 
                                 alt="{product_name}"/>
                       </h4>
                       </a>{list_img_product} </div>
        </div><!-- end detail1 -->
		<form name='cart' action="{linkS}gio-hang/{product_key}/add" method="post">
        	<div id="detail2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">
            	<div id="detail2_info">
                <div>
	                <h3 style="font-size:17px; font-weight:lighter; margin-bottom:-10px">
                    	<b style="color: #ED1B24;">{product_name}</b>
                    </h3>
                </div>
               		<table cellpadding="0" cellspacing="0" border = "0">
                    	<!-- Face, twitter ... -->
                        <tr>
                			<td colspan="2" id="ten_sp">
                                                        	
                                <br style="clear:both"/> 
                            	<div class="share">
                                <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4bd00fcc4d8a7449" 
                                   class="addthis_button_compact"></a></div>
                                <div class="share">
                                	<a class="addthis_button_facebook"></a> 
                                </div>
                                <div class="share">
                                	<a class="addthis_button_google"></a>
                                </div>
                                <div class="share">
                                	<a class="addthis_button_twitter"></a>
                                </div>
							</td>
                            <td align="right">{img_catdog}</td>
                        </tr>                                                            
                        <!-- Nha san xuat -->
                        <tr>
                        	<td class="sp_info1" style="width: 700px;">
                            	<span class="rect">Nhà sản xuất </span>
                            </td>
                            <td class="sp_info2">
                            	<span class="promotion">
                                	<a href="{linknsx}" target="_blank">{nsx}</a>
                                </span>
                          	</td>                            
                        </tr>                        
                        <!-- Xuat xu -->
                        <tr>
                        	<td class="sp_info1" style="width: 200px; padding-bottom:10px">
                            	<span class="rect">Xuất xứ </span>
                            </td>
                            <td class="sp_info2">
                            	<span class="promotion">{xuatxu}</span>
                            </td>
                        </tr>
                        	{product_color}
                            {product_type}  
                        	{khuyenmai}                                                                                                                         	
                        	<!-- Gia tham khao -->
                            <tr style="vertical-align:top;">
                            	
                                    </tr>
                                    <tr style="vertical-align:top;" height="35px">
                                        <td class="sp_info1"><span class="rect">Số lượng </span></td>
                                        <td class="sp_info2"><span class="promotion">
                                        	<select name='quantity' id='quantity'>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
                                        </span></td>                                 
                                    </tr>
                                    <tr>
                                        <td class="sp_info1" style="width: 250px;"><span class="rect">  Tình trạng </span></td>
                                        <td class="sp_info2"><span class="promotion" style="color: #ED1B24;"><div>{status}</div></span></td>
                                    </tr>                                                               
                                    
                                    <tr style="margin-top:20px">
                                     	<td>
                                        	<a style="font-size: 13px;
                                            		  color:#A00; 
                                            		  font-weight:bold; 

                                                      text-align:left">Số người đánh giá</a>
                                     	<td>
                                        	<div id = "rate_count" style="font-size: 13px;
                                            							  color:#A00; 
                                                                          font-weight:bold;"> {rate_count}
                                        	</div>			   				
                                        </td>
                                        
                                    </tr>
                                    <tr>                                        
                                        <td>
                                        	<a style="font-size: 13px;
                                            		  color:#A00; 
                                            		  font-weight:bold;                                                      
                                                      text-align:left" href="#section3"> Đánh giá trung bình
                                        	</a>
                                        </td>                                        
                                        <td width="100px;">
                                        	<span id="count_rates" style="font-family:Cambria; font-size:15px"> {count_rates} </span>
                                        </td>
                                        <td width="145px;" style="float:right">
                                            <a name ="section1"/>                                
                                            <a href="#addToMyFavorite" onclick="addToMyFavorite();">{them_vao_ua_thich}</a></td>
                                    </tr>	                                                                                               
                                </table>                   
                                <div style="margin-top:20px; float:left"> 
                                	<input type="submit" class="addcart" {hidden} 
                                    					 value="Đặt Hàng"  
                                                         style="text-align:center; 
                                                         		font-family:Cambria; 
                                                                font-size:18px; 
                                                         		color:#FFFBF0; 
                                                                font-weight:bold"/>                                                                                  
                                </div>                                                            
                          </div><!-- end detail2_info -->                                
                        </div><!-- end detail2 -->
                       </form>                                                 
                        <div class="clear"></div>                                                
                        <div id="detail3" style="margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px">
                        
	                        <div style="margin-left:20px; height:20px">
                                
                               	<a  href="#section1" style="font-size:15px; color:#A00; font-weight:bold; margin-right:10px; padding-top:10px; padding-bottom:10px; padding-left: 10px; padding-right:10px;background:#FFF2F2; -moz-border-radius: 7px 7px 0px 0px; border-radius: 7px 7px 0px 0px;">Thông tin sản phẩm 
                                </a>
                                
                             	<a href="#section2" style="font-size:15px; color:#A00; font-weight:bold; margin-right:10px; padding-top:10px; padding-bottom:10px; padding-left: 10px; padding-right:10px;background:#FFF2F2; -moz-border-radius: 7px 7px 0px 0px; border-radius: 7px 7px 0px 0px;">Ý kiến khách hàng 
                                </a>     
                                <a href="#section3" style="font-size:15px; color:#A00; font-weight:bold; margin-right:10px; padding-top:10px; padding-bottom:10px; padding-left: 10px; padding-right:10px;background:#FFF2F2; -moz-border-radius: 7px 7px 0px 0px; border-radius: 7px 7px 0px 0px;">Đánh giá sản phẩm
                                </a>                         
                            </div>
                            <div id = "line_customer" style=" box-shadow: 1px 1px 1px #DDF; width: 95%; height: 1px; margin-bottom:20px; margin-top:7px; margin-left:20px;">                                    
                            </div>	                                              
                            <div id="tab_container" style="margin-right:5px">                           
                                <div>
                                <div id = "info_product">
                                	<div align="justify" 
                                     	 style=" margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail};
                                                 font-weight:bold;">
                                    	Giới thiệu
                                    </div>
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail}
                                    </div>
                                    
                                    <div align="justify" 
                                     	 style=" margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_tacdung};
                                                 font-weight:bold;">
                                    	Tác Dụng
                                    </div>                                    
                                                                        
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_tacdung}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	 style=" margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_phuhopcho};
                                                 font-weight:bold;">
                                    	Phù Hợp Cho
                                    </div>    
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_phuhopcho}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	 style=" margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_nguyenlieu_thanhphan};
                                                 font-weight:bold;">
                                    	Nguyên Liệu / Thành Phần
                                    </div>   
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_nguyenlieu_thanhphan}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	 style=" margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_phantichdambao};
                                                 font-weight:bold;">
                                    	Phân Tích Đảm Bảo
                                    </div>  
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_phantichdambao}
                                    </div>   
                                   
                                  	<div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_huongdansudung};
                                                 font-weight:bold;">
                                    	Hướng Dẫn Sử Dụng
                                    </div>  
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_huongdansudung}
                                    </div>
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_huongdanbaoquan};
                                                 font-weight:bold;">
                                    	Hướng Dẫn Bảo Quản
                                    </div>    
                                                    
                                   	<div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_huongdanbaoquan}
                                    </div>
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_luuy};
                                                 font-weight:bold;">
                                    	Lưu Ý
                                    </div> 
                                       
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_luuy}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_khuyenkhich};
                                                 font-weight:bold;">
                                    	Khuyến Khích
                                    </div>
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_khuyenkhich}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_donggoi_thetich};
                                                 font-weight:bold;">
                                    	Đóng Gói / Thể Tích
                                    </div>
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_donggoi_thetich}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_nhasanxuat};
                                                 font-weight:bold;">
                                    	Nhà Sản Xuất
                                    </div>
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_nhasanxuat}
                                    </div>   
                                    
                                    <div align="justify" 
                                     	  style="margin-left:20px; 
                                          		 margin-right:10px; 
                                                 margin-bottom:10px; 
                                                 font-family:Cambria; 
                                                 font-size:15px;
                                                 display:{display_product_detail_xuatxu};
                                                 font-weight:bold;">
                                    	Xuất Xứ
                                    </div>
                                    
                                    <div align="justify" style="margin-left:20px; margin-right:10px; margin-bottom:10px">
                                    	{product_detail_xuatxu}
                                    </div>                 
                                                    
                                    <a name = "section2"/>                    
                                    <a name = "section3"/>
                                    <div id = "line_customer" style=" box-shadow: 1px 1px 1px #A00; width: 96%; height: 1px; margin-bottom:20px; margin-top:10px; margin-left:20px;">                                    	
                                    </div>                                    
                                    {form_comment}
                                </div>                                                                                                                             
                            </div><!-- end tab_container -->                            
                        </div><!-- end detail3 -->                       
                    </div><!-- end col1_content -->                       
                </div><!-- end product -->                
                <link rel="stylesheet" href="{linkS}layout/css/postfinal.css" type="text/css" />                				 
				<div id="lightbox-panel">				
					<div align="right"><a id="close-panel" href="#" onclick="return false;">
                    	<img src="{linkS}layout/images/ico_close.gif"/></a>
                    </div>
					<div id="chartRating" >					
					</div>			
				</div><!-- /lightbox-panel -->  				  
				<div id="lightbox"> </div><!-- /lightbox -->                   
               <div style="display: none;">
               		<div id="product_name_hidden">{product_name}</div>
               		<div id="product_quantity_hidden">{product_quantity}</div>
               		<div id="total_amount_hidden">{total_amount}</div>
               		<div id="email_hidden">{email}</div>
               </div>                
        <link rel="stylesheet" href="{linkS}plugins/jrating_v2.1/jquery/jRating.jquery.css" type="text/css" />
 		<script type="text/javascript" src="{linkS}plugins/jrating_v2.1/jquery/jRating.jquery.js"></script>
        <script type="text/javascript">
		$(document).ready(function(){			
			$('.rating').jRating({
				step:false,
				length:5,
				decimalLength:1,
				rateMax:5,
				onSuccess : function(){
					var mail = $("#email_hidden").text();
					if(mail != "")
						alert('Bạn đánh giá cho sản phầm '+ rateProduct + ' sao.');
					else
						alert("Bạn phải đăng nhập để đánh giá");
				},
				onError : function(){
					alert('Error : please retry');
				}
			});
		
		});
	</script>		
	
<script type="text/javascript">  
	 $(document).ready(function()
	 {  	
		loadComment({rate_data});
		function loadData(products_id){              
				$.ajax
				({
					type: "GET",
					url: "{linkS}home/modules/ajax/chartRating.php",
					data: "products_id="+products_id,
					success: function(msg)
					{		           
						$('#chartRating').html(msg);		           
					}
				});
			}	 
		 $(".rating").click(function(){  
			 $("ul.tabs li").removeClass("active");
			 $("#cTab2").addClass("active");
			 $("#tab1").hide(); 
			 $("#tab2").show(); 
			});
		 
		 $("a#show-panel").click(function(){  
			loadData({rate_data});
			$("#lightbox, #lightbox-panel").fadeIn(300);  
		});
		 $("a#close-panel").click(function(){ 
			$("#lightbox, #lightbox-panel").fadeOut(300);  
		 });
		 
		  $("input[name='type']").change(function(){
				var values = $("input[name='type']:checked").val();
				var subvalues = values.split('::');
				var arrPrice = subvalues[1];
				var price = arrPrice.replace('.','');
				$('.show_price').text(arrPrice);			
				var product_name = $('#product_name_hidden').text();
				var product_quantity = $('#product_quantity_hidden').text();
				var total_amount = $('#total_amount_hidden').text();
				var linkNganluong = 'https://www.nganluong.vn/button_payment.php?receiver=support@asiasilk.info.vn&product_name='+product_name+'&price='+price+'&return_url=http://asiasilk.info.vn';
				var linkBaokim = 'https://www.baokim.vn/payment/customize_payment/product?business=support@asiasilk.info.vn&product_name='+product_name+'&product_price='+price+'&product_quantity='+product_quantity+'&total_amount='+price;	  		
				$('a.nganluong').attr('href',linkNganluong);
				$('a.baokim').attr('href',linkBaokim);
		  });		 
	})  
	function addToMyFavorite()
	{
		if ($("#type").index() != -1) 
		{
			var product_type = $("input[name='type']:checked").val();
			var subvalues = product_type.split('::');
			product_type =subvalues[0];
		}
		else
		{
			var product_type = '';
		}
		var product_color = $("input[name='color']:checked").val();
		var product_price = $('.show_price').text();
		var product_quantity =  $('#quantity').val();
	    $.ajax
	    ({
	        type: "POST",
	        url: "{linkS}home/modules/ajax/addMyFavorite.php",
	        data: {
			   "email" : "{email}",
			   "product_name" : "{product_name}",
			   "product_key" : "{product_key}",
			   "product_type" : product_type,
			   "product_color" : product_color,
			   "product_price" : product_price,
    		   "product_quantity" : product_quantity,
		      },
	        success: function(msg)
	        {
	            alert(msg);
	        }
	    });
	}
	function addVoteForProduct()
	{		    
		var value = $('#jqxRating').jqxRating('value');
		
		$.ajax
	    ({
	        type: "POST",
	        url: "{linkS}home/modules/ajax/VoteForCustomer.php",
	        data: {
				"id_product" : "{id_product}",
				"rate" : value,
				"user_name" : "{user_name}",			  
		      },
	        success: function(msg)
	        {
	            alert(msg);
	        }			
	    });
	}
	function loadComment(products_id){              
    $.ajax
    ({
        type: "GET",
        url: "{linkS}home/modules/ajax/loadComment.php",
        data: "id_product="+products_id,
        success: function(msg)
        {           
        	$('#show_comment').html(msg);           
        }
    });
}
</script>  
                
