<?php
    
include 'cabecalho.php';
include 'database.php';
include 'server.php';
    $db = mysqli_connect('localhost','root','','workout');
    
    $key=$_GET['key'];

    $_SESSION["key"]=$key;

?>


<body>
<script src="js/app.js"></script>

    <div class="validacaoPass">
        <table>
            <thead>
                <h2>Nova palavra-passe</h2> 
            </thead>
            <tr>
                <form action="validacaoPass.php?key=<?=$_SESSION['key']?>" method="post">
                <?php include('errors.php'); ?>
                <input type="hidden" name="key" value="<?=$key?>">
                <td>
                    <label for="NovaPalavraPasse">Inserir nova palavra-passe</label>
                </td>
                <td>
                    <input class="input2" type="text" name="novaPalavraPasse" placeholder="Inserir nova palavra-passe" value="" id="novaPalavraPasse">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="RepetirNovaPalavraPasse">Repetir nova palavra-passe</label>

                </td>
                <td>
                    <input class="input2"type="text" name="RepetirNovaPalavraPasse" placeholder="Repetir nova palavra-passe" value="" id="RepetirNovaPalavraPasse">

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="validar"type="submit" name="validacaoPass">Guardar nova palavra-passe</button>
                    </form>
                </td>
            </tr>  
        </table>
    </div>
</body>