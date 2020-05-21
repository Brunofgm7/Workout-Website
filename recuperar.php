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

    <div class="contentRecuperar">
        <table>
            <thead>
                <h2>Esqueceu-se da palavra-passe?</h2>
            </thead>
            <tr>               
                <form action="recuperar.php" method="post">
                <?php include('errors.php'); ?>
                <td>
                    <label for="userEmail">Username/Email</label>
                </td>
                <td>
                    <input type="text" name="userEmail" placeholder="Username/Email" value="" id="userEmail">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="recuperar" class="enviar">Obter nova password</button>
                </td>
            </tr>
        </form>
        </table>
    </div>
</body>