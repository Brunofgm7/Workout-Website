<?php
include 'database.php';
include 'server.php';


$_SESSION["certificado"]=0;
$target_dir = "candidaturas/";
$filename = basename($_FILES["file"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
if($FileType!="pdf"){
	$uploadOk = 0;
}

if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
}else{
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $filename.".tmp")) 
		{
    		copy($filename.".tmp", $target_dir."cand_".$_SESSION["username"]."_".$filename);
    		unlink($filename.".tmp");
    		echo "The file '".$filename."' was uploaded.";
    		$_SESSION["certificado"]=1;
		}
	}
$email=isset($_POST["email"])?$_POST["email"]:'';
$username=isset($_POST["username"])?$_POST["username"]:'';
$certificado=$uploadOk==1?$target_dir."cand_".$_SESSION["username"]."_".$filename:'';
$aprovado=0;
    
//criar o update na base de dados
$smt=$pdo->prepare('INSERT INTO certificado (username,email,certificado,aprovado) VALUES (?,?,?,?)');
$smt->execute([$username,$email,$certificado,$aprovado]);
$msg="Registo alterado com sucesso";

header('Location: perfil.php');


?>