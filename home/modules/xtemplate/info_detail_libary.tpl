<style>
	#sharefacebook_icon a img
	{
		opacity:0.6;
		border:#2A1FAA;		
		border-radius: 9px;
	}
	#sharefacebook_icon a:hover img
	{
		-moz-box-shadow: inset 0 0 2px #B0ACFB;
		-webkit-box-shadow: inset 0 0 2px #B0ACFB;
		box-shadow: inner 0 0 2px #B0ACFB;
		border-radius: 9px;
		opacity:1;
	}	
	#ShareButton
	{
		-moz-box-shadow: 0 0 2px #B0ACFB;
		-webkit-box-shadow: 0 0 2px#B0ACFB;
		box-shadow: 0 0 3px #B0ACFB;
		padding-bottom:10px;		
		border-radius: 9px 9px 0px 0px;
		background-color:#FFFBF0;		
	}
	#stretch
	{
		-moz-box-shadow: 0 0 5px #B0ACFB;
		-webkit-box-shadow: 0 0 5px#B0ACFB;
		box-shadow: 0 0 3px #B0ACFB;
		border-radius: 0px 0px 9px 9px;
		background-color:#FFFBF0;
		padding-bottom: 10px;		
	}
	#line
	{
		height:1px;
		margin-left: 100px;
		margin-right: 100px;		
		color:#CCF;		
		-moz-box-shadow: 0 0 2px #B0ACFB;
		-webkit-box-shadow: 0 0 2px#B0ACFB;
		box-shadow: 0 0 2px #B0ACFB;		
		margin-bottom: 10px;
	}			
</style>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<div id="fb-root">
</div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>                	                                        
	<div id="product">
    	<div id="breakcrumb" style="font-family: Cambria; 
        							font-size:14px; 
                                    margin-top:20px;
                                     margin-bottom:20px">{breadcrumbs_path}</div>                         	
        <br/><br/>
    	<div class="news_main_libary">
      		<div id = "ShareButton">
            	<h2 class="contentheading" style="padding-top:25px; margin-left:25px">                        
					<a href="#" class="contentpagetitle">                        
						{news_name}	
                    </a>	
              	</h2>														
				<div class="article-toolswrap" style="margin-bottom:10px">
                	<div style="margin-top:10px; margin-left:25px; color:#7F0000; font-size:13px">
                    	<b>Đăng bởi : <a style="color:#7F1F00;"><i>{translator}</i></a> - {date_added}</b>
                   	</div>
				</div>                                                                                
           		<span id = "sharefacebook_icon" style = "margin-left: 24px;width:45px;height:45px; margin-right:0px">                                
            		<a target="_blank" 
                       href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]={linkSf}{news_key}&amp;p[images][0]= {linkSf}layout/images/logo/banner01.jpg&amp;p[title]={news_name}+&amp;p[summary]={news_shortcontent}">
                    	<img src="{linkS}layout/images/facebook-icon.png" title="Chia sẻ Facebook" width="50px" height="50px"/>
                    </a>
           		</span>		                           
          		<span id = "sharefacebook_icon" style = "width:45px;height:45px">
                	<a href="https://twitter.com/intent/tweet?text={news_name_twitter}&url={linkSf}{news_key}&related=episod">
                    	<img src="{linkS}layout/images/twitter-icon.png" title="Chia sẻ Tweet" width="50px" height="50px"/>
                    </a>
				</span>		                            
                <span id = "sharefacebook_icon" >
                	<a href="https://plus.google.com/share?url={linkSf}{news_key}"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');;return false;">
						<img src="{linkS}layout/images/google-plus-icon.png" width="50px" 
                        													 height="50px" 
                                                                             title="Chia sẻ Google+"/>
					</a>
          		</span>	                            
              	<span id = "sharefacebook_icon">
               		<a href="http://www.linkedin.com/shareArticle?mini=true&url={linkSf}{news_key}&title={news_name}&summary={news_shortcontent}&source=nanapet.com" 
                  	   rel="nofollow" onclick="NewWindow(this.href,'template_window','550','400','yes','center');return false" 
                       onfocus="this.blur()"> 
                    	<img src="{linkS}layout/images/linkedIn-icon.png" title="Chia sẻ LinkedIn" width="50" height="50"/> 
                    </a>
               	</span>        
                <h1 style="margin-left:25px; color:#B3B3FF; margin-bottom:-5px; font-size:15px; text-decoration:underline">{author}</h1>
			</div>                                         
			<div class="article-content" style="margin-right:25px;margin-left:25px">
            	<p>
                	<span style="font-size:50px; text-align:justify;">							
						{news_content}
                    </span>
				</p>
				<p>
                	<span style="font-size: small;"> </span>
                </p>							
				<p>
                	<span style="font-size: small;"></span>
                </p>
         	</div>                            
            <div style="margin-left:25px; margin-bottom:20px; margin-top: -7px">                             
            	<A href="#section0" style="text-decoration:underline; 
                						   font-family:Arial, Helvetica, sans-serif; 
                                           font-size:13px; 
                                           margin-top:10px">
                	<b>Về đầu trang</b>
                </A></br>
        	</div>                            
			<div id = "stretch">
            	<div style="margin-left:25px; 
                			margin-bottom:0px; 
                            padding-top:10px;
                            color:#7F1F00; font-size:14px; 
                            font-family:Cambira">
               		<table style="text-align:left;margin-left:-10px; padding-bottom:10px">                                    	
                     	<tr>
                        	<td>
                            	<img src="{linkS}layout/images/info.png" 
                                	 width="50px" height="50px" title="Thông tin bài viết" style="opacity:0.8;"/>
                          	</td>
                         	<td>
                           		<b> Nguồn </b>
                          	</td>
                       		<td>
                           		<b>: </b>
                        	</td>
                          	<td style = "font-size:14px; color:#B3B3FF">	                        	
                            	{linkResource} 
                          	</td>
               			</tr>                                                             	
        			</table>
       			</div>
          		<div id = "line"> </div>
                <div>
                  	<table style="text-align:left;margin-left:-5px; margin-top:-5px">
                        <tr>
                            <td>
                                <img src="{linkS}layout/images/talk-together.png" 
                                     style="width:37px; 
                                            height:40px; 
                                            margin-left:25px; 
                                            margin-bottom:10px; opacity:0.8" 
                                            title="Thảo luận bài viết"/>
                            </td>
                            <td>
                                <b style="color:#7F1F00; font-size:14px; font-family:Cambira"> 
                                	&nbsp; Thảo luận bài viết
                                </b>
                            </td>	                                        
                        </tr>
                 	</table>
             	</div>                               
                <h4>
                    <div class="fb-comments" style = "margin-left:25px" 
                                                      data-href="{linkSf}{news_key}" 
                                                      data-numposts="5" 
                                                      data-width ="675px"></div>
                <h4>                                  
  			</div>                                                                                                     	                    	
      	</div><!-- end product_main -->                    
        <div class="clear"></div>
 	</div><!-- end product -->