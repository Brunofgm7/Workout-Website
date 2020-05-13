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

    <div class="content login">
        <h2>Login</h2> 
        <?php 
        if(empty($_GET)):
        elseif($_GET['status'] == 'success'):
            echo 'Foi enviado um email de confirmação!';
        elseif($_GET['status'] == 'activated'):
            echo 'Conta ativada com sucesso!';
        endif;
        ?> 
        <form action="login.php" method="post">
            <?php include('errors.php'); ?>
            <br>
            <br>

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" value="" id="username">
            <br>
            <br>

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" id="password">
            <br>
            <br>

            <button type="submit" name="login">Login</button>
        </form>

        <div>
            <p> Ainda não tem conta? <a href="registo.php"><b>Fazer Registo</b></a></p>
        </div>
    </div>
</body>