<?php 
    //CONEXÃO COM BANCO DE DADOS LOCAL
    date_default_timezone_set('America/Sao_Paulo');
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "picstorage"; // <-- NOME DO BANCO DE DADOS

    $conn = mysqli_connect($server,$user,$password,$database);
?>