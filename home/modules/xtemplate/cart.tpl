<style>
.cart{
	border-top:1px solid #BCDDEE;
}
.cart td,.cart th{
	border-bottom:1px solid #BCDDEE;
	border-left:1px solid #BCDDEE;
	border-right:1px solid #BCDDEE;
	padding:3px;
}
.recycle_bin_empty
{
	background:url('{linkS}layout/images/recycle_bin_empty.png') no-repeat left center;
	text-indent:20px;
	padding:3px;
	border:2px solid #BCDDEE
}
.order{
	padding:3px;
	border:2px solid #ccc;
	color:#999;
	text-indent:20px;
	background:url('{linkS}layout/images/shopping.png') no-repeat left center;
	
}
</style>
<div id="product">
                	<div id="breakcrumb">{breadcrumbs_path}</div> 
<div class="product_main">
<!-- Cart Begins here --><br/>
<tr class="sectiontableentry1">

       <input class="order" type="button" value="Đặt hàng" onclick="window.location='{linkS}ket-thuc-mua-hang'"/>
       <input type="button" class="recycle_bin_empty"  value="Xóa hết giỏ hàng" onclick="window.location='{linkS}gio-hang-empty'"/>
  <br>  <br>


<table width="100%" border='0' cellpadding="0" cellspacing="0" class="cart" >
  <tr align="left" class="sectiontableheader">
  	<th  style="border-right:none">Ảnh</th>

    <th  style="border-right:none">Tên</th>
    <th  style="border-right:none">Mã hàng</th>
	<th  style="border-right:none">Giá</th>
	<th  style="border-right:none">Số lượng / Cập nhật</th>
	<th>Tổng</th>
  </tr>
   <!--BEGINLIST_LISTCART-->
 <!--BEGIN_LISTCART-->
 
  <tr valign="top" ">
  <td  style="border-right:none"><a href=""><img width=50 src="{linkS}upload/product/{product_image}" /></a></td>
	<td  style="border-right:none"><a href=""><strong>{product_name}</strong></a><br/>{description}</td>
	<td  style="border-right:none">{product_id}</td>
	<td   style="border-right:none"align="right">{price} {price_unit}</td>
	<td  style="border-right:none"><form action="{linkS}gio-hang/{product_key}/edit" method="post" style="display: inline;">
	
		<input type="text" title="Cập nhật số lượng trong giỏ" style="width:28px;height:16px"  size="4" maxlength="4" name="quantity" value="{quantity}" />
		<input type="hidden" name="type" value="{type}"/> 
		<input type="hidden" name="color" value="{color}"/> 
    <input type="image" name="update" title="Cập nhật số lượng trong giỏ" src="{linkS}layout/images/update_quantity_cart.png" alt="Cập nhật" align="middle" />
  </form>		
  
  <form action="{linkS}gio-hang/{product_key}/del" method="post" name="delete_f" style="display: inline;">
  	<input type="hidden" name="type" value="{type}"/> 
	<input type="hidden" name="color" value="{color}"/> 
	<input type="image" name="delete" title="Xóa sản phẩm trong giỏ" src="{linkS}layout/images/remove_from_cart.png" alt="Xóa sản phẩm trong giỏ" align="middle" />
  </form>	</td>
    <td align="right">{total_one} {price_unit}</td>
  </tr>
  
   <!--END_LISTCART-->
   <!--ENDLIST_LISTCART-->
   
<!--Begin of SubTotal, Tax, Shipping, Coupon Discount and Total listing -->
  <tr class="sectiontableentry1">
    <td colspan="5" align="right" class="align" style="border:none">Tổng</td> 
    <td colspan="2" align="right" style="border:none">{total} {price_unit}</td>
  </tr>

  <tr class="sectiontableentry1">
    <td colspan="5" align="right" class="align" style="border:none">Tổng tiền hàng </td>
    <td colspan="2" align="right" style="border:none"><strong>{total} {price_unit}</strong></td>
  </tr>
  <tr class="sectiontableentry1">

        <td colspan="5" align="right" class="align" valign="top" style="border:none">Tiền thuế </td> 
        <td colspan="2" align="right" style="border:none">0 {price_unit}</td>
  </tr>
  
</table>



<table width="100%" class="vmCouponField">
	<tr>
		<td width="100%">

		</td>
	</tr>

</table>
</div>
</div>
<script type="text/javascript">
function checkCouponField(form) {
	if(form.coupon_code.value == '') {
		new Effect.Highlight('coupon_code');
		return false;
	}
	return true;
}
</script><!-- End Cart --><br />