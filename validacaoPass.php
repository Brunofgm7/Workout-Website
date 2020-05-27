<?php
    include ('server.php');
    $db = mysqli_connect('localhost','root','','workout');
    
    $key=$_GET['key'];

    $_SESSION["key"]=$key;

?>


<body>
<script src="js/app.js"></script>

    <div>
        <h2>Nova palavra-passe</h2> 
        <form action="validacaoPass.php?key=<?=$_SESSION['key']?>" method="post">
            <?php include('errors.php'); ?>
            <br>
            <br>
            <input type="hidden" name="key" value="<?=$key?>">
            <label for="NovaPalavraPasse">Inserir nova palavra-passe</label>
            <input type="text" name="novaPalavraPasse" placeholder="Inserir nova palavra-passe" value="" id="novaPalavraPasse">
            <br>
            <br>
            <label for="RepetirNovaPalavraPasse">Repetir nova palavra-passe</label>
            <input type="text" name="RepetirNovaPalavraPasse" placeholder="Repetir nova palavra-passe" value="" id="RepetirNovaPalavraPasse">
            <br>
            <br>
            <button type="submit" name="validacaoPass">Guardar nova palavra-passe</button>
        </form>
    </div>
</body>