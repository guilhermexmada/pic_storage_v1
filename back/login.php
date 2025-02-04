<?php
//PROCESSAMENTO DO LOGIN DO USUÁRIO
include '../conexao/conn.php';
session_start();

//CAPTURANDO VARIÁVEIS DE LOGIN
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

//VERIFICANDO SE USUÁRIO EXISTE
$sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

if ($rows != null) {
    //CRIANDO VARIÁVEIS DE SESSÃO (SUCESSO, ID E NOME)
    $_SESSION['log'] = true;
    $_SESSION['log_key'] = $rows['id'];
    $_SESSION['log_name'] = $rows['nome'];
    header('Location: ../front/main.php');
} else {
    $conn->close();
    //RETORNANDO ERRO DE LOGIN
    header('Location: ../front/login.php?erro=true');
}
