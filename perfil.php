<?php

//In your "php.ini" file, search for the file_uploads directive, and set it to On:
//file_uploads = On

include 'database.php';
include 'server.php';
include "cabecalho.php";


$msg="";
//testar base de dados, recebe do link

if(isset($_SESSION["username"]))
{
//verificar se o formulário foi submetido 
  
    
    //retirar os valores da base de dados associados ao nosso identificador
    $smt=$pdo->prepare('SELECT * FROM utilizadores WHERE username=?');
    $smt->execute([$_SESSION["username"]]);
    $utilizador=$smt->fetch(PDO::FETCH_ASSOC);
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

<div class="contentPerfil">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <table>
            <thead>
                <h2>O meu perfil</h2> 
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="image-upload">
                            <label for="fileToUpload"  class="futilizador">
                                <img src="<?=$utilizador['foto']?>"/>
                            </label>
                            <p class="label">Alterar Foto</p>
                            <input type="file" id="fileToUpload" name="fileToUpload" />
                            <input type="hidden" name="foto" id="foto" value="<?=$utilizador['foto']?>">
                            
                        </div>
                        
                        
                    </td>
                    
                </tr>
                <tr>
                    <td class="hidden">
                        <label for="username">Username</label>
                    </td>
                    <td>
                        <label for="user"><?=$utilizador['username']?></label>
                        <input type="hidden" name="username" placeholder="Username" value="<?=$utilizador['username']?>" id="username">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nome">Nome</label>
                    </td>
                    <td>
                        <input type="text" name="nome" placeholder="Nome" value="<?=$utilizador['nome']?>" id="nome">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Email" value="<?=$utilizador['email']?>" id="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <form action="mudarPass.php">
                            <button onclick="location.href='mudarPass.php'" class="enviar" type="button">MUDAR A PASS</button>
                        </form>
                    </td>
                </tr>
                    <tr>
                        
                            <?php
                            if($utilizador['genero'] == 'm')
                            {
                                echo '<td>';
                                    echo '<input type="radio" name="genero" id="genero" value="m" checked="checked"> Masculino';
                                echo '</td>';
                                echo '<td>';
                                    echo '<input type="radio" name="genero" id="genero" value="f"> Feminino'; 
                                echo '</td>';
                            }else {     
                                echo '<td>';                      
                                    echo '<input type="radio" name="genero" id="genero" value="m"> Masculino';
                                echo '</td>';
                                echo '<td>';
                                    echo '<input type="radio" name="genero" id="genero" value="f" checked="checked"> Feminino';
                                echo '</td>';
                            }
                            ?>
                        
                    </tr>
                <tr>
                    <td>
                        <label for="dataNasc">Data de Nascimento</label>
                    </td>
                    <td>
                        <input type="date" id="dataNasc" name="dataNasc" value="<?=$utilizador['dataNasc']?>">
                        <script src="js/today.js"></script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Guardar" class="enviar">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>