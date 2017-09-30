<?php 

$finish = input($_GET['finish']);
if(($_SESSION['username']=='')){
	header('Location: '.$linkS.'dang-nhap');
}

$Pet = new Pet();
if(isset($_GET['del'])){
	$id_pet = input($_GET['id_pet']);
	$Pet->removePet($id_pet);
	header('Location: '.$linkS.'pet-profile');
}

$re_pet_profile = $xtemplate->load('list_pet_profile');
$breadcrumbs_path .= '<a href="{linkS}">Nanapet</a>';
$breadcrumbs_path .= ' &raquo; '.'Danh sách Pet';
$tilte_page ='Danh sách Pet | '.'Nanapet';

$blocks = $xtemplate->get_block_from_str($re_pet_profile,'PET');
$pets = $Pet->getListPetByUser($_SESSION['username']);
$n = count($pets);
$tpl_pets = '';
$stt = 1;
foreach ($pets as $pet){
	$sex = 'Đực';
	if($pet['sex'] == '0'){
		$sex = 'Cái';
	}
	$tpl = $xtemplate->assign_vars($blocks,array(
			'tenpet'		=> $pet['name'],
			'loai'			=> $pet['species'],
			'ngaysinh'		=> date("d-m-Y",$pet['birthday']),
			'chieucao'		=> $pet['height'],
			'cannang'		=> $pet['weight'],
			'mausac'		=> $pet['color'],
			'image_pet'		=> $pet['image'],
			'gioitinh'		=> $sex,
			'stt'			=> $stt,
			'id_pet'		=> $pet['id']
	));
	
	$tpl_pets .= $tpl;
	$stt ++;
}

$re_pet_profile = $xtemplate->assign_blocks_content($re_pet_profile ,array(
		'PETS'=>$tpl_pets,
));

//print_r($pets);
$re_pet_profile = $xtemplate->replace($re_pet_profile,array(
			/*'name'			=> $name,
			'birthday'		=> $birthday,
			'species' 		=> $species,
			'mausac'		=> $mausac,
			'chieucao'		=> $chieucao,
			'cannang'		=> $cannang,
			'sex'			=> $sex*/
));
$content = $re_pet_profile;
	
?>
