<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";

if (isset($_SESSION["username"])) {
    //verificar se o formulário foi submetido 


    //retirar os valores da base de dados associados ao nosso identificador
    $smt = $pdo->prepare('SELECT * FROM utilizadores WHERE username=?');
    $smt->execute([$_SESSION["username"]]);
    $utilizador = $smt->fetch(PDO::FETCH_ASSOC);
    //se nao existir contacto com este ID

    if (!$utilizador) {
        exit("utlizador inexistente.");
    }
} else {
    exit("utilizador não definido.");
}

?>
<script src="js/app.js"></script>

<div class="contentMeusTreinos">
    <table>
        <thead>
            <h2>Meus Treinos</h2> 
        </thead>
        <tr>
            <td>
                <div class="meusTreinosLeft">
                    <p>Treinos Criados</p>
                    <div>
                        <a href="adicionarTreino.php" ><i class="material-icons">add_circle</i></a>
                        <!-- <a href="#"  style="margin:auto;border-top:0px;">Novo Treino</a> -->
                    </div>
                </div>
                <div class="meusTreinosRight">
                    <p>Treino #</p>
                    <a href="adicionarExercicio.php"><i class="material-icons">add_circle</i></a>
                </div>
            </td>
        </tr>
    </table>
</div>