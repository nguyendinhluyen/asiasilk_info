<div id="product">
	<div id="breakcrumb" style="margin-top:20px; font-family:Cambria; font-size:14px">{breadcrumbs_path}</div>                     
     	<div class="product_main">
     		<div style="clear:both"></div>
				<form action="{linkS}process-login" method="post" name="com-login" id="com-form-login">
				&nbsp;
			<div id="dangnhap" style="">
            	<div id="login_detail">
               		<div id="left_box">
                    	<div class="bold-grey" style="font-family:Cambria; 
                        							  font-size:20px; 
                                                      color:#A00">Thành viên đăng nhập</div>
                        	<div style="margin-top:20px;">
                         		<table width="330px" style="font-family:Cambria; font-size:15px; color:#2A1FAA">
                                	<tr>
                                     	<td>Email:</td>
                                        <td><input type="text" 
                                        		   size="18" 
                                        		   alt="username" 
                                                   class="inputbox" 
                                                   id="username" 
                                                   name="username"></td>
                                   	</tr>
                                    <tr>
                                       	<td>Password:</td>
                                        <td><input type="password"
                                        		   size="18" 
                                                   class="inputbox" 
                                                   name="passwd" id="passwd"></td>
                                   	</tr>
                                    <tr>                                  	
                                    	<td>
                                        	<input type="checkbox" 
                                        		   name="remember" 
                                                   value="1" height="14"> Ghi nhớ?</td>
                                    </tr>
                               	</table>
                        	</div>
                           	<div style="margin-top:30px;">
                           		<table>
                                    	<tr>
                                        	<td width="200px"><a href="{linkS}quen-mat-khau" >Quên password ?</a></td>
                                            <td>
                                            	<input type="image" 
                                            		   name="Submit" 
                                                       style="width:109px;height:32px;border:0px" 
                                                       src="{linkS}layout/images/signin.png" 
                                                       value=""/>
                                       		</td>
                                        </tr>	
                                    </table>
                                </div>
                            </div>
                            <div id="right_box">
                                <div class="bold-grey" style="font-family:Cambria; font-size:20px; color:#A00">Tạo tài khoản</div>
                                <div style="width:205px; line-height:18px; padding-top:20px; padding-right:50px; font-family:Cambria; font-size:14px ; color:#2A1FAA">Nếu bạn chưa có tài khoản, hãy đăng ký tài khoản bằng đường dẫn bên dưới. </div>
                                <div style="margin-top:30px;"><a href="{linkS}dang-ky"><img src="{linkS}layout/images/taotaikhoan.png" /></a></div>
                            </div>                        
                        </div> <!-- end login_detail -->                                               
                    </div><!-- end login -->
                    <input type="hidden" name="option" value="com_user" />
                    <input type="hidden" name="task" value="login" />
                    <input type="hidden" name="return" value="aW5kZXgucGhw" />
                    <input type="hidden" name="edf47aae86f469e7c9b85c4408c628f3" value="1" /></form>                                              
 	</div><!-- end product_main -->                       	
</div><!-- end product -->
                