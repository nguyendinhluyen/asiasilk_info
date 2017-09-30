
<script type="text/javascript">
function xoa()
{
	 return confirm("Bạn thực chắc chắn muốn xóa");
}
<!--
$(document).ready(function(){
	function loadData(id_order){              
	    $.ajax
	    ({
	        type: "GET",
	        url: "{linkS}home/modules/ajax/loadHistoryOrder.php",
	        data: "id_order="+id_order,
	        success: function(msg)
	        {
	            //$("#"+tab).ajaxComplete(function(event, request, settings)
	            //{
	                //loading_hide();
	                $('.detail_history').html(msg);
	            //});
	        }
	    });
	}
	
	$('.product_main .show a').live('click',function(){
		var id_order = $(this).attr("href");
		//var user = "{user}";
		loadData(id_order);
		return false;
  	});
	
});
//-->
</script>

                     <div class="product_main" style="width: 530px;">
                       <br>
                       <p align='center'><b>Lịch sử mua hàng</b></p>
                      
                           <table width="523px;" border='1' cellspacing='0' style="text-align: center;">
                           	<tr class="sectiontableheader">
                           		<td>Mã đơn hàng</td>
                           		<td>Ngày đặt hàng</td>
                           		<td>Tổng tiền</td>
                           		<td>Trạng thái</td>
                           		<td></td>
                           		
                           	</tr>
		                 <!--BEGINLIST_ORDER-->
						<!--BEGIN_ORDER-->			
                           	<tr>
                           		<td><div class="show"><a href="{madonhang}">{madonhang}</a></div></td>
                           		<td>{ngaydat}</td>
                           		<td>{tongtien} VNĐ</td>
                           		<td>{trangthai}</td>
                           		<td>{edit_html}</td>
                           	</tr>
	                 <!--END_ORDER-->
					<!--ENDLIST_ORDER-->
                           </table>
                        
                         <br/>
                          <br/>
                          
                         <div class="detail_history">
	                         
                         </div> 
                
                