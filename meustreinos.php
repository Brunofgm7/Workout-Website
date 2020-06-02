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
                    <p style="font-size: 1.7vw;text-align:center;color:white">Treinos Criados</p>

                    <?php

                    $db = mysqli_connect('localhost', 'root', '', 'workout');

                    $user = $_SESSION['username'];
                    $query = "SELECT id FROM utilizadores WHERE username='$user'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_row($result);
                    $id = $row[0];

                    $sql = "SELECT * FROM treinos WHERE id_utilizador=$id";
                    if ($result = $db->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="nome_treino">
                                <a href="meustreinos.php?id=<?php echo $row["id"] ?>">
                                    <form action="meustreinos.php" method="post">
                                        <div class="dormir"><b><?php echo $row["titulo"] ?></b>
                                            <!-- <figure>
                                    <img src='<?php echo $row["imagem"] ?>' width="200" height="auto">
                                    <div class="desc" style="background-color:red"><p></p></div>
                                </figure>  -->
                                            <figure>
                                                <div class="nome_exercicio">

                                                    <div class="foto_treinos">
                                                        <img src='<?php echo $row["imagem"] ?>' width="200" height="auto">
                                                        <p style="font-size:17px;"><?php echo $row["descricao"] ?></p>
                                                    </div>

                                                </div>
                                            </figure>
                                </a>

                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="titulo" id="titulo" value="<?= $row['titulo'] ?>">
                                <a href="editarTreino.php?id=<?php echo $row["id"] ?>"><i style="font-size: 20px;" class="fa fa-pencil" aria-hidden="true"></i></a>
                                <button type="submit" name="apagarTreino" class="apagarButton"><i style="font-size: 20px;" class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                            </form>
                </div>
        <?php
                        }
                    }
        ?>

        <div>
            <p><a href="adicionarTreino.php"><i class="material-icons">add_circle</i></a></p>
            <!-- <a href="#" style="margin:auto;border-top:0px;">Novo Treino</a> -->
        </div>
</div>
<div class="meusTreinosRight">
    <?php
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM exercicios WHERE id_treino=$id";

        $username = $_SESSION['username'];
        $query = "SELECT id FROM utilizadores WHERE username='$username'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_row($result);
        $id_user = $row[0];


        $query = "SELECT * FROM treinos WHERE id_utilizador='$id_user' AND id='$id'";
        $result4 = mysqli_query($db, $query);
        if (mysqli_num_rows($result4) == 1) {

            if ($result = $db->query($sql)) {

                $query = "SELECT titulo FROM treinos WHERE id='$id'";
                $result3 = mysqli_query($db, $query);
                $row = mysqli_fetch_row($result3);
                $titulo = $row[0];

                $sql = "SELECT titulo FROM treinos WHERE id=$id";
                $result2 = mysqli_query($db, $query);
                if (mysqli_num_rows($result2) == 1) {
    ?>
                    <p class="titulo"> <?php echo $titulo ?></p>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>

                        <div class="nome_exercicio">
                            <p><?php echo $row["nome"] ?> -> <?php echo $row["series_rep"] ?> </p>
                            <figure>
                                <img src='<?php echo $row["imagem"] ?>' width="200" height="auto">
                            </figure>
                        </div>


            <?php
                    }
                }
            }
        } else {
            ?>
            <p style="font-size: 1.5vw" class="treino_inacessivel"><b>Treino inacessível</b></p>
        <?php
        }
        ?>
        <p style="padding-left:3%;"><a href="adicionarExercicio.php?id=<?php echo $id ?>"><i class="material-icons">add_circle</i></a></p> <?php
                                                                                                                                        } else {
                                                                                                                                            ?>
        <p class="NoTreino">Selecione ou crie um treino</p>
    <?php
                                                                                                                                        }
    ?>
</div>
</td>
</tr>
</table>
</div>

<script type="text/javascript">
    function changeTitle() {
        var person = prompt("Please enter your new title");

        if (person == null || person == "") {} else {
            document.getElementById("titulo").value = person;
        }
    }
</script>