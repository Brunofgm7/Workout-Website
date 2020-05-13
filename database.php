<?php
//definir variaveis
$DATABASE_HOST="localhost";
$DATABASE_NAME="workout";
$DATABASE_USER="root";
$DATABASE_PASS="";
$DATABASE_PORT=3306;
$ligacao="mysql:host=".$DATABASE_HOST.";dbname=".$DATABASE_NAME.";port=".$DATABASE_PORT.";charset=utf8";
try{
    $pdo = new PDO($ligacao,$DATABASE_USER,$DATABASE_PASS);
   // echo "sucesso";
}
catch(PDOException $ex)
{
echo "erro" .$ex;
}
?>