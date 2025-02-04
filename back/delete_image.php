<?php
//PROCESSAMENTO DE DELEÇÃO DE IMAGEM
include('../conexao/conn.php');
session_start();

//CAPTURANDO ID DA IMAGEM
$id_imagem = $_GET['id'];

//MUDANDO IMAGEM DE CAPA DO ÁLBUM
$src_grp = mysqli_query($conn, "SELECT id_grupo FROM imagens WHERE id = '$id_imagem';");
$grp = mysqli_fetch_assoc($src_grp);
$grupo = $grp['id_grupo'];

$src_capa = mysqli_query($conn, "SELECT caminho, id FROM imagens WHERE id_grupo = '$grupo' ORDER BY id DESC LIMIT 2;");

$i = 0;
while($capa = mysqli_fetch_array($src_capa)){
    //echo $capa['caminho'];
    if($i == 1){
        $nova_capa = $capa['caminho'];
    }
    $i++;
}

$upd = mysqli_query($conn, "UPDATE grupos SET caminho_ultima_imagem = '$nova_capa' WHERE id = '$grupo';");

//COLETANDO CAMINHO DA IMAGEM
$src = "SELECT caminho FROM imagens WHERE id = '$id_imagem'";
$exec_src = mysqli_query($conn, $src);
$res_src = mysqli_fetch_assoc($exec_src);
$way = $res_src['caminho'];

//APAGANDO ARQUIVO DE IMAGEM
unlink($way);

//DELETANDO IMAGEM DO BANCO
$sql = "DELETE FROM imagens WHERE id = '$id_imagem'";
$result = mysqli_query($conn, $sql);


if ($result == false) {
    $conn->close();
    //RETORNANDO ERRO DE DELEÇÃO DA IMAGEM
    header("Location: ../front/visualizacao_imagem.php?id=$id_imagem&erro=falha_delete");
    exit;
} else if ($result == true) {
    $conn->close();
    header("Location: ../front/main.php");
    exit;
}
