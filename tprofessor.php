<?php

//In your "php.ini" file, search for the file_uploads directive, and set it to On:
//file_uploads = On

include 'database.php';
include 'server.php';
include "cabecalho.php";

if(isset($_SESSION["username"]))
{
//verificar se o formulário foi submetido 
  
    
    //retirar os valores da base de dados associados ao nosso identificador
    $smt=$pdo->prepare('SELECT * FROM utilizadores WHERE username=?');
    $smt->execute([$_SESSION["username"]]);
    $utilizador=$smt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["email"] = $utilizador['email'];
    echo $_SESSION["email"];
    //se nao existir contacto com este ID

if(!$utilizador)
{
    exit("utlizador inexistente.");
}
}
else
{
exit ("utilizador não definido.");
}
?>

<script src="js/app.js"></script>

<div class="contentTProfessor">
	<table>
            <thead>
                <h2>Tornar-me Professor</h2> 
            </thead>
            <tbody>
            	<form action="uploadCertificado.php" method="post" enctype="multipart/form-data">
                <tr>
                    <td>
                        <label for="username">Username</label>
                    </td>
                    <td>
                        <label for="user"><?=$utilizador['username']?></label>
                        <input type="hidden" name="username" placeholder="Username" value="<?=$utilizador['username']?>" id="username">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                    	<label for="user"><?=$utilizador['email']?></label>
                        <input type="hidden" name="email" placeholder="Email" value="<?=$utilizador['email']?>" id="email">
                    </td>
                </tr>
                <tr>
                	<td>
    					Selecione o ficheiro (Apenas pdf):
    				</td>
    				<td>
    					<input type="file" name="file" id="file">
                	</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Enviar Certificado" class="enviar">
                    </td>
                </tr>
                </form>
            </tbody>
        </table>
</div>