<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";

$msg="";
//testar base de dados, recebe do link

if(isset($_SESSION["username"]))
{
//verificar se o formulário foi submetido 
  
    if(!empty($_POST))
    {

        $id=isset($_POST["id"]) && !empty($_POST["id"]) && $_POST["id"]!='auto'? $_POST["id"]:NULL;
        $nome=isset($_POST["nome"])?$_POST["nome"]:'';
        $dataNasc=isset($_POST["dataNasc"])?$_POST["dataNasc"]:'';
        $email=isset($_POST["email"])?$_POST["email"]:'';
        $username=isset($_POST["username"])?$_POST["username"]:'';
        $password=isset($_POST["password"])?$_POST["password"]:'';
        $tipo=isset($_POST["tipoUtilizador"])?$_POST["tipoUtilizador"]:'';
        //$foto=isset($_POST["foto"])?$_POST["foto"]:'';
        //$foto=$utilizador['foto'];
        $genero=isset($_POST["genero"])?$_POST["genero"]:'';
    
        //criar o update na base de dados
        $smt=$pdo->prepare('UPDATE utilizadores SET id=?, nome=?,dataNasc=?,email=?,username=?,password=?,tipoUtilizador=?,genero=? WHERE username=?');
        $smt->execute([$id,$nome,$dataNasc,$email,$username,$password,$tipo,$genero,$_SESSION["username"]]);
        $msg="Registo alterado com sucesso";
    }
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

<div class="content perfil">
    <form action="perfil.php?>" method="post">
        <table>
            <caption>O meu perfil</caption>
            <tbody>
                <tr>
                    <td colspan="2">
                        <img src="<?=$utilizador['foto']?>" id="foto" name="foto" value="<?=$utilizador['foto']?>">
                    </td>
                </tr>
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
                        <input type="password" name="password" placeholder="Password" value="<?=$utilizador['password']?>" id="password">
                    </td>
                </tr>
                    <tr>
                        <td colspan="2">
                            <?php
                            if($utilizador['genero'] == 'm')
                            {
                                echo '<input type="radio" name="genero" id="genero" value="m" checked="checked"> Masculino';
                                echo '<input type="radio" name="genero" id="genero" value="f"> Feminino'; 
                            }
                            else {
                                echo '<input type="radio" name="genero" id="genero" value="m"> Masculino';
                                echo '<input type="radio" name="genero" id="genero" value="f" checked="checked"> Feminino';
                            }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dataNasc">Data de Nascimento</label>
                    </td>
                    <td>
                        <input type="date" id="dataNasc" name="dataNasc" value="<?=$utilizador['dataNasc']?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Guardar">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php if($msg):?>
    <p><?=$msg?></p>
<?php endif;?>