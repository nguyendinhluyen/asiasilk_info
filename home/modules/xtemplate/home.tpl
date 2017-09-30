<link rel="stylesheet" type="text/css" href="{linkS}layout/css/jquery-scroller-v1.css" />
<script type="text/javascript" src="{linkS}layout/js/jquery-scroller-v1.min.js"></script>
    <style>
        .brand_logo_scroller img
        {
            border:1px solid #ccc;
            height: 80px;
            width: 100px;
        }
    </style>
	<!--<table style="margin-top:20px; 
    			font-family:Cambria; 
                font-size:17px;                
                clear:both; 
                color:#A00; 
                font-weight:bold; 
                width:730px;
                margin-left:10px;
                background:url({linkS}/layout/images/background_vip_customer.png); 
                box-shadow: 3px 3px 5px #DBDBDB;">
    	<tr>
        	<td style="width:30px"> 
            <span>
                	<img src="{linkS}layout/images/vip_customer.gif" width="30px" height="30px"/>
                </span>
            </td>
            
            <td>
             	<span>
					ĐỐI TÁC VÀNG
                </span>
            </td>
        </tr>        
    </table>

  
    <div id="brand_logo" style="margin-left:10px">
        <div class="brand_logo_scroller">
            <div class="scrollingtext">
                {list_advs}                  
            </div>
        </div>                       
    </div><!-- end brand_logo -->
    
	<div id="product" style="margin-top:20px">                
    	<div id="new_arrivals"> <!--<a href="{linkS}san-pham-moi">Xem tất cả</a>-->
        	<span style="float: left; margin-left:10px; margin-right:10px; margin-top:2px"> <img src="{linkS}layout/images/vip_customer.gif" width="25px" height="25px"/></span>
                	<span style="float: left ; font-size:20px; color:#A00">Sản phẩm mới nhất</span>
		</div>                    
        	<div class="product_main_home">                                        	
            	<!--BEGINLIST_PRODUCTSNEW-->
   				<!--BEGIN_PRODUCTNEW-->
                <li>
                	<div class="product_detail">                                
                    	                                                                       
         				<div class="product_right_col">
                     		<!--{promotion_Sale}-->                            
                                <a href="{linkS}{category}/{product_key}.htm" class="preview_chinhsua">
                                    <img class="img" src="{linkS}upload/product/thumb/{product_img}" width="200" 
                                                                                         height="270" 
                                                                                         alt="{product_name}"/>
                                </a>                            
                		</div><!-- end product_right_col -->                                    
                        
                        <div class="product_left_col">                                    		
                        	<div class="product_tit">
                           		<h3 style=" font-family:Cambria; font-size:14px; text-align:center; width:212px; margin-left:-52px">
                                	<a href="{linkS}{category}/{product_key}.htm">{product_name}</a>
                                </h3>
                         	</div>
                         	<!--<div class="product_price">{product_price} VNĐ</div>
                         	<div class="product_price_en">{price_not_discount_product}</div>-->
                   		</div><!-- end product_left_col --> 
            		</div><!-- end product_detail -->
          		</li>  	
                <!--END_PRODUCTNEW-->
    			<!--ENDLIST_PRODUCTSNEW-->                                                                  
			</div><!-- end product_main -->                    

           	<!--<div id="best_selling"> <a href="{linkS}top-sell-in-week">Xem tất cả</a></div>                    
             	<div id="bestsell" style="height:270px">	
					<div class="bestsell_scroller" style="height:270px">
						<div class="scrollingtext">
			            BEGINLIST_PRODUCTS_SELL
			            BEGIN_PRODUCT_SELL			                   
                       		<div class="best_product">
			                	<div class="best_tit">
                                	<a href="{linkS}{category_sell}/{product_key_sell}.htm">{product_name_sell}</a>
                                </div>                                        			                            
                				<div class="best_img" >
	                            	{promotion_Best_Sale}
                                	<a href="{linkS}{category_sell}/{product_key_sell}.htm" class="preview1" >    
                                    <img src="{linkS}upload/product/thumb/{product_img_sell}" alt="{product_name_sell}"/></a>		                            
                             	</div>
			                    <div {margin_best_img}>
                              		<span class="best_price"><b>{product_price_sell} VNĐ </b></span>
                                    <div class="product_price_en"><b>{price_not_discount_price_sell}</b></div>                                
                                	<div>
                                	</div>
                                	</div>			                           
			                   		<div class="add_to_cart">
                                    <a href="{linkS}{category_sell}/{product_key_sell}.htm">
                                    <img src="{linkS}layout/images/addtocart.png" /></a></div>
			     			</div> end best_product 			                       
			          	END_PRODUCT_SELL
			       		ENDLIST_PRODUCTS_SELL 			                     			                   
						</div>
					</div>
             	</div>-->
                <!-- end product_main -->                
               
                <div id="promotion_in_week">
                	<span style="margin-left: -10px; float:left; margin-right:10px"> 
                    	<img src="{linkS}layout/images/vip_customer.gif" width="25px" height="25px"/></span>
                	<span>Sản phẩm bán chạy</span>
                    <!--<a href="{linkS}khuyen-mai-trong-tuan">Xem tất cả</a>--></div>                    
					<div class="product_main_home" id = "promotion_in">    	
	                   	<!--BEGINLIST_PRODUCTS_BEST-->
	                   	<!--BEGIN_PRODUCT_BEST-->
	                   	<li>
                        	<div class="product_detail">
							
                                <div class="product_right_col">
                                    <!--{promotionsale_week}-->                            	
                                        <a href="{linkS}{category_best}/{product_key_best}.htm">
                                            <img src="{linkS}upload/product/thumb/{product_img_best}" width="200" 
                                                                                                      height="270"
                                                                                                      alt="{product_name_best}"/>
                                        </a>                                
                                </div><!-- end product_right_col -->
    
                                <div class="product_left_col">
                                    <h3 style="font-size:14px; font-family:Cambria; text-align:center">
                                        <div class="product_tit" style="width:212px; margin-left:-52px">
                                            <a href="{linkS}{category_best}/{product_key_best}.htm">{product_name_best}</a>
                                        </div>                                       
                                    </h3>
                                    <!--<div class="product_price">{product_price_best} vnđ</div>
                                    <div class="product_price_en">{product_price_best_old}</div>-->
                                </div><!-- end product_left_col -->
                        	</div><!-- end best_product -->
                        </li>
             	<!--END_PRODUCT_BEST-->
                <!--ENDLIST_PRODUCTS_BEST--> 
         		</div><!-- end product_main -->                    
           	</div><!-- end product -->
                
