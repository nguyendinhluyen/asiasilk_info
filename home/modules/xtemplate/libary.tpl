<head>    
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.bootstrap.css" type="text/css"/>
    <script type="text/javascript" src="{linkS}layout/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxcombobox.js"></script>
</head>
<style type="text/css">
	.contentheading a:hover 
	{
		text-decoration:underline;
	}
	.linkDetail a:hover 
	{
		text-decoration:underline;
	}
</style>
<script type="text/javascript">
	$val = 0;
	$(document).ready(function (){
		$link = location.href;
		var str = $link;
		if( str.search("thu-vien/choose-all.html") > 0)
		{
			$val = 1;
		}						
		else if( str.search("thu-vien/choose-dog.html") > 0)
		{
			$val = 2;
		}		
		else if( str.search("thu-vien/choose-cat.html") > 0)
		{
			$val = 3;
		}			
       	var source = [
						"Lọc bài viết...",
						"Tất cả",
						"Chó",
						"Mèo",
				        ];
       	// Create a jqxComboBox
      	$("#jqxComboBox").jqxComboBox({ source: source, 
										selectedIndex: $val, 
										width: '110px',
										height: '25px', 
										theme: 'bootstrap' });            							
		$("#jqxComboBox").jqxComboBox({autoDropDownHeight: true}); 									
		$('#jqxComboBox').on('select', function (event) 
		{
				var args = event.args;
				if (args) 
				{
					// index represents the item's index.                       
					var index = args.index;
					var item = args.item;
					// get item's label and value.
					var label = item.label;
					var value = item.value;					
					if(value == 'Chó')
					{
						window.location='{linkS}thu-vien/choose-dog.html';
					}
					else if(value == 'Mèo')
					{
						window.location='{linkS}thu-vien/choose-cat.html';						
					}
					else if (value == 'Tất cả')
					{
						window.location='{linkS}thu-vien/choose-all.html';						
					}																							
				}
		}); 
	});
</script>
	<div id="product">
    	<div id="breakcrumb" style="margin-top:20px; font-size:14px; font-family:Cambria; margin-bottom:20px">{breadcrumbs_path} 
			<!--<span style="float:right">
          		<div id='jqxComboBox'>
                </div>                            
         	</span>-->                                                                                              
      	</div>                 
      	<br/><br/>
     	<div class="news_main" >                                                       
     	<!--BEGINLIST_PROMOTION-->
		<!--BEGIN_PROMOTION-->			                
		<div class="contentpaneopen">
			<h2 class="contentheading" style="padding-bottom:10px">
				<a href="{linkS}thu-vien/{news_key}/" 
                style="color:#00F; font-size: 18px; margin-left:3px; font-family:Cambria;">{news_name}</a>
			</h2>					
			<div class="article-toolswrap" >
				<div class="article-tools clearfix">
					<div class="article-meta" style="margin-left:3px;">
                    	<span class="createby" style="color:#7F0000; font-size:15px; font-family:Cambria;">
							<b>{person_up}</b>	
                        </span>
					</div>
				</div>
			</div>					
			<div class="article-content" style="-moz-border-radius: 5px;
            									 border-radius: 5px;
                                                 -moz-box-shadow: 5px 5px 5px black;
                                                 -webkit-box-shadow: 5px 5px 5px black; 
                                                 box-shadow: 3px 3px 3px #CECED0;">
         		<table>
                	<tr>
                    	<td style="padding-right:10px">
                        	<h4>
                                <a href="{linkS}thu-vien/{news_key}/" class="preview">
                                    <img src="{linkS}upload/news/{news_image}" width="160" 
                                                                               height="160" 
                                                                               style="margin-left:3px"/>
                                </a>
                            </h4>                        
                        </td>
                        <td style="width:490px;">
                        	<h3 style="text-align:justify; font-family:Cambria;font-size:15px; font-weight:lighter">
                                <p>
                                	<span>
                                    	{news_short}                        			        
                                    </span>                        
                                </p>
                            </h3>
                                <p></p>                       
                      	</td>                                  
                        <td>                           
                        </td>
               		</tr>                                          
                    <tr>
                   		<td>
                        </td>                         
                        <td class = "linkDetail" style="text-align:right">
                       		<a href="{linkS}thu-vien/{news_key}/" class="readon" style="color:#2A00AA; 
                            															font-family:Cambria; 
                                                                                        font-size:14px">
                           		<b>Xem chi tiết </b>
                           	</a> 
                            <span style="color:#2A00AA"> >>> </span>
                      	</td>
                        <td style="padding-left:15px">                              
                        	<table style="width:50px; height:65px">
                            	<tr>
                                	<td style="font-size:30px; 
                                    		   color:#2A3F55; 
                                               padding-top:10px; 
                                               text-align:center; 
                                               font-family:agency fb">
                                    	<b>{date}</b>
                                   	</td>                                    
                          		</tr>                                                                        
                                <tr style="background:#808080; ">
                                	<td style="font-size:17px; 
                                    		   color:#FFF; 
                                               text-align:center; 
                                               font-family:agency fb">
                                   		<div style="margin-top:-2px;"><b>{month} | {year}</b></div>
                                   	</td>
                               	</tr>
                          	</table>                                
                 		</td>
             		</tr>
               	</table>                   					
			</div>
           	<span class="article_separator" style="color:#00F">&nbsp;</span>
		</div>
		<p> </p>
	<!--END_PROMOTION-->
	<!--ENDLIST_PROMOTION-->
	</div><!-- end product_main -->
        <div class="pagination" style="color:#2A1FAA; font-size:13px">
            <b>{page}</b>     
        </div>     
   	</div><!-- end product -->