<!Doctype HTML>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $title ?></title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>

<body>
    <nav>
        <?php
        if (isset($_SESSION['username']) && $_SESSION['tipoUtilizador'] == 0) {
            echo
                '<div class="logo">
            <div><a href="index.php"><img src="img\workout_ico.png"></a></div>
        </div> 
        <ul class="nav-links">
            <li><a href="meustreinos.php" >Os Meus Treinos</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="tprofessor.php">Tornar Professor</a></li>
            <li><a href="index.php?logout" style="color:red";>Logout</a></li>
        </ul>';
        }else if (isset($_SESSION['tipoUtilizador']) && $_SESSION['tipoUtilizador']==2) {
            echo
            '<div class="logo">
            <div><a href="index.php"><img src="img\workout_ico.png"></a></div>
        </div> 
        <ul class="nav-links">
            <li><a href="adminpage.php" >Página Admin</a></li>
            <li><a href="meustreinos.php" >Os Meus Treinos</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="index.php?logout" style="color:red";>Logout</a></li>
        </ul>';
        } 

        else {
            echo
                '<div class="logo">
        <div><a href="index.php"><img src="img\workout_ico.png"></a></div>
        </div> 
        <ul class="nav-links">
                <li><a href="#tipos_treinos" >Tipos Treinos</a></li>
                <li><a href="#exemplos_treinos">Exemplos Treinos</a></li>
                <li><a href="registo.php">Registo</a></li>
                <li class="login"><a href="login.php">Login</a></li>
        </ul>';
        }

        echo
            '<div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>';
        ?>
    </nav>