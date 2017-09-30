 <div id="product">
    <div id="breakcrumb">{breadcrumbs_path}</div> 
    <div class="news_main" style="padding-top: 30px;">
      
      <div align="center" style="padding: 20px;width:550px; border:1px solid #D4D4D4; border-radius:15px 15px 15px 15px;background: #F4F4F4">
      <div class="bold-grey" style="padding-top: -90px;">Quên mật khẩu</div><br/>
      <form method="post" name="forgotpass">
	    <table border = "0">
	    	<tr> 
	    		<td colspan="3"><font color="red"><b>{msg}</b></font></td>
	
	    	</tr>
	    	<tr> 
	    		<td colspan="3">Nếu bạn quên mật khẩu, hãy điền email của bạn vào ô bên dưới và nhấn lấy lại mật khẩu.</br> Bạn sẽ nhận được mail thông qua link kích hoạt xác nhận lấy lại mật khẩu</td>
	
	    	</tr>
	    	<tr> 
	    		<td><div class="font11">Email : &nbsp; </div></td>
	    		<td width="210px"><input type="text" id="email" name="email" value="" class="input_reg" /></td>
	    		<td style="vertical-align:middle;"> &nbsp;&nbsp;<input type="submit"  value="Lấy lại mật khẩu" name="forgot"/> <a href="{linkS}dang-nhap"><img style="float: right;" src="{linkS}layout/images/signin.png"/ height="20px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	    	</tr>
	    	
	    </table>  
	   </form>
      </div>
                 
    </div><!-- end product_main -->
</div><!-- end product -->