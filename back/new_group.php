<?php
//PROCESSAMENTO DA CRIAÇÃO DE ÁLBUM ou GRUPO
include('../conexao/conn.php');
session_start();

//capturando dados do grupo
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$cor = mysqli_real_escape_string($conn, $_POST['cor']);

//capturando data e hora de criação
$data = date('Y-m-d');
$hora = date('H:i:s');

//capturando email do usuario
$src_email = "SELECT email FROM usuarios WHERE id = " . $_SESSION["log_key"] . " ; ";
$result = mysqli_query($conn, $src_email);
$rows = mysqli_fetch_assoc($result);
$email = $rows['email'];

//verificando se nome de grupo já existe na conta do usuário pelo email
$vef = "SELECT * FROM grupos WHERE nome = '$nome' AND email_usuario = '$email';";
$conf = mysqli_query($conn, $vef);
if(mysqli_num_rows($conf) > 0){
    $conn->close();
    header("Location: ../front/main.php?erro=grupo_existente");
    exit;
}

//inserindo grupo no banco de dados
$sql = "INSERT INTO grupos (nome, cor, email_usuario, data_criado, hora_criado)
    VALUES ('$nome','$cor','$email','$data','$hora');";

if ($conn->query($sql) === true) {
    $conn->close();
    header("Location: ../front/main.php");
    exit;
} else {
    echo "Oops! Algo deu errado.";
}
