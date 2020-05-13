<?php
    include ('server.php');
    $db = mysqli_connect('localhost','root','','workout');
    
    $key=$_GET['key'];
    
	// Passa o campo contaAtivada de 0 para 1
    $query="UPDATE utilizadores set contaAtivada=1 WHERE chave='$key'";
	$result = mysqli_query($db,$query);
	if (!$result){
        exit("Não foi possível ativar a conta");
	}else{
		header('location: login.php?status=activated');
	}
?>