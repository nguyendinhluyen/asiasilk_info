<?php 

$finish = input($_GET['finish']);

if(($_SESSION['username']=='')){

	header('Location: '.$linkS.'dang-nhap');

}

$name = input($_POST['name']);

$birthday = input($_POST['birthday']);

$species = input($_POST['species']);

$mausac = input($_POST['mausac']);

$chieucao = input($_POST['chieucao']);

$cannang = input($_POST['cannang']);

$sex = input($_POST['sex']);



$User = new User();

$us = $User->getUserInfo($_SESSION['username']);

$pet['id_user'] = $us['id'];

$pet['name'] = $name;

$pet['birthday'] = strtotime($birthday);

$pet['species'] = $species;

$pet['sex'] = $sex;

$pet['height'] = $chieucao;

$pet['image'] = '';

$pet['weight'] = $cannang;

$pet['color'] = $mausac;

$Pet = new Pet();

$score = new ScoreModel();

if(isset($_POST['submit']))
{

	
	//update score

	//$us_score = $score->getScoreByUser($_SESSION['username']);

	//$us_score += 20;

	//$score -> updateScore($_SESSION['username'], $us_score);

	$usrPet = GetOneRow("id","user","email = '".$_SESSION['username']."'");

	$ls_pet = GetRows("id","pet_profile","id_user = ".$usrPet["id"]);

	if(empty($ls_pet))
	{
		//updateScore($_SESSION['username'],"add",20,ACTION_REGISTER_PET);
	}

	else
	{
	

	}

	//end update score
	
	$id_pet = $Pet-> savePet($pet);

	$image = renameFile($_FILES["petimage"]["name"],'pet'.'-'.$id_pet);

	if(move_uploaded_file($_FILES ["petimage"]["tmp_name"],'../upload/avatar/'.$image))

	{

		@imagejpeg(resize('../upload/avatar/'.$image,100,120),'../upload/avatar/'.$image);

		$sql = "update pet_profile set image ='".$image."' where id = ".$id_pet;

		$mysql->setQuery($sql);

		$mysql -> query();

	}		

	?>

		<script>
			window.location="<?php echo $linkS.'pet-profile'; ?>";
		</script>

    <?php  
}

$re_pet_profile = $xtemplate->load('re_pet_profile');

$breadcrumbs_path .= '<a href="{linkS}">Nanapet</a>';

$breadcrumbs_path .= ' &raquo; '.'Đăng ký Pet profile';

$tilte_page ='Đăng ký pet profile | '.'Nanapet';


$re_pet_profile = $xtemplate->replace($re_pet_profile,array(

			'name'			=> $name,

			'birthday'		=> $birthday,

			'species' 		=> $species,

			'mausac'		=> $mausac,

			'chieucao'		=> $chieucao,

			'cannang'		=> $cannang,

			'sex'			=> $sex

));

$content = $re_pet_profile;

	

?>

