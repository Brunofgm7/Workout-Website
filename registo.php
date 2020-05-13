<?php

include 'cabecalho.php';
include 'database.php';
include 'server.php';
$msg="";

?>

<body>
<script src="js/app.js"></script>

    <div class="content registo">
        <h2>Registo</h2> 
        <form action="registo.php" method="post">
            <?php include('errors.php'); ?>
            <br>
            <br>

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" id="username">
            <br>
            <br>

            <label for="nome">Nome</label>
            <input type="text" name="nome" placeholder="Nome" id="nome">
            <br>
            <br>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" id="email">
            <br>
            <br>

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password1" id="password1">
            <br>
            <br>

            <label for="password">Repetir password</label>
            <input type="password" placeholder="Repetir password" name="password2" id="password2">
            <br>
            <br>

            <label for="dataNasc">Data de Nascimento</label>
            <input type="date" name="dataNasc" placeholder="Data de Nascimento" id="dataNasc">
            <br>
            <br>

            <button type="submit" name="registo">Registar</button>
        </form>

        <div>
            <p> Já tem conta? <a href="login.php"><b>Fazer Login</b></a></p>
        </div>
    </div>
</body>

<?php if($msg):?>
    <p><?=$msg?></p>
<?php endif;?>