<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";
$db = mysqli_connect('localhost','root','','workout');


?>

<body>
<script src="js/app.js"></script>

    <div class="contentPass">
        <table>
            <thead>
                <h2>Adicionar Treino</h2>
            </thead>
            <tr>
                <form action="adicionarTreino.php" method="post">
                <?php include('errors.php'); ?>
                <td>
                    <label for="nomeTreino">Nome</label>
                </td>
                <td>
                    <input class="input2" type="text" name="nomeTreino" placeholder="Inserir nome" value="" id="nomeTreino">
                </td>
            </tr>
                <td colspan="2">
                    <button type="submit" name="adicionarTreino" class="enviar">Adicionar</button>
                </td>
            </tr>
        </form>
        </table>
    </div>
</body>