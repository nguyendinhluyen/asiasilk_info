<?php	
	
	// Xu ly nut xoa cho tat ca cac trang tin tuc
	
	if(($_GET['action'] == 'del') && isset($_GET['id']))
	{

		$id = intval($_GET['id']);

		delete_img_news($id);

		delete_news($id);

		if($_GET['opt'] == 1)
		{
			header('location:./?show=newsList&opt=1');
		}
		else if($_GET['opt'] == 2)
		{
			header('location:./?show=newsList&opt=2');
		}
		else 
			header('location:./?show=newsList');

	}
		
	// Xu ly nut del cho tat ca cac trang tin tuc
	
	if(isset($_POST['btndel']))
	{

		if(count($_POST['chk']) == 1 && $_GET['opt'] == '2')
		{
			$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';				
		
			delete_img_news($id);
	
			delete_news($id);					

			if($_GET['order'] != '')
			{
				header('location:./?show=newsList&opt=2&p='.$_GET['p'].'&order='.$_GET['order']);
			}
			
			else
			{
				header('location:./?show=newsList&opt=2&p='.$_GET['p']);
			}
		}
		else
		{
			?>
				<script>
				
					alert("Chỉ được chọn xóa 1 đối tượng! Vui lòng chọn lại! ");
				
				</script>							
            <?php			
		}
		
		
		if($_GET['opt'] != '2')
		{			
			$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';				
		
			delete_img_news($id);
	
			delete_news($id);	
			
			if($_GET['order'] != '')
			{
				header('location:./?show=newsList&p='.$_GET['p'].'&order='.$_GET['order']);
			}
			
			else
			{
				header('location:./?show=newsList&p='.$_GET['p']);
			}
		}		
	}

	// Xu ly nut Status cho tat ca cac trang tin tuc
	
	else if(isset($_POST['btnStatus']))
	{

		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';

		Set_status_news($id);

		if($_GET['order'] != "")
		{
			header('location:./?show=newsList&p='.$_GET['p'].'&order='.$_GET['order']);
		}
		else
		{
			header('location:./?show=newsList&p='.$_GET['p']);
		}		
	}

	else if(isset($_POST['btnNewswait']))
	{

		$id = (count($_POST['chk']) > 0)?implode($_POST['chk'],','):'';

		Set_news_waitting($id);


		if($_GET['opt'] == 1)
		{
			header('location:./?show=newsList&opt=1');
		}
		else if($_GET['opt'] == 2)
		{
			header('location:./?show=newsList&opt=2');
		}
		else 
			header('location:./?show=newsList');

	}

	$title = 'Quản lý tin tức';

	$xtemplate -> path = 'com_news/';

	$content = $xtemplate -> load('NewsList');

	$code_cats = $xtemplate ->get_block_from_str($content,"NEWS");

	//Phan trang

	$p_now 		= 	intval($_GET ['p']);

	$mysql 		->	setQuery("Select news_id from news where language ='".$lag."'");	

	$mysql 		->	query();

	$total		=	$mysql -> getNumRows();

	$numofpages = $total / $pp;

	if ($p_now <= 0)

	{

		$page = 1;

	} 

	else

	{

		if($p_now <= ceil($numofpages))

			$page = $p_now;

		else

			$page = 1;

	}

	$limitvalue = $page * $pp - ($pp);

	//end phan trang

	switch($_GET['order'])
	{

		case 'name':

			$orderby = ' news_name asc';

			break;
		
		case 'name_desc':

			$orderby = ' news_name desc';

			break;

		case 'catalogue':

			$orderby = ' news_catalogue asc';

			break;

		case 'status':

			$orderby = ' status asc';

			break;

		case 'dateadd':

			$orderby = ' date_added asc';

			break;

		case 'dateadd_desc':

			$orderby = ' date_added desc';

			break;

		case 'datemodifiled':

			$orderby = ' last_modified asc';

			break;

		case 'datemodifiled_desc':

			$orderby = ' last_modified desc';

			break;

		default:

			$orderby = ' date_added desc';

		break;

	}

	$hide = '';

	$opt = 0;

	$sql = "Select news_id,news_name,news_image,news_catalogue,status,date_added,last_modified from news where language ='".$_SESSION['lag']."' and menu = 0 and help_flag = 0 order by $orderby limit $limitvalue,$pp";	

	$style_display = "";

	//$thuocdanhmuc = "Thuộc danh mục";

	if($_GET['opt'] == 1) // tin tuc chung
	{
		$status = 'disabled="disabled"';

		$hide = 'hide';

		$opt = 1;

		$style_display = 'display: none;';

		// VI TRI THEM
		
		// XOA NUT DELETE VA ADD
		$style_display_btDelete = 'display: none;';		
		
		$style_display_btAdd = 'display: none;';
		
		$thuocdanhmuc = "&nbsp;";

		$sql = "Select news_id,news_name,news_image,news_catalogue,status,date_added,last_modified from news where language ='".$_SESSION['lag']."' and menu = 1 order by $orderby limit $limitvalue,$pp";

	}

	if($_GET['opt'] == 2) // tin tuc tro giup
	{
		
		$chk_disabled = 'disabled="disabled"';

		$hide = 'hide';

		$opt = 2;

		$style_display = 'display: none;';
		
		$style_display_btStatus = 'display: none;';
		
		// VI TRI SUA THEO THU TU TRO GIUP
		
		$sql = "Select news_id,news_name,news_image,news_catalogue,status,date_added,last_modified from news where language ='".$_SESSION['lag']."' and help_flag = 1 order by news_ordered";

	}

	$mysql -> setQuery($sql);

	$row = $mysql->loadAllRow();

	$n = count($row);

	$temp = '';

	for($i = 0 ; $i < $n ; ++$i)

	{

		$color = ($i%2==0)?'#d5d5d5':'#e5e5e5';

		$img = $row[$i]['news_image'];

		$imgSrc = _UPLOAD_IMG_NEWS.$img;

		$imgThumb = _UPLOAD_IMG_NEWS_THUMB.$img;

		$img = ($img=='')?"<img src ='"._STYLE_IMG."picoff.gif'>":"<a href ='$imgThumb'><img border=0 style=\"cursor:hand\" src=\""._STYLE_IMG."picon.gif\" onmouseover=\"this.src='"._STYLE_IMG."piconover.gif';return overlib('<div><table border=0 cellpadding=2 cellspacing=0><tr><td class=titleImg>Click to Thumbnails</td></tr><tr><td><img src=$imgSrc></a></td></tr></table></div>');\" onmouseout=\"this.src='"._STYLE_IMG."picon.gif';return nd();\"></a>";

		$temp.= $xtemplate ->assign_vars($code_cats,array(

											'id'	=>$row[$i]['news_id'],	

											'news_name' => $row[$i]['news_name'],	

											'news_catalogue'		=> get_catsnews_name($row[$i]['news_catalogue']),	

											'news_image'		=> $img,

											'status'		=> ($row[$i]['status']=='1')?$arr_lang['show']:$arr_lang['hidden'],	

											'date_added'		=> date('h:i d/m/Y',$row[$i]['date_added']),

											'last_modified'		=> ($row[$i]['last_modified']=='0')?'0':date('h:i d/m/Y',$row[$i]['last_modified']),

											'color'				=> $color));

	}

	$content = $xtemplate ->assign_blocks_content($content,array("NEWS" => $temp));
	
	///////////////////////////////////////////////////////////////////////////////////////////
	
	if($_GET['opt'] == 2)
	{
		$thuocdanhmuc = "&nbsp;";
		
		$date = 'Ngày thêm';
		
		$date_modify = 'Lần sửa';

		$lag_status = 'Trạng thái';
		
		$content = $xtemplate ->replace($content,array(

		'a'	=>'Tiêu đề',		

		'thuocdanhmuc'		=> $thuocdanhmuc,
		
		'lag_status'		=> $lag_status,
				
		'date' 				=> $date,	
		
		'date_modify'		=> $date_modify,		
		
		));
	}
	else 
	{
		$thuocdanhmuc = "<a href = './?show=newsList&order=catalogue&p={p}' style = 'text-decoration:underline'>Thuộc danh mục</a>";
		
		$date = "<a href = './?show=newsList&order=dateadd&p={p}'style = 'text-decoration:underline'>Ngày thêm (cũ)</a></a><span>&nbsp&nbsp-&nbsp </span><span><a href = './?show=newsList&order=dateadd_desc&p={p}' style ='text-decoration:underline'>(mới)</a></span>";
		
		$date_modify = "<a href = './?show=newsList&order=datemodifiled&p={p}'style = 'text-decoration:underline'>Lần sửa (cũ)</a><span>&nbsp&nbsp-&nbsp </span><span><a href = './?show=newsList&order=datemodifiled_desc&p={p}' style ='text-decoration:underline'>(mới)</a></span>";

		$lag_status =  "<a href = './?show=newsList&order=status&p={p}'style='text-decoration:underline'>Trạng thái</a>";

		$content = $xtemplate ->replace($content,array(

		'a'	=> '<a href = "./?show=newsList&order=name&p={p}"style = "text-decoration:underline">Tiêu đề (a->z)</a><span>&nbsp&nbsp-&nbsp </span><span><a href = "./?show=newsList&order=name_desc&p={p}"style = "text-decoration:underline">(z->a)</a></span>',

		'thuocdanhmuc'		=> $thuocdanhmuc,					
		
		'lag_status'		=> $lag_status,
		
		'date' 				=> $date,
		
		'date_modify'		=> $date_modify,		
		
		));				
	}	

	/////////////////////////////////////////////////////////////////////////////////////////////////

	$content = $xtemplate ->replace($content,array(

	'lag_product_manager'	=> $title,

	'lag_page'			=> $arr_lang['page'],		

	'p'					=> ($_GET['p']=='')?'1':intval($_GET['p']), // Lay hoac gan gia tri cho p		

	'oderby'			=> $_GET['order'],

	'page'				=> page_div("./?show=newsList&p=%d_pg&order=".$_GET['order'], "10", ceil ( $numofpages ), $page),

	'lag_delete'		=> $arr_lang['del'],

	'lag_edit'			=> $arr_lang['edit'],
	
	'lag_date_create'	=> $arr_lang['date_added'],

	'lag_date_modifiled'=> $arr_lang['date_modifiled'],

	'delete_check'		=> $arr_lang['del_check'],

	'del_confirm' 		=> $arr_lang['del_confirm'],

	'status' 			=> $status,

	'hide'				=> $hide,

	'opt'				=> $opt,

	'style_display'		=> $style_display,			
	
	//KHONG CO PHAN AN/HIEN THI TRONG TRO GIUP
	
	'style_display_btStatus' => $style_display_btStatus,
	
	'style_display_btAdd' => $style_display_btAdd,
	
	'style_display_btDelete' => $style_display_btDelete,
	
	//'chk_disabled' => $chk_disabled,

	chk_disabled_all => $chk_disabled,

	));			
	
	$script = $xtemplate ->get_block_from_str($content,"SCRIPT");

	$content = $xtemplate ->assign_blocks_content($content,array("SCRIPT" =>''));
	
?>