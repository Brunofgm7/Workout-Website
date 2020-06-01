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

                    <?php

                    $db = mysqli_connect('localhost','root','','workout');

                    $user = $_SESSION['username'];
                    $query = "SELECT id FROM utilizadores WHERE username='$user'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_row($result);
                    $id = $row[0];

                    $sql = "SELECT * FROM treinos WHERE id_utilizador=$id";
                    if($result = $db->query($sql)) {
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="nome_treino">
                        <a href="meustreinos.php?id=<?php echo $row["id"] ?>">
                            <b><?php echo $row["titulo"] ?></b>
                        </a>
                        </div>
                    <?php
                        }
                    }
                    ?>
                    
                    <div>
                        <a href="adicionarTreino.php" ><i class="material-icons">add_circle</i></a>
                        <!-- <a href="#" style="margin:auto;border-top:0px;">Novo Treino</a> -->
                    </div>
                </div>
                <div class="meusTreinosRight">
                    <?php
                        if(isset($_REQUEST['id'])){
                            $id = $_REQUEST['id'];
                            $sql = "SELECT * FROM exercicios WHERE id_treino=$id";

                            $username = $_SESSION['username'];
                            $query = "SELECT id FROM utilizadores WHERE username='$username'";
                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_row($result);
                            $id_user = $row[0];


                            $query = "SELECT * FROM treinos WHERE id_utilizador='$id_user' AND id='$id'";
                            $result4 = mysqli_query($db, $query);
                            if(mysqli_num_rows($result4) == 1) {

                                if($result = $db->query($sql)) {

                                    $query = "SELECT titulo FROM treinos WHERE id='$id'";
                                    $result3 = mysqli_query($db, $query);
                                    $row = mysqli_fetch_row($result3);
                                    $titulo = $row[0];

                                    $sql = "SELECT titulo FROM treinos WHERE id=$id";
                                    $result2 = mysqli_query($db, $query);
                                    if(mysqli_num_rows($result2) == 1) {
                                        ?>
                                        <p> <?php echo $titulo ?></p>
                                        <?php
                                        while($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="nome_exercicio">
                                            <p><?php echo $row["nome"]?></p>
                                            <figure>
                                                <img src='<?php echo $row["imagem"]?>' width="300" height="200">
                                            </figure>
                                        </div>
                                    <?php
                                        }
                                    }                            
                                } 
                            }else {
                                ?>
                                <p class="treino_inacessivel"><b>Treino inacessível</b></p>
                                <?php
                            }
                    ?>
                    <a href="adicionarExercicio.php?id=<?php echo $id ?>"><i class="material-icons">add_circle</i></a>                    <?php
                    } else {
                        ?> 
                        <p>Selecione ou crie um treino</p>
                        <?php
                    }
                    ?>
                </div>
            </td>
        </tr>
    </table>
</div>