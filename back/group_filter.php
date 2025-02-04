<?php 
//FILTRAGEM DA BARR DE BUSCA DE IMAGENS DENTRO DE UM ÁLBUM
include('../conexao/conn.php');
session_start();

//CAPTURANDO ID DO GRUPO
$grupo = $_POST['grupo'];

//VERIFICANDO SE O USUÁRIO USOU A BARRA DE BUSCA DO GRUPO
if(isset($_POST['busca']) && $_POST['busca'] != ''){
    $busca = $_POST['busca'];
    $_SESSION['filtro'] = "$busca";
} else if(!isset($_POST['busca']) || $_POST['busca'] == ''){
    $busca = '';
    unset($_SESSION['filtro']);
}

//A VARIÁVEL DE SESSÃO FILTRO É USADA NOS COMPONENTES DA PÁGINA PRINCIPAL E DA PÁGINA DE GRUPOS/ÁLBUNS

header('Location: ../front/visualizacao_grupo.php?grupo='.$grupo.'&busca='.$busca.'');


/*
echo $busca;
echo $_SESSION['filtro'];
*/