<?php
//FILTRAGEM DA BARRA DE BUSCA DE IMAGENS
include('../conexao/conn.php');
session_start();

//VERIFICANDO SE O USUÁRIO USOU A BARRA DE BUSCA
if(isset($_POST['busca']) && $_POST['busca'] != ''){
    $busca = $_POST['busca'];
    $_SESSION['filtro'] = "$busca";
} else if(!isset($_POST['busca']) || $_POST['busca'] == ''){
    $busca = '';
    unset($_SESSION['filtro']);
}

//A VARIÁVEL DE SESSÃO FILTRO É USADA NOS COMPONENTES DA PÁGINA PRINCIPAL E DA PÁGINA DE GRUPOS/ÁLBUNS

header('Location: ../front/main.php?busca='.$busca.'');


/*
echo $busca;
echo $_SESSION['filtro'];
*/