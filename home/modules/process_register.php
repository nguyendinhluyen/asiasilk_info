
<?php 
	
	$user = input($_POST['username'],1);
	
	$email = input($_POST['email'],1);
	
	$password = md5(input($_POST['password']));
	
	$sex = (isset($_POST['title']))? $_POST['title']:1;
	
	$select_danhxung = $_POST['danh_xung'];
	
	$middle_name = input($_POST['middle_name'],1);

	$name = input($_POST['name'],1);			
	
	$birth_day_filed = input(strtotime($_POST['birth_day']),1);
	
	$phone = input($_POST['phone_2'],1);
	
	$address = input($_POST['address_1'],1);
				
	$numrow = GetNumRow('username,email','user',"email ='$email' and status > -1");	
	
	if($numrow >0)
	{
		?>
			<script>
				alert('Email này đã có người đăng ký. Vui lòng chọn email khác.');
				history.go(-1);				
			</script>
		<?php
	}
	
	else
	{
								
		if($select_danhxung == 'Male')
		{
			$select_danhxung = "1";
		
			$middle_name = '('.'Anh'.')'.' '.$middle_name.' '.$name;
		}

		else 
		{
			$select_danhxung = "0";
			
			$middle_name = '('.'Chị'.')'.' '.$middle_name.' '.$name;
		}
		
		$sql = "INSERT INTO user(birthday,password,email,name,sex,phone,date,status,GroupMember) VALUES ('".$birth_day_filed."','".$password."','".$email."','".$middle_name."','".$select_danhxung."','".$phone."',".time().",0,'"."Chưa là thành viên"."')";	

		$mysql->setQuery($sql);
	
		if($mysql -> query()){
	
			$lastId = mysql_insert_id();
	
			$image = renameFile($_FILES["avatar"]["name"],'avatar'.'-'.$lastId);
	
			//Resize 	
			if(move_uploaded_file($_FILES ["avatar"]["tmp_name"],'../upload/avatar/'.$image))
			{
				@imagejpeg(resize('../upload/avatar/'.$image,100,120),'../upload/avatar/'.$image);
	
				$sql = "update user set avarta ='".$image."' where id = ".$lastId;
	
				$mysql->setQuery($sql);
	
				$mysql -> query();
			}						
	}

	?>
		<script>
            alert('Đăng ký thành công');
            window.location='dang-nhap';
        </script>
	<?php 
	
}?>