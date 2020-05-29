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
                <h2>Adicionar exercicio</h2>
            </thead>
            <tr>
                <form action="adicionarExercicio.php" method="post">
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
                    <input type="radio" id="facil" name="facil" value="facil">
                        <label for="facil">Fácil</label>
                    </div>

                    <div>
                    <input type="radio" id="medio" name="medio" value="medio">
                        <label for="medio">Médio</label>
                    </div>

                    <div>
                    <input type="radio" id="dificil" name="dificil" value="dificil">
                        <label for="dificil">Difícil</label>
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