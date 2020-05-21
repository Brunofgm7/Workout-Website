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
    <div class="meusTreinosLeft">
        <p>Treinos Criados</p>
    </div>
    <div class="meusTreinosRight">
        <p>Treino #</p>
    </div>
</div>