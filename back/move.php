<?php
//PROCESSAMENTO DA TROCA DE ÁLBUM DE UMA IMAGEM
include('../conexao/conn.php');

//CAPTURANDO ID DO GRUPO DESTINATÁRIO E ID DA IMAGEM
$novo_grupo = $_POST['novo_grupo'];
$id_imagem = $_POST['id'];

//ATUALIZANDO GRUPO DA IMAGEM
$sql = "UPDATE imagens SET id_grupo = '$novo_grupo' WHERE id = '$id_imagem';";
$result = mysqli_query($conn, $sql);


if($result == false){
    $conn->close();
    //RETORNANDO ERRO NA TROCA DE ÁLBUM
    header("Location: ../front/visualizacao_imagem.php?id=$id_imagem&erro=falha_move");
    exit;
} else if($result == true){
    $conn->close();
    header("Location: ../front/main.php");
    exit;
}