<?php
class News {
	
	public static function getFistRowsOfHelp()
	{
		$introduce = GetRowsOrderBy('news_key','news',"help_flag = 1 and status = 1");
		return $introduce;
	}
	
	public static function getIntroduce()
	{
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'gioi-thieu-chung-58' or news_key= 'thuong-mai-dien-tu-59') and status=1");
		return $introduce;
	}

	public static function getContact(){
		$contact = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'gop-y-lien-he-68') and status=1");
		return $contact;
	}
	
	public static function getCartHelp(){
		$contact = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'huong-dan-mua-hang-62') and status=1");
		return $contact;
	}
	public static function getFAQ(){
		$contact = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'cau-hoi-thuong-gap-65') and status=1");
		return $contact;
	}
	//van chuyen
	public static function getVanChuyen(){
		$contact = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'dich-vu-van-chuyen-63') and status=1");
		return $contact;
	}
	//thanh toan
	public static function getCoupon(){
		$contact = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'cach-thuc-thanh-toan-64') and status=1");
		return $contact;
	}
	
	public static function getPet(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"(news_key= 'gioi-thieu-pet-60' or news_key= 'dien-dan-yeu-dong-vat-61') and status=1");
		return $introduce;
	}
	
	
	public static function getNewsListPromotion(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 21 and status=1 and menu = 0");
		return $introduce;
	}
	public static function getNewsListPromotionLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 21 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	public static function getNewsListGame(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 23 and status=1 and menu = 0");
		return $introduce;
	}
	
	public static function getNewsListGameLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 23 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	public static function getNewsListFilm(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 24 and status=1 and menu = 0");
		return $introduce;
	}
	
	public static function getNewsListFilmLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 24 and status=1 and menu = 0 limit  ".$start.",".$numberRec);
		return $introduce;
	}
	
	//cham soc thu cung
	public static function getNewsListPet(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 17 and status=1 and menu = 0");
		return $introduce;
	}
	//cham soc thu cung
	public static function getNewsListPetLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 17 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	//thu y
	public static function getNewsListVeterinary(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 19 and status=1 and menu = 0");
		return $introduce;
	}
	//thu y
	public static function getNewsListVeterinaryLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 19 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	
	//dinh duong 
	public static function getNewsListNutrition(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 18 and status=1 and menu = 0");
		return $introduce;
	}
	//dinh duong
	public static function getNewsListNutritionLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 18 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	//chuyen do day
	public static function getNewsListChuyenDoDay(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 20 and status=1 and menu = 0");
		return $introduce;
	}
	
	//chuyen do day
	public static function getNewsListChuyenDoDayLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 20 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	//Am nhac
	public static function getNewsListAmNhac(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 26 and status=1 and menu = 0");
		return $introduce;
	}
	
	public static function getNewsListAmNhacLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"news_catalogue = 26 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	

	////THU VIEN
	// Lay Dinh Duong Cham Soc Thu y
	
	public static function getNewsListAllLibary(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 27 OR news_catalogue = 28 OR news_catalogue = 29 AND status=1 AND menu = 0 ORDER BY date_added DESC");
		return $introduce;
	}

	public static function getNewsListAllLibaryDog(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news','news_catalogue in (27,28,29) AND status=1 AND menu = 0 AND news_name LIKE "%cho%" AND news_name NOT LIKE "%meo%" ORDER BY date_added DESC');
		return $introduce;
	}
	
	public static function getNewsListAllLibaryCat()
	{
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news','news_catalogue in (27,28,29) AND status=1 AND menu = 0 AND news_name LIKE "%meo%" ORDER BY date_added DESC');
		return $introduce;
	}	
	
	//Dinh duong
	public static function getNewsListDinhDuong(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 27 and status=1 and menu = 0 ORDER BY date_added DESC");
		return $introduce;
	}
	
	public static function getNewsListDinhDuongLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 27 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	//Cham soc
	public static function getNewsListChamSoc(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 28 and status=1 and menu = 0 ORDER BY date_added DESC");
		return $introduce;
	}
	
	public static function getNewsListChamSocLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 28 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	//Thu y
	public static function getNewsListThuY(){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 29 and status=1 and menu = 0 ORDER BY date_added DESC");
		return $introduce;
	}
	
	public static function getNewsListThuYLimit($start,$numberRec){
		$introduce = GetRows('news_name,news_image,news_shortcontent,news_content,news_key,date_added,translator','news',"news_catalogue = 29 and status=1 and menu = 0 limit ".$start.",".$numberRec);
		return $introduce;
	}
	
	///////////////////////////////////////////////////////////////////////////////////////
		
	
	public static function getDetailNews($news_key){
		$info = GetOneRow('news_name,news_image,news_shortcontent,news_content,news_key,author,resource,translator,date_added','news',"news_key = '".$news_key."'");
		return $info;
	}
	
	public static function getNewsNewest($numberNews){
		$info = GetRows('news_name,news_catalogue,news_image,news_shortcontent,news_content,news_key,help_flag','news',"help_flag = 1 or (news_catalogue > 26 and news_catalogue < 30) ORDER BY date_added DESC limit 0,".$numberNews);
		return $info;
	}
	
	public static function getNews(){
		$info = GetRows('news_name,news_image,news_shortcontent,news_content,news_key','news',"menu = 0 and help = 0");
		return $info;
	}
	
	public static function getHelp(){
		$info = GetRowsOrderBy('news_name,news_image,news_shortcontent,news_content,news_key','news',"menu = 0 and help_flag = 1 and status = 1");
		return $info;
	}
}
?>