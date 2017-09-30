<?php
class Category {
	public static function getCategoriesParent()
	{
		$categories = GetRows('categories_key,categories_id,categories_name,keywords,description,categories_key','categories','categories_status = 1 and level=1 order by date_added  ASC');
		return $categories;
	}
	
	public static function getCategoriesSub($id_category_parent)
	{
		$categories_sub = GetRows('categories_key,categories_id,categories_name,keywords,description,categories_key','categories','categories_status = 1 and  level=2 and parent_id = '.$id_category_parent.' order by date_added  ASC');
		return $categories_sub;
	}
	
	public static function getCategoryByKey($category_key)
	{
		$category = GetOneRow('categories_id,categories_name,categories_key,level,parent_id','categories',"categories_status = 1 and categories_key ='".$category_key."'");
		return $category;
	}
	
	public static function getCategoryById($category_id)
	{
		$category = GetOneRow('categories_id,categories_name,categories_key','categories',"categories_status = 1 and categories_id =".$category_id);
		return $category;
	}
	
	public static function getCategoryIdByKey($category_key)
	{
		$category = GetOneRow('categories_id,categories_name,categories_key','categories',"categories_status = 1 and categories_key ='".$category_key."'");
		return $category['categories_id'];
	}
	
	public static function getCategoryNameByKey($category_key)
	{
		$category = GetOneRow('categories_id,categories_name,categories_key,level,parent_id','categories',"categories_status = 1 and categories_key ='".$category_key."'");
		return $category['categories_name'];
	}
	
	public static function getCategoryKeyByProductKey($product_key)
	{
		$product =  GetOneRow('categories_id','products','products_key = "'.$product_key.'"');
		$category_id = $product['categories_id'];
		$category = GetOneRow('categories_key','categories','categories_id = '.$category_id);
		return $category['categories_key'];
	}
	
	
	public static function getCategoryPath($category_key)
	{
		$result = array();
		$cate = GetOneRow('categories_id,categories_name,categories_key,level,parent_id','categories',"categories_status = 1 and categories_key ='".$category_key."'");
		$arr = array();
		$arr['name'] = $cate['categories_name'];
		$arr['key'] = $cate['categories_key'];
		$result[] = $arr;
		if($cate['parent_id']>0){
			$cates = GetOneRow('categories_id,categories_name,categories_key,level,parent_id','categories',"categories_status = 1 and categories_id =".$cate['parent_id']);
			$arr2 = array();
			$arr2['name'] = $cates['categories_name'];
			$arr2['key'] = $cates['categories_key'];
			$result[] = $arr2;
		}
		return $result;
	}
}
?>