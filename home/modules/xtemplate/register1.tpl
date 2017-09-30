	<link rel="stylesheet" type="text/css" href="{linkS}layout/css/template.css" />
	<link rel="stylesheet" type="text/css" href="{linkS}layout/css/jquery-ui-1.8.16.custom.css"/>        
	<script type="text/javascript" src="{linkS}layout/js/jquery-ui-1.8.16.custom.min.js"></script>
	<meta charset="utf-8"/>
  	<title>Dang ky thanh vien</title>
  	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>       
   
    	<script>
			$(function() 
			{
				$("#birth_day_filed" ).datepicker({dateFormat: 'dd-mm-yy', 
												   changeMonth:true, 
												   changeYear: true});											
			});																					
		</script>
           
		<script language="javascript" type="text/javascript">
            function submitregistration() {
                var form = document.adminForm;
                var r = new RegExp("[\<|\>|\"|'|\%|\;|\(|\)|\&|\+|\-]", "i");
                var isvalid = true;
                var required_fields = new Array('middle_name','phone_2','address_1','agreed');
            	var e = document.getElementById("cach_danh_xung");
				var strUser = e.options[e.selectedIndex].value;

				if (strUser =='Choose') 
				{ 
                	alert( 'Vui lòng nhập danh xưng');
    				return false;
                } 

				//Ho va ten		
                if (form.middle_name.value =='') 
				{ 
                	alert( 'Vui lòng nhập họ & tên đệm người sử dụng.');
    				return false;
                } 
				
				//Ten 
				if (form.name.value =='') 
				{ 
                	alert( 'Vui lòng nhập tên người sử dụng.');
    				return false;
                }
				
				//Email
				if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.email.value))) 
				{
					alert( 'Vui lòng nhập đúng địa chỉ thư điện tử.');
					return false;
				}
				
				//Dien thoai di dong
				if (form.phone_2_field.value=='') 
				{ 
					alert( 'Vui lòng nhập đúng điện thoại.');
					return false;
             	}
				
				//Password            
                passregex=/^\S[\S ]{2,98}\S$/;
                if (form.password.value.length < 6 ) 
				{
                    alert( "Vui lòng nhập đúng mật khẩu. Không khoảng trắng, 6 ký tự trở lên và sử dụng 0-9,a-z,A-Z" );
					return false;
                } 
				
				else if (form.password2.value == "") 
				{
                    alert( "Vui lòng kiểm tra lại mật khẩu." );
                    return false;
                } 
				
				else if (!passregex.test(form.password.value)) 
				{
                    alert( "Vui lòng nhập đúng Mật khẩu. Không khoảng trắng, có hơn 6 ký tự và là các ký tự 0-9,a-z,A-Z" );
                    return false;
                }
				
                if ((form.password.value != "") && (form.password.value != form.password2.value))
				{
                    alert( "Mật khẩu không đúng, hãy thử lại." );
                    return false;
                }           						            						
			
				if(form.check_agree.checked == false)
				{
					alert( "Chưa check vào check box. Hãy click" );
					return false;
				}
				
				if( !isvalid) 
				{
					alert("Hãy chắc là đã hoàn thành mẫu và chính xác." );
				}
				
				
				return isvalid;
				}	            
		    
            </script>
                <body>
                <div id="product">
                	<div id="breakcrumb" style="font-family:Cambria; font-size:14px; margin-top:20px">{breadcrumbs_path}</div>                     
                    <div class="news_main">	
				<div class="ndchitiet_left">                               
                
				<h2 class="title_register" style="font-family:Cambria">ĐĂNG KÝ TÀI KHOẢN</h2>
					<!--START_form_register-->

					<form action="{linkS}process-register" method="POST" name="adminForm" enctype="multipart/form-data">
                    <div class="main_register" >
	
                       
                         
                    	<fieldset class="fieldset_reg_info" style="font-family:Cambria; font-size:15px; margin-top:10px"><legend>Thông tin cá nhân</legend>
                            
                            <table border="0px" width="100%" class="user-forms">
                                <tr>
                                	<td width="260px">
                                    	<div class="font11" style="font-family:Cambria; 
                                        						   font-size:14px; 
                                                                   margin-bottom:5px">
                                       		Danh xưng (Anh / Chị) 
                                        <span class="red">*</span></div>
                                        <select id="cach_danh_xung" 
                                        		name="danh_xung" 
                                        		class="input_reg" 
                                                style=" width:255px; 
                                                		height:30px; 
                                                	   	border-color:#D9D9FF; 
                                                        font-family:Cambria; 
                                                        font-size:14px">
                                          <option value="Choose" >Chọn danh xưng ...</option>
                                          <option value="Male">Anh</option>
                                          <option value="Female">Chị</option>
                                        </select>
                                        
                                    </td>
                                </tr>
                                                                                                
                                <tr>
                                    <td width="260px">
                                    	<div class="font11" 
                                        	 style="font-family:Cambria; 
                                             font-size:14px;
                                             margin-bottom:5px">
                                        	Họ & tên đệm (VD: Trần Thanh)
                                            <span class="red">*</span> 
                                       	</div>
                                    	<input type="text" 
                                        	   id="middle_name_field" 
                                               name="middle_name" 
                                               value="" 
                                               class="input_reg" 
                                               maxlength="45"/>
                                    </td>                                   
									<td width="260px">
                                    <div class="font11" 
                               			 style=" font-family:Cambria; 
                                                 font-size:14px; 
                                                 margin-bottom:5px">
                                       		Tên (VD: Phương) 
                                    	<span class="red">*</span></div>
                                        <input type="text" 
                                        	   id="name_field" 
                                               name="name" 
                                               value="" 
                                               class="input_reg" 
                                               maxlength="35"/>
                                    </td>                                    
                                </tr>

								<tr>									
                                    
                                    <td width="260px">
                                    	<div class="font11" style="font-family:Cambria; font-size:14px; margin-bottom:5px"> Email <span class="red">*</span> </div>                                    
                                         <input type="text"  value=""  id="email_field" name="email" class="input_reg" maxlength = "39"/>                                     
                                    </td>  
                                    <td>
                                    	<div class="font11" style="font-family:Cambria; font-size:14px; margin-bottom:5px">Điện thoại di động<span class="red">*</span>                                     		

                                        </div>
                                   		<input type="text"  id ="phone_2_field" name="phone_2"  
                                        				   value="" class="phone_2_field" style="width:250px" autocomplete="off"/> 
                                                                                              	
                                    </td>
                                </tr>
                                
                                <tr>
                                	<td width="260px"> 
                                    	<div class="font11" style="font-family:Cambria; font-size:14px; margin-bottom:5px">Ngày sinh </div>
                                        <input type="text"  value=""  id="birth_day_filed" name="birth_day" class="input_reg" maxlength ="29"/>
                                    </td>  
                                </tr>

                                <tr>
                                	<td>
                                    	<div class="font11" style="font-family:Cambria; font-size:14px; margin-bottom:5px">Mật khẩu <span class="red">*</span><span  id="hint_password"> (Ít nhất có 6 ký tự, bao gồn a-z và 0-9)</span></div>
                                    	<input type="password" id="password_field" name="password" class="input_reg" maxlength = "49"/>
                                    </td>
                                    <td>
                                    	<div class="font11" style="font-family:Cambria; font-size:14px; margin-bottom:5px">Nhập lại mật khẩu <span class="red">*</span><span class="warning red-bold" id="hint_repassword"></span></div>
                                        <input type="password" id="password2_field" name="password2" class="input_reg" maxlength = "49"/>
                                    </td>
                                </tr>                                                                                                                               
                                <tr>                                   
                                    <td height="50px"> 										
                                        <input type="checkbox" width="100px" name="check_agree" value="check" checked style="height:11px; font-family:Cambria; font-size:14px"> Đồng ý nhận thông tin khuyến mãi và tin tức qua email </input>                                                                      
                                   
                                  </td>
                                </tr>
                            
                            </table>

                        </fieldset>
                        <input type="hidden" name="ac" value="register" />
                        <button class="submit-button-orange" style="margin-top:10px" type="submit" onClick="return(submitregistration());"></button>
                    </div>

				</form>

				<!--END_form_register-->
				</div>				
			</div>
		</div>
	</body>