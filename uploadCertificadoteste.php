<?php
include 'database.php';
include 'server.php';
include "errors.php";

$errors = array();

$_SESSION["certificado"]=0;
$target_dir = "candidaturas/";
$filename = basename($_FILES["file"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
if($FileType!="pdf"){
	$uploadOk = 0;
	array_push($errors, "Sorry, only PDF files");
}

if ($uploadOk == 0) {
	array_push($errors, "Sorry, your file was not uploaded.");
}else{
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $filename.".tmp")) 
		{
    		copy($filename.".tmp", $target_dir."cand_".$_SESSION["username"]."_".$filename);
    		unlink($filename.".tmp");
    		echo "The file '".$filename."' was uploaded.";
    		$_SESSION["certificado"]=1;

    		$email=isset($_POST["email"])?$_POST["email"]:'';
			$username=isset($_POST["username"])?$_POST["username"]:'';
			$certificado=$uploadOk==1?$target_dir."cand_".$_SESSION["username"]."_".$filename:'';
			$aprovado=0;
    


			$db = mysqli_connect('localhost','root','','workout');
			$username = mysqli_real_escape_string($db, $_POST['username']);
    		$query = "SELECT * FROM certificado WHERE username = '$username'";
        	$result = mysqli_query($db, $query);
        
        	if(mysqli_num_rows($result) == 0) {			
				$smt=$pdo->prepare('INSERT INTO certificado (username,email,certificado,aprovado) VALUES (?,?,?,?)');
				$smt->execute([$username,$email,$certificado,$aprovado]);
			}else{
				$smt1=$pdo->prepare('SELECT certificado FROM certificado WHERE username=?');
    			$smt1->execute([$_SESSION["username"]]);
    			$utilizador=$smt1->fetch(PDO::FETCH_ASSOC);
				unlink($utilizador["certificado"]);

				$smt=$pdo->prepare('UPDATE certificado SET email=?,certificado=? WHERE username=?');
				$smt->execute([$email, $certificado, $username]);				
			}
			header('Location: perfil.php');

		}
	}



?>