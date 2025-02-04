<?php
//PROCESSAMENTO DO CADASTRO
include('../conexao/conn.php');
session_start();

//CAPTURANDO VARIÁVEIS DE CADASTRO
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);
$data = date('Y-m-d');
$hora = date('H:i:s');

//VERIFICANDO SE REGISTRO JÁ EXISTE OU NÃO
$vef = "SELECT * FROM usuarios WHERE email = '$email';";
$result = mysqli_query($conn, $vef);
$rows = mysqli_fetch_assoc($result);

if ($rows != null) {
    header('Location: ../front/cadastro.php?erro=true');
} else {
    //INSERINDO NO BANCO DE DADOS
    $sql = "INSERT INTO usuarios (nome, email, senha, data_cadastro, hora_cadastro) VALUES ('$nome', '$email', '$senha', '$data', '$hora')";
    $conn->query($sql);

    //VERIFICANDO SE USUÁRIO EXISTE
    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha';";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    //CRIANDO VARIÁVEIS DE SESSÃO (SUCESSO, ID E NOME)
    $_SESSION['log'] = true;
    $_SESSION['log_key'] = $rows['id'];
    $_SESSION['log_name'] = $rows['nome'];

    //INSERINDO ÁLBUM GERAL DO USUÁRIO
    $grp = "INSERT INTO grupos (email_usuario, nome, data_criado, hora_criado) 
    VALUES ('$email','general','$data','$hora')";
    $conn->query($grp);

    //REDIRECIONANDO PARA TELA PRINCIPAL
    $conn->close();
    header('Location: ../front/main.php');
}
