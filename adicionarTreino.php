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
                <form action="adicionarTreino.php" method="post" enctype="multipart/form-data">
                <?php include('errors.php'); ?>
                <td>
                    <label for="nomeTreino">Nome</label>
                </td>
                <td>
                    <input class="input2" type="text" name="nomeTreino" placeholder="Inserir nome" value="" id="nomeTreino">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="descricaoTreino">Descrição</label>
                </td>
                <td>
                    <input class="input2" type="text" name="descricaoTreino" placeholder="Inserir descrição" value="" id="descricaoTreino">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dificuldade">Dificuldade</label>
                </td>
                <td>
                    <input type="radio" id="dificuldade" name="dificuldade" value="facil" checked>
                        <label for="facil">Fácil</label>
                    </div>

                    <div>
                    <input type="radio" id="dificuldade" name="dificuldade" value="medio">
                        <label for="medio">Médio</label>
                    </div>

                    <div>
                        <input type="radio" id="dificuldade" name="dificuldade" value="dificil">
                        <label for="dificil">Difícil</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Selecione o ficheiro:
                </td>
                <td>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="adicionarTreino" class="enviar">Adicionar</button>
                </td>
            </tr>
        </form>
        </table>
    </div>
</body>