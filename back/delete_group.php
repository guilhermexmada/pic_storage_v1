<?php
//PROCESSAMENTO DA DELEÇÃO DE ÁLBUM ou GRUPO
include('../conexao/conn.php');
session_start();

//CAPTURANDO ID DO ÁLBUM
$id_grupo = $_GET['grupo'];

//APAGANDO ARQUIVOS DAS IMAGENS
$src = "SELECT caminho FROM imagens WHERE id_grupo = '$id_grupo';";
$exec_src = mysqli_query($conn, $src);
while($rows_src = mysqli_fetch_assoc($exec_src)){
    unlink($rows_src['caminho']);    
}

//EXCLUINDO IMAGENS DO GRUPO
$sql = "DELETE FROM imagens WHERE id_grupo = '$id_grupo'";
$result = mysqli_query($conn, $sql);

//EXCLUINDO GRUPO
$sql2 = "DELETE FROM grupos WHERE id = '$id_grupo'";
$result2 = mysqli_query($conn, $sql2);


if($result == false || $result2 == false){
    $conn->close();
    //RETORNANDO ERRO DE DELEÇÃO
    header("Location: ../front/visualizacao_grupo.php?grupo=$nome_grupo&erro=falha_delete");
    exit;
} else if ($result == true && $result2 == true){
    $conn->close();
    header("Location: ../front/main.php");
    exit;
}
