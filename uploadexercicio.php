<?php
include 'database.php';
include 'server.php';

$id = $_GET['id'];

if(!empty($_POST)) {
    	$target_dir = "fotosTreinosExercicios/";
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
			rename($target_dir. $_FILES["fileToUpload"]["name"], $target_dir ."exercicio_".$titulo."_".$_SESSION["username"].".jpg");
		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}
    }
        
	$nome=isset($_POST["nome"])?$_POST["nome"]:'';
	$series_rep=isset($_POST["series_rep"])?$_POST["series_rep"]:'';
	$dificuldade=isset($_POST["dificuldade"])?$_POST["dificuldade"]:'';
	$imagem=$_FILES["fileToUpload"]["name"]!=""?$target_dir."exercicio_".$nomeTreino."_".$_SESSION["username"].".jpg":$_POST["imagem"];


	//criar o update na base de dados
	$smt=$pdo->prepare('UPDATE exercicios SET nome=?,series_rep=?,dificuldade=?,imagem=? WHERE id_exerc=?');
	$smt->execute([$nome,$series_rep,$dificuldade,$imagem,$id]);
		
	$smt=$pdo->prepare('SELECT id_treino FROM exercicios WHERE id_exerc=?');
	$smt->execute([$id]);
	$aaa=$smt->fetch(PDO::FETCH_ASSOC);
	$id_treino=$aaa['id_treino'];

header('location: meustreinos.php?id='.$id_treino);


?>
