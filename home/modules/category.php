<?php

	$category = $xtemplate->load('category');

	$Cate = new Category();

	$categories = $Cate->getCategoriesParent();//get array category parent;

	$n = count($categories);// category parent;	

	$tpl = '';

	$block = $xtemplate->get_block_from_str($category,'CATEGORY');

	for($i=0;$i<$n;++$i)
	{
		$tpl.= $xtemplate->assign_vars($block,array(

												'category_name'	=> $categories[$i]['categories_name'],// thay name

												'category_key'	=> $categories[$i]['categories_key']

												));

		$block_sub = $xtemplate->get_block_from_str($category,'SUBCATEGORY');

		$categories_sub = $Cate->getCategoriesSub($categories[$i]['categories_id']);//get array category childrent;

		$m = count($categories_sub);// so category child;		

		$tpl2 = '';

		for($j=0;$j<$m;++$j)
		{

			$tpl2.= $xtemplate->assign_vars($block_sub,array(

													'category_sub_name'	=> $categories_sub[$j]['categories_name'],

													'category_sub_key'	=> $categories_sub[$j]['categories_key'],

													'category_key'		=> $categories[$i]['categories_key']

													));

		}
		$tpl = $xtemplate->assign_blocks_content($tpl,array(

														'SUBCATEGORY'=>$tpl2
		));
	}
	
	//$tpl = '<li class="danhmuc_main"><a href="{linkS}sale-off.htm">Sale off</a></li>'. $tpl;
		
	$category = $xtemplate -> assign_blocks_content($category,array(

													'CATEGORY'=>$tpl
	));	

?>