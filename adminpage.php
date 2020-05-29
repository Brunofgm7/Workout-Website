<?php

//In your "php.ini" file, search for the file_uploads directive, and set it to On:
//file_uploads = On

include 'database.php';
include 'server.php';
include "cabecalho.php";


if (isset($_SESSION['tipoUtilizador']) && $_SESSION['tipoUtilizador']==2){

}else{
	header('location: index.php');
}
?>

<script src="js/app.js"></script>
<div class="contentAdminPage">
	
	<table>
        <thead>
        	Candidaturas
        	<th>#</th>
        	<th>Username</th>
        	<th>Certificado</th>
        	<th></th>
        	<th></th>
        </thead>
        <tbody>
    		<?php
    		$db = mysqli_connect('localhost','root','','workout');

    		$sql = "SELECT * FROM certificado WHERE aprovado=0";
    		$i=0;
    		if($result = $db->query($sql)) {
        		while($row = $result->fetch_assoc()) {
        			$i+=1;
        		?>
        
            		<tr>
            			<form action="server.php" method="post">
                		<td><b><?php echo $i ?></b></td>
                		<td><?php echo $row["username"] ?></td>
                		<td><a href="<?= $row["certificado"]?>" download>Download</a></td>
                		<input type="hidden" id="username" name="username" value="<?=$row['username']?>">
                		<input type="hidden" id="email" name="email" value="<?=$row['email']?>">
                		<td><input type="submit" value="Aceitar" class="enviar" name="manageCandidatura"></td>
                		<td><input type="submit" value="Rejeitar" class="enviar" name="manageCandidatura"></td>
                		</form>
            		</tr> 
        
        		<?php
        		}
    		}
    		if(mysqli_num_rows($result) == 0){
    			?>
    		<tr>
    			<td colspan="5">Não há candidaturas novas.</td>
    		</tr>

    		<?php
    		}
    		?>
    	</tbody>
    </table>
	
</div>