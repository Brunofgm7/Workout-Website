<?php
if(isset($_SESSION['username'])){
?>
    <div class="footer">
        <div class="inner_footer">
            <div class="logo_container">
                <img src="img\ismai2.png" alt="">
            </div>

            <div class="outro">
                <h1>Começe já!</h1>
                <strong><a href="meustreinos.php" class="myButton">Meus treinos</a></strong>
            </div>
        </div>
    </div>

    <div class="copy">
        <p>© Copyright - All Rights Reserved  </p>
    </div>
<?php
}else{
    ?>
    <div class="footer">
        <div class="inner_footer">
            <div class="logo_container">
                <img src="img\ismai2.png" alt="">
            </div>

            <div class="outro">
                <h1>Registe-se já!</h1>
                <strong><a href="registo.php" class="myButton">Registo</a></strong>
            </div>
        </div>
    </div>

    <div class="copy">
        <p>© Copyright - All Rights Reserved  </p>
    </div>
<?php
}
?>