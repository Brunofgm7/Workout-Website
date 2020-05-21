<?php
//criar funcao
function template_header($title)
{
  echo <<<EOT
//   <!Doctype HTML>
//   <head>
//       <meta charset="utf-8"/>
//       <meta name="viewport" content="width=device-width, initial-scale=1">
//       <title><?php $title ?></title>
//       <link href="css/style.css" type="text/css" 
//       rel="stylesheet"/>
//       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
//       <script type="text/javascript" src="js/app.js"></script>
//   </head>
//   <body>
//   <nav>
//       <div class="logo">
//           <div><a href="index.php"><img src="img\workout_ico.png"></a></div>
//       </div> 
//       <ul class="nav-links">
//               <li><a href="#tipos_treinos" >Tipos Treinos</a></li>
//               <li><a href="#exemplos_treinos">Exemplos Treinos</a></li>
//               <li><a href="registo.php">Registo</a></li>
//               <li class="login"><a href="login.php">Login</a></li>
//       </ul>
//       <div class="burger">
//           <div class="line1"></div>
//           <div class="line2"></div>
//           <div class="line3"></div>
//       </div>
//   </nav>
EOT;
}
function template_footer()
{
    echo <<<EOT
    </body>
    </html>
EOT;
}



?>