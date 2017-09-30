<head>
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="{linkS}layout/jqwidgets/styles/jqx.bootstrap.css" type="text/css" />    
    <script type="text/javascript" src="{linkS}layout/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="{linkS}layout/jqwidgets/jqxcombobox.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function () {															
		var order_by = document.getElementById("session_order_by");								
		$val = parseInt(order_by.innerHTML);			
		if($val == 1)		
		{
			$val = 1;
		}		
		else if($val == 2)		
		{
			$val = 2;
		}
		else if($val == 3)		
		{
			$val = 3;
		}		
		else if($val == 4)		
		{
			$val = 4;
		}		
		else if($val == 5)		
		{
			$val = 5;
		}
		else
		{
			$val = 0;
		}							
       	var source = [
						"Chọn sắp xếp",
						"Tên sản phẩm tăng",
						"Tên sản phẩm giảm",
						"Giá gốc tăng dần",
						"Giá gốc giảm dần",
						"Sản phẩm mới nhất",
				        ];								       	
		// Create a jqxComboBox		
      	$("#order_by").jqxComboBox({source: source, 
									selectedIndex: $val, 
									width: '140px', 
									height: '25px', 
									theme: 'bootstrap'});            							
		$("#order_by").jqxComboBox({autoDropDownHeight: true}); 									
		$('#order_by').on('select', function (event) 
		{
			var args = event.args;				
			if (args) 
			{
				var value = $("#order_by").val();										
				if(value == 'Chọn sắp xếp')
				{						
					return;						
				}
				else if(value == 'Tên sản phẩm tăng')
				{
					value = 1;
				}										
				else if(value == 'Tên sản phẩm giảm')
				{
					value = 2;
				}					
				else if(value == 'Giá gốc tăng dần')
				{
					value = 3;
				}
				else if(value == 'Giá gốc giảm dần')
				{
					value = 4;
				}					
				else if(value == 'Sản phẩm mới nhất')
				{
					value = 5;
				}					
				else
				{
					value = 0;
				}					
				window.location='{url1}' + value;																										
			}												
		}); 		
		var pp_num = document.getElementById("pp_num");								
		$val_2 = parseInt(pp_num.innerHTML);																				
		if($val_2 == 3)
		{
			$val_2 = 1;			
		}		
		else if($val_2 == 6)
		{
			$val_2 = 2;			
		}		
		else if($val_2 == 12)
		{
			$val_2 = 3;			
		}		
		else if($val_2 == 18)
		{
			$val_2 = 4;			
		}		
		else if($val_2 == 24)
		{
			$val_2 = 5;			
		}		
		else if($val_2 == 30)
		{
			$val_2 = 6;			
		}		
		else if($val_2 == 36)
		{		
			$val_2 = 7;			
		}
		else		
		{
			$val_2 = 0;			
		}		
		var source_2 = [
						"Hiển thị",
						"3",
						"6",
						"12",
						"18",
						"24",
						"30",
						"36",
				        ];
		$("#num").jqxComboBox({ source: source_2, 
								selectedIndex: $val_2, 
								width: '75px', 
								height: '25px', 
								theme: 'bootstrap'});            							
		$("#num").jqxComboBox({autoDropDownHeight: true}); 				
		$('#num').on('select', function (event) 
		{
			var args = event.args;				
			if (args) 
			{
				var value = $("#num").val();																				
				if(value == "Hiển thị")
				{
					return;
				}
				else if(value == '3')
				{
					value = 3;
				}
				else if(value == '6')
				{
					value = 6;
				}										
				else if(value == '12')
				{
					value = 12;
				}					
				else if(value == '18')
				{
					value = 18;
				}
				else if(value == '24')
				{
					value = 24;
				}					
				else if(value == '30')
				{
					value = 30;
				}					
				else if(value == '36')
				{
					value = 36;
				}
				else
				{
					value = 36;
				}					
				window.location='{url}' + value;																										
			}												
		}); 		
	});
	</script>
    	<div id="product">                	
        	<div id="breakcrumb" style="border-bottom:none; 
            							font-size:14px; 
                                        font-family:Cambria;
                                        margin-top:20px">{breadcrumbs_path}         				
	       </div>
            
            <div style="float: right;">					
            	<p style="display:none"id ="session_order_by"> {order_by}</p>                        
                <p style="display:none"id ="pp_num"> {quannum}</p>                        
	            <span {style_span}>
                	<table style="margin-right:0px; margin-bottom:20px">
                    	<tr>
                        	<td id='order_by' style="margin-right: 150px"/>                    
                         	<td style="width:10px"/>                    
                           	<td id='num'/>
                    	</tr>
             		</table>
                </span>                                                 	                	                        
     		</div>
            <div class="product_main">                    
            <!--BEGINLIST_PRODUCTS-->                    	
 			<!--BEGIN_PRODUCT-->
           		<li style="width:230px">
          			<div class="product_detail">                                                                
                   		<div class="product_col">
                      		<table border="1" style="width:220px; border-color:#A00">
                          		<tr height="50px;">
                           			<td valign="bottom">
                                        <h3 style="font-weight:lighter; font-size:12px; height: 30px;">
                                            <div class="product_tit">
                                                <a href="{linkS}{category}/{product_key}.htm" style="font-family:Cambira; font-size:15px; height:40px;">{product_name}</a>
                                            </div>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                	<td style="margin-right:20px">                                    			
                              			<!--{promotion_Sale}-->                                 				                                   		
                                        <h4>
                                            <a href="{linkS}{category}/{product_key}.htm" class="previews">                                        	
                                                <img src="{linkS}upload/product/thumb/{product_img}" width="200" 
                                                                                                     height="270" 
                                                                                                     alt="{product_name_nocut}" style=" text-align:center"/>                                           
                                            </a>			                                    	
                                        </h4>
			                            <div class="product_price" style="font-family:Cambria; font-size:15px">{product_price} VNĐ</div>
			                            <div class="product_price_en" style="font-family:Cambria; font-size:15px; margin-bottom:10px; height:15px">{product_price_old}</div>
			                            <div class=""><a href="{linkS}{category}/{product_key}.htm" style="font-family:Cambria; font-size:13px">[Xem chi tiết]</a></div>
                                   	</td>
                             	</tr>
                   			</table>
            			</div><!-- end product_col -->                                    
            		</div><!-- end product_detail -->
    			 </li>  	
   			<!--END_PRODUCT-->                       
           	<!--ENDLIST_PRODUCTS-->
    		</div><!-- end product_main -->                   
            	<div class="clear"></div>
                	<div class=" line_end" style="margin-top:10px;"></div>
                   	<!-- BEGIN PAGE NAVIGATION -->
					<div align="center">
						<div class="pagination" align="center" style="margin-left: au;
                        											  margin-right: auto; 
                                                                      font-size:14px; 
                                                                      font-family:Cambria">
							{page}
						
						</div>
					</div>										                    
                </div><!-- end product -->                                      
