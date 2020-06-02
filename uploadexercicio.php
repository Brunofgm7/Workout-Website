<?php
include 'database.php';
include 'server.php';



if(!empty($_POST))
    {
    	$target_dir = "fotos/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		} else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		}
		

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
		{
		  echo "Sorry, only JPG, JPEG, PNG files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    rename($target_dir. $_FILES["fileToUpload"]["name"], $target_dir ."perfil_".$_SESSION["username"].".jpg");
		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}

    }

        
        $nome=isset($_POST["nome"])?$_POST["nome"]:'';
        $dataNasc=isset($_POST["dataNasc"])?$_POST["dataNasc"]:'';
        $email=isset($_POST["email"])?$_POST["email"]:'';
        $username=isset($_POST["username"])?$_POST["username"]:'';
        $password=isset($_POST["password"])?$_POST["password"]:'';
        //$foto=isset($_POST["foto"])?$_POST["foto"]:'';
        //$foto=$utilizador['foto'];
        $foto=$_FILES["fileToUpload"]["name"]!=""?"fotos/"."perfil_".$_SESSION["username"].".jpg":$_POST["foto"];
        $genero=isset($_POST["genero"])?$_POST["genero"]:'';
    
        //criar o update na base de dados
        $smt=$pdo->prepare('UPDATE utilizadores SET  nome=?,dataNasc=?,email=?,username=?,foto=?,genero=? WHERE username=?');
        $smt->execute([$nome,$dataNasc,$email,$username,$foto,$genero,$_SESSION["username"]]);
        $msg="Registo alterado com sucesso";
        




header('Location: perfil.php');
?>
