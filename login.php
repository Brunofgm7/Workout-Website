<?php

include 'cabecalho.php';
include 'database.php';
include 'server.php';

if(isset($_SESSION['username'])){
    header('location:index.php');
}

?>

<body>
<script src="js/app.js"></script>

    <div class="contentLogin">
    <table>
        <thead>
            <h2>Login</h2>
        </thead> 
        <tr>        
            <?php include('errors.php'); ?>
            <form action="login.php" method="post">
            <td>
                <label for="username">Username</label>
            </td>
            <td>
                <input class="input2" type="text" name="username" placeholder="Username" value="" id="username">
            </td> 
        </tr>
        <tr>
            <td>
                <label for="password">Password</label>
            </td>
            <td>
                <input class="input2"type="password" placeholder="Password" name="password" id="password">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" name="login" class="enviar">Login</button>
            </td>
        </tr>
        </form>
    </table>
        <div class="login_text">
            <p> Ainda não tem conta? <a href="registo.php"><b>Fazer Registo</b></a></p>
            <p> Esqueceu-se da palavra-passe? <a href="recuperar.php"><b>Recuperar Password</b></a></p>
        </div>
        <?php 
        if(empty($_GET)):
        elseif($_GET['status'] == 'success'):
            echo 'Foi enviado um email de confirmação!';
        elseif($_GET['status'] == 'activated'):
            echo 'Conta ativada com sucesso!';
        elseif($_GET['status'] == 'pass'):
            echo 'Pedido de recuperação de palavra-passe enviado!';
        elseif($_GET['status'] == 'novapass'):
            echo 'Palavra-passe alterada com sucesso!';
        endif;
        ?> 
    </div>
</body>