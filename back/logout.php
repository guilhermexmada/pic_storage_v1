<?php
//PROCESSAMENTO DO LOGOUT DO USUÁRIO
    include '../conexao/conn.php';
    session_start();

    //DESTRUINDO VARIÁVEIS DE SESSÃO DO USUÁRIO (DESLOGADO, NOME E ID)
    unset($_SESSION['log_name']);
    unset($_SESSION['log']);
    unset($_SESSION['log_key']);

    session_destroy();
    $conn->close();
    header('Location: ../front/login.php');
?>