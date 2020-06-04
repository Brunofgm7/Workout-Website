<?php
if(isset($_SESSION['certificado'])){
}else{
    $_SESSION['certificado'] = 0;
}


include "server.php";

include "cabecalho.php";

if(isset($_SESSION['username'])){
?>
<script src="js/app.js"></script>
<body class="bodyIndex">
    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

            <div class="container">
            <!-- <img class="img_home" src="..\img\home.jpg"/> -->
            <img class="img_home" src="img\home2.png"/>
            <div class="texto" id="tipos_treinos">  
                <br>
                <br>
            <h2>Tipos de Treinos</h2>   
            <p>Crie o seu treino especializado ou escolha um feito por um dos nossos excelentes pt's.</p>   
            <!--<p style="font-size: 20px;">Faça mais por si.</p>-->
            </div>
            <br>
            <br>
            <div class="treinos" >
                <div class="ol">
                    <div>
                        <div class="polaroid">
                            <img src="img\b1.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Peito</p></strong>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="polaroid">
                            <img src="img\b2.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Core</p></strong>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="polaroid">
                            <img src="img\b3.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Resistência</p></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <br>
            <br>
            <br>
            <div id ="exemplos_treinos"class="texto">  
                <br>
                <h2>Exemplos de Treinos</h2>   
                <p>Veja abaixo alguns exemplos de playlists.</p>   
            </div>
            <br>
            <br>

            <div class="ol" > 
                <div>
                    <div class="contai">
                        <img src="img\meus_treinos.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                        <a href="meustreinos.php" ><strong><p class="text">Workout</p></strong></a>
                        <!-- <img class ="nada" src="registo.jpg" alt="">-->
                        </div>
                    </div>
                </div>
                <div>   
                    <div class="contai">
                        <img src="img\treinos_outros.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                        <a href="meustreinos.php" ><strong><p class="text">Workout</p></strong></a>
                        <!-- <img class ="nada" src="registo.jpg" alt="">-->
                        </div>
                    </div>
                </div>
                <div class="texto_exe">
                    <p>
                        <strong> 
                            Clique na imagem e comece
                            já a personalizar os seus treinos e a criar as suas 
                            playlists unicas, para melhorar os seus treinos 
                            e melhorar a sua vida.
                        </strong>
                    </p>
                </div>
            </div>

            <br>
            <br>
            
        </div>

    </div>
<?php
}else{
    $_SESSION['tipoUtilizador'] = 0;
    ?>
    <script src="js/app.js"></script>
<body class="bodyIndex">
    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

            <div class="container">
            <!-- <img class="img_home" src="..\img\home.jpg"/> -->
            <img class="img_home" src="img\home2.png"/>
            <div class="texto" id="tipos_treinos">  
                <br>
                <br>
            <h2>Tipos de Treinos</h2>   
            <p>Crie o seu treino especializado ou escolha um feito por um dos nossos excelentes pt's.</p>   
            <!--<p style="font-size: 20px;">Faça mais por si.</p>-->
            </div>
            <br>
            <br>
            <div class="treinos" >
                <div class="ol">
                    <div>
                        <div class="polaroid">
                            <img src="img\b1.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Peito</p></strong>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="polaroid">
                            <img src="img\b2.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Core</p></strong>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="polaroid">
                            <img src="img\b3.jpg" alt="">
                            <div class="con">
                                <strong><p>Treinos de Resistência</p></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <br>
            <br>
            <br>
            <div id ="exemplos_treinos"class="texto">  
                <br>
                <h2>Exemplos de Treinos</h2>   
                <p>Veja abaixo alguns exemplos de playlists.</p>   
            </div>
            <br>
            <br>

            <div class="ol" > 
                <div>
                    <div class="contai">
                        <img src="img\meus_treinos.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                        <a href="registo.php" ><strong><p class="text">Registo</p></strong></a>
                        <!-- <img class ="nada" src="registo.jpg" alt="">-->
                        </div>
                    </div>
                </div>
                <div>   
                    <div class="contai">
                        <img src="img\treinos_outros.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                        <a href="registo.php" ><strong><p class="text">Registo</p></strong></a>
                        <!-- <img class ="nada" src="registo.jpg" alt="">-->
                        </div>
                    </div>
                </div>
                <div class="texto_exe">
                    <p>
                        <strong> 
                            Clique na imagem e comece
                            já a personalizar os seus treinos e a criar as suas 
                            playlists unicas, para melhorar os seus treinos 
                            e melhorar a sua vida.
                        </strong>
                    </p>
                </div>
            </div>

            <br>
            <br>
            
        </div>

    </div>
    <?php
}

// se nao tiver logado nao consegue aceder a esta pagina
// if (empty($_SESSION['username'])) {
//     header('location: login.php?status=insuccess');
// }

?>

<?php 

include "footer.php";

?>