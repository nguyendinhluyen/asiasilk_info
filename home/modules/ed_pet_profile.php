<?php 

$finish = input($_GET['finish']);
if(($_SESSION['username']=='')){
	header('Location: '.$linkS.'dang-nhap');
}

$id_pet = input($_GET['id_pet']);
$Pet = new Pet();
$petinfo = $Pet->getInfoPetById($id_pet);
$name = $petinfo['name'];
$birthday = $petinfo['birthday'];
$species = $petinfo['species'];
$mausac = $petinfo['color'];
$chieucao = $petinfo['height'];
$cannang = $petinfo['weight'];
$sex = $petinfo['sex'];
$img_pet = $petinfo['image'];

if(isset($_POST['submit'])){
	$name = input($_POST['name'],1);
	$birthday = input($_POST['birthday'],1);
	$species = input($_POST['species'],1);
	$mausac = input($_POST['mausac'],1);
	$chieucao = input($_POST['chieucao'],1);
	$cannang = input($_POST['cannang'],1);
	$sex = input($_POST['sex'],1);
}
//echo strtotime($birthday);die;
$pet['id'] = $id_pet;
$pet['name'] = $name;
$pet['birthday'] = strtotime($birthday);
$pet['species'] = $species;
$pet['sex'] = $sex;
$pet['height'] = $chieucao;
$pet['image'] = '';
$pet['weight'] = $cannang;
$pet['color'] = $mausac;

if(isset($_POST['submit'])){
	$Pet->updatePet($pet);
	$image = renameFile($_FILES["petimage"]["name"],'pet'.'-'.$id_pet);
	if(move_uploaded_file($_FILES ["petimage"]["tmp_name"],'../upload/avatar/'.$image))
	{
		@imagejpeg(resize('../upload/avatar/'.$image,100,120),'../upload/avatar/'.$image);
		$sql = "update pet_profile set image ='".$image."' where id = ".$id_pet;
		$mysql->setQuery($sql);
		$mysql -> query();
	}
	header('Location: '.$linkS.'pet-profile');
}

$re_pet_profile = $xtemplate->load('ed_pet_profile');
$breadcrumbs_path .= '<a href="{linkS}">Nanapet</a>';
$breadcrumbs_path .= ' &raquo; '.'Cập nhật pet profile';
$tilte_page ='Cập nhật pet profile | '.'Nanapet';

$re_pet_profile = $xtemplate->replace($re_pet_profile,array(
			'name'			=> $name,
			'birthday'		=> date("Y-m-d",$birthday),
			'species' 		=> $species,
			'mausac'		=> $mausac,
			'chieucao'		=> $chieucao,
			'cannang'		=> $cannang,
			'sex'			=> $sex,
			'img_pet'		=> $img_pet
));
$content = $re_pet_profile;
	
?>
