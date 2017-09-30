<!--BEGIN_SCRIPT-->
<script type="text/javascript">
	$(function(){
		$(".tab_content").hide(); 
		$("ul.tabs li:nth-child(2)").addClass("active").show(); 
		$(".tab_content:nth-child(2)").show(); 
		
		$("ul.tabs li").click(function() {
	
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
	
			var activeTab = $(this).find("a").attr("href"); 
			$(activeTab).fadeIn(); 
			return false;
		});
	
	});
</script>
<!--END_SCRIPT-->
<div id="product">
    <div id="breakcrumb" style="margin-top:20px; font-family:Cambria; font-size:14px">{breadcrumbs_path}</div> 
    
    <div class="col1_content">
        <div class="clear"></div> 
        <div id="detail3">
            <ul class="tabs">
                <li><a href="#tab1" style="font-family:Cambria; font-size:14px; color:#A00">Sản phẩm</a></li>
                <!--<li><a href="#tab2">Tin tức</a></li>
                <li><a href="#tab3">Giải trí</a></li>-->               
            </ul>
            
            <div id="tab_container">
                <div id="tab1" class="tab_content">
                    <div class="product_main"  style="margin-left:-50px">
                        <!--BEGINLIST_PRODUCTS-->
                        <!--BEGIN_PRODUCT-->
                        <li>
                            <div class="product_detail">
                                <div class="product_col">
                                    <div class="product_tit">
                                        <a href="{linkS}{category}/{product_key}.htm">{product_name}</a>
                                    </div>
                                    <a href="{linkS}{category}/{product_key}.htm" class="preview"><img
                                        src="{linkS}upload/product/thumb/{product_img}" width="100"
                                        height="100" alt="{product_name}" /></a>
                                    <div class="product_price">{product_price} </div>
                                    <div class="product_price_en">{product_price_old}</div>
                                    <div class="">
                                        <a href="{linkS}{category}/{product_key}.htm">[Xem chi tiết]</a>
                                    </div>
                                </div>
                
                            </div> <!-- end product_detail -->
                        </li>
                        <!--END_PRODUCT-->
                        <!--ENDLIST_PRODUCTS-->
                    </div>
                    <!-- end product_main -->
                    <div class="clear"></div>
                    <!-- BEGIN PAGE NAVIGATION -->
                    <div align="center">
                        <div class="pagination"  style="font-size: 14px">{product_page}</div>
                    <!-- END PAGE NAVIGATION -->
                    </div>
                    <!-- end product -->
                </div>
                
                <div id="tab2" class="tab_content">
                  <div class="product_main">
                    <!--BEGINLIST_NEWS-->
                    <!--BEGIN_NEWS-->
                    <li>
                        <div class="product_detail">
                            <div class="product_col">
                                <div class="product_tit">
                                    <a href="{linkS}thu-gian/{news_key}/">{news_name}</a>
                                </div>
                                <a href="{linkS}thu-gian/{news_key}/" class="preview"><img
                                    src="{linkS}upload/news/thumb/{news_img}" width="100"
                                    height="100" alt="{news_name}"/></a>
                                <div class="">
                                    <a href="{linkS}thu-gian/{news_key}/">[Xem chi tiết]</a>
                                </div>
                            </div>
            
                        </div> <!-- end product_detail -->
                    </li>
                    <!--END_NEWS-->
                    <!--ENDLIST_NEWS-->
                  </div>
                  <!-- end news_main -->
                  <div class="clear"></div>
                  <!-- BEGIN PAGE NAVIGATION -->
                  <div align="center">
                      <div class="pagination">{news_page}</div>
                  <!-- END PAGE NAVIGATION -->
                  </div>
                  <!-- end news -->                
                </div>
                
                <div id="tab3" class="tab_content">
                    <div class="product_main">
                        <!--BEGINLIST_ENTERTAINMENT-->
                        <!--BEGIN_ENTERTAINMENT-->
                        <li>
                            <div class="product_detail">
                                <div class="product_col">
                                    <div class="product_tit">
                                        <a href="{linkS}thu-gian/{news_key}/">{news_name}</a>
                                    </div>
                                    <a href="{linkS}thu-gian/{news_key}/" class="preview"><img
                                        src="{linkS}upload/news/thumb/{news_img}" width="100"
                                        height="100" alt="{news_name}" /></a>
                                    <div class="">
                                        <a href="{linkS}thu-gian/{news_key}/">[Xem chi tiết]</a>
                                    </div>
                                </div>
                
                            </div> <!-- end product_detail -->
                        </li>
                        <!--END_ENTERTAINMENT-->
                        <!--ENDLIST_ENTERTAINMENT-->
                    </div>
                    <!-- end news_main -->
                    <div class="clear"></div>
                    <!-- BEGIN PAGE NAVIGATION -->
                    <div align="center">
                        <div class="pagination">{entertainment_page}</div>
                    <!-- END PAGE NAVIGATION -->
                    </div>
                    <!-- end entertainment -->
                </div>
                
                
            </div><!-- end tab_container -->
            
        </div><!-- end detail3 -->
       
    </div><!-- end col1_content -->
       
</div><!-- end product -->
