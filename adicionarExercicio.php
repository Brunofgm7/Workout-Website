<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";
$db = mysqli_connect('localhost', 'root', '', 'workout');
$id = $_GET['id'];

?>

<body>
    <script src="js/app.js"></script>

    <div class="contentPass">
        <table>
            <thead>
                <h2>Adicionar exercicio</h2>
            </thead>
            <tr>
                <form action="adicionarExercicio.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    <?php include('errors.php'); ?>
                    <td>
                        <label for="nomeExercicio">Nome</label>
                    </td>
                    <td>
                        <input class="input2" type="text" name="nomeExercicio" placeholder="Inserir nome" value="" id="nomeExercicio">
                    </td>
            </tr>
            <tr>
                <td>
                    <label for="repeticoes">Repetições</label>
                </td>
                <td>
                    <input class="input2" type="text" name="repeticoes" placeholder="Inserir número de repetições" value="" id="repeticoes">
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
            <input type="file" name="fileToUpload" id="fileToUpload" class="left">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="submit" name="adicionarExercicio" class="enviar">Adicionar</button>
        </td>
    </tr>
    </form>
    </table>
    </div>
</body>