<?php 
class User{
	public static function getUserInfo($username){
		$user = GetOneRow('id,username,password,name,sex,birthday,phone,email,address','user'," email = '".$username."' and status > -1");
		return $user;
	}
	public function getOrderByUser($user){
		$userOrder = GetRows('id,status,order_date,total','tbl_order' ,"username ='".$user."'" );
		return $userOrder;
	}
	public function getHistoryOrderByUser($user){
		$order = self::getOrderByUser($user);
		$orderDetail = GetRows('product_name,product_type,product_color,product_price,product_quantity,status', 'order_detail', "id_order = ".$order['id']);
		return $orderDetail;
	}
	public function getHistoryOrderByrderIdOrder($order_id){
		$orderDetail = GetRows('product_name,product_type,product_color,product_price,product_quantity,status', 'order_detail', "id_order = ".$order_id);
		return $orderDetail;
	}
	
	public function getUserInfoByActiveLink($link){
		$user = GetOneRow('id,username,password,name,sex,birthday,phone,email,address,active_link','user'," active_link = '".$link."' and status > -1");
		return $user;
	}
	public function updateActiveLink($email,$link){
		global $mysql;
		$sql = "update user set active_link ='".$link."'  where email = '".$email."' and status > -1";
		$mysql->setQuery($sql);
		$mysql -> query();
	}
	
	public function updateAfterForgotPass($email,$pass){
		global $mysql;
		$sql = "update user set active_link ='',password = '".$pass."'  where email = '".$email."' and status > -1";
		$mysql->setQuery($sql);
		$mysql -> query();
	}
}
?>