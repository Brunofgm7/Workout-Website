<?php

include 'database.php';
include 'server.php';
include "cabecalho.php";

$id = $_GET['id'];

//testar base de dados, recebe do link

if(isset($_SESSION["username"])) {
//verificar se o formulário foi submetido 
  
    //retirar os valores da base de dados associados ao nosso identificador
    $smt=$pdo->prepare('SELECT * FROM treinos WHERE id=?');
    $smt->execute([$id]);
    $treino=$smt->fetch(PDO::FETCH_ASSOC);
    //se nao existir contacto com este ID

if(!$treino) {
    exit("treino inexistente.");
}
} else {
exit ("treino não definido.");
}


?>
<script src="js/app.js"></script>

<div class="contentPerfil">
    <form action="uploadtreino.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
        <table>
            <thead>
                <h2>Editar Treino</h2> 
            </thead>
            <tbody>
                <tr>
                    <td>
                        <label for="titulo">Nome</label>
                    </td>
                    <td>
                        <input class="input2" type="text" name="titulo" placeholder="Inserir nome" value="<?=$treino['titulo']?>" id="titulo">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="descricao">Descrição</label>
                    </td>
                    <td>
                        <input type="text" name="descricao" placeholder="Inserir descrição" value="<?=$treino['descricao']?>" id="descricao">
                    </td>
                </tr>
                <tr>  
                    <?php
                    echo '<td>';
                        ?><label for="dificuldade">Dificuldade</label><?php
                    echo '</td>';
                    if($treino['dificuldade'] == 'facil') {
                        echo '<td>';
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="facil" checked="checked">';?><label for="facil">Fácil</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="medio"> '; ?><label for="medio">Médio</label><?php
                            echo '<input type="radio" name="dificuldade" id="dificuldade" value="dificil"> '; ?><label for="dificil">Dificil</label><?php
                        echo '</td>';
                    } else if ($treino['dificuldade'] == 'medio') {     
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
                                <img src="<?=$treino['imagem']?>"/>
                            </label>
                            <p class="label">Alterar Foto</p>
                            <input type="file" id="fileToUpload" name="fileToUpload" />
                            <input type="hidden" name="imagem" id="imagem" value="<?=$treino['imagem']?>">
                        </div>                       
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Editar Treino" class="enviar">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>