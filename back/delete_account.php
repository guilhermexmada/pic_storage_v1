<?php
//PROCESSAMENTO DA DELEÇÃO DO USUÁRIO
//ORDEM DE DELEÇÃO: IMAGENS > GRUPOS > USUARIOS
include('../conexao/conn.php');
include('functions.php');
session_start();

//CAPTURANDO ID DO USUÁRIO
$id_conta = $_GET['id'];

//COLETANDO EMAIL DO USUÁRIO
$email = searchEmail($id_conta, $conn);

//APAGANDO TODOS OS ARQUIVOS DE IMAGENS DO USUÁRIO
$exc_arq = "SELECT caminho FROM imagens WHERE email_usuario = '$email';";
$arq = mysqli_query($conn, $exc_arq);
while ($rows_arq = mysqli_fetch_assoc($arq)) {
    unlink($rows_arq['caminho']);
}

//DELETANDO IMAGENS DO USUÁRIO
$del_img = mysqli_query($conn, "DELETE FROM imagens WHERE email_usuario = '$email';");

//DELETANDO GRUPOS DO USUÁRIO
$del_grp = mysqli_query($conn, "DELETE FROM grupos WHERE email_usuario = '$email';");

//DELETANDO CONTA DO USUÁRIO
$sql = "DELETE FROM usuarios WHERE id = '$id_conta'";
$result = mysqli_query($conn, $sql);

if ($result == false) {
    $conn->close();
    //RETORNANDO ERRO NA DELEÇÃO
    header("Location: ../front/configuracoes.php?erro=falha_delete_account");
    exit;
} else if ($result == true) {
    unset($_SESSION['log']);
    unset($_SESSION['log_key']);
    unset($_SESSION['log_name']);
    $conn->close();
    header("Location: ../front/login.php");
    exit;
}