<script>
$(document).ready(function() {
	//create scroller for each element with "horizontal_scroller" class...
	$('.brand_logo_scroller').SetScroller({	velocity: 	50,
											direction: 	 'horizontal',
											startfrom: 	 'right',
											loop:		 'infinite',
											movetype: 	 'linear',
											onmouseover: 'pause',
											onmouseout:  'play',
											onstartup: 	 'play',
											cursor: 	 'pointer'
										});
											
	//create scroller for each element with "horizontal_scroller" class...
	$('.bestsell_scroller').SetScroller({	velocity: 	 55,
											direction: 	 'horizontal',
											startfrom: 	 'right',
											loop:		 'infinite',
											movetype: 	 'linear',
											onmouseover: 'pause',
											onmouseout:  'play',
											onstartup: 	 'play',
											cursor: 	 'pointer'
										});		
	//how to overwrite options after setup and without deleting the other settings...
	$('#no_mouse_events').ResetScroller({	onmouseover: 'play', onmouseout: 'play'   });
	$('#scrollercontrol').ResetScroller({	velocity: 50, startfrom: 'left'   });

	//if you need to remove the scrolling animation, uncomment the following line...
	//how to play or stop scrolling animation outside the scroller... 
	$('#play_scrollercontrol').mouseover(function(){   $('#scrollercontrol').PlayScroller();   });
	$('#stop_scrollercontrol').mouseover(function(){   $('#scrollercontrol').PauseScroller();  });		
	//create a vertical scroller...	
	$('.vertical_scroller').SetScroller({	velocity: 55, direction: 'vertical'  });			
	// then I reset new options; besides, "$('#soccer_ball_container')" will wraps and scrolls the bouncing animation...
	$('#soccer_ball_container').ResetScroller({	 velocity: 50, movetype: 'pingpong', onmouseover: 'play', onmouseout: 'play'});
	//create soccer ball bouncing animation...
	$('#soccer_ball').bind('bouncer', function(){
			$(this).animate({top:42}, 800, 'linear').animate({top:5}, 800, 'linear', function(){$('#soccer_ball').trigger('bouncer');});			
	}).trigger('bouncer');				

});

</script>