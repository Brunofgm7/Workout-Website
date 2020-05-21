<?php

include 'cabecalho.php';
include 'database.php';
include 'server.php';
$msg="";

?>

<body>
<script src="js/app.js"></script>

    <div class="registo_form" >
        <table>
            <thead>
                <h2>Registo</h2> 
            </thead>
            <tr>
                <?php include('errors.php'); ?>
                <form action="registo.php" method="post">
                <td>
                    <label for="username">Username</label>
                </td>
                <td>
                    <input type="text" name="username" placeholder="Username" id="username">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nome">Nome</label>
                </td>
                <td>
                    <input type="text" name="nome" placeholder="Nome" id="nome">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email</label>
                </td>
                <td>
                    <input type="email" name="email" placeholder="Email" id="email">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                </td>
                <td>
                    <input type="password" placeholder="Password" name="password1" id="password1">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Repetir password</label>
                </td>
                <td>
                    <input type="password" placeholder="Repetir password" name="password2" id="password2">
                </td>
            </tr>  
            <tr>
                <td>
                    <label for="dataNasc">Data de Nascimento</label>
                </td>
                <td>
                    <input type="date" name="dataNasc" placeholder="Data de Nascimento" id="dataNasc">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="registo" class="registar">Registo</button>
                </td>
            </form>
            </tr>
            <tr >
                <td colspan="2">
                        <p> Já tem conta? <a href="login.php"><b>Fazer Login</b></a></p>
                    
                </td>
            </tr>
        </table>
    
    </div>
    <!-- <div class="copy"> -->
        <!-- <p>© Copyright - All Rights Reserved  </p>
    </div> -->
</body>

<?php if($msg):?>
    <p><?=$msg?></p>
<?php endif;?>
