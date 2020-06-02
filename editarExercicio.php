<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";

$id = $_GET['id'];

//testar base de dados, recebe do link

if(isset($_SESSION["username"])) {
//verificar se o formulário foi submetido 
  
    //retirar os valores da base de dados associados ao nosso identificador
    $smt=$pdo->prepare('SELECT * FROM exercicios WHERE id_exerc=?');
    $smt->execute([$id]);
    $exercicio=$smt->fetch(PDO::FETCH_ASSOC);
    //se nao existir contacto com este ID

if(!$exercicio) {
    exit("treino inexistente.");
}
} else {
exit ("treino não definido.");
}


?>
<script src="js/app.js"></script>

<div class="contentPerfil">
    <form action="uploadexercicio.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
        <table>
            <thead>
                <h2>Editar Exercicio</h2> 
            </thead>
            <tbody>
                <tr>
                    <td>
                        <label for="titulo">Nome</label>
                    </td>
                    <td>
                        <input class="input2" type="text" name="nome" placeholder="Inserir nome" value="<?=$exercicio['nome']?>" id="nome">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="series_rep">Repetições</label>
                    </td>
                    <td>
                        <input type="text" name="series_rep" placeholder="Inserir repetições" value="<?=$exercicio['series_rep']?>" id="series_rep">
                    </td>
                </tr>
                <tr>  
                    <?php
                    echo '<td>';
                        ?><label for="dificuldade">Dificuldade</label><?php
                    echo '</td>';
                    if($exercicio['dificuldade'] == 'facil') {
                        echo '<td>';
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="facil" checked="checked">';?><label for="facil">Fácil</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="medio"> '; ?><label for="medio">Médio</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="dificil"> '; ?><label for="dificil">Dificil</label><?php
                        echo '</td>';
                    } else if ($exercicio['dificuldade'] == 'medio') {     
                        echo '<td>';
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="facil">';?><label for="facil">Fácil</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="medio" checked="checked"> '; ?><label for="medio">Médio</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="dificil"> '; ?><label for="dificil">Dificil</label><?php
                        echo '</td>';
                    } else {
                        echo '<td>';
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="facil"> ';?><label for="facil">Fácil</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="medio"> '; ?><label for="medio">Médio</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="dificil" checked="checked"> '; ?><label for="dificil">Dificil</label><?php
                        echo '</td>';
                    }
                    ?>

  
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="image-upload">
                            <label for="fileToUpload"  class="futilizador">
                                <img src="<?=$exercicio['imagem']?>"/>
                            </label>
                            <p class="label">Alterar Foto</p>
                            <input type="file" id="fileToUpload" name="fileToUpload" />
                            <input type="hidden" name="imagem" id="imagem" value="<?=$exercicio['imagem']?>">
                        </div>                       
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Editar Exercicio" class="enviar">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>