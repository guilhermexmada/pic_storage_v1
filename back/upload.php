<?php
//PROCESSAMENTO DO UPLOAD DE NOVA IMAGEM
include '../conexao/conn.php';
session_start();

//CAPTURANDO VARIÁVEIS DA IMAGEM
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
$imagem = $_FILES['imagem'];
$grupo = $_POST['grupo'];


//VERIFICANDO ERRO NA SELEÇÃO
if ($imagem['error']) {
    header("Location: ../front/main.php?erro='falha_upload'");
    exit;
}

//TRATANDO IMAGEM
$pasta = "../pic_base/";
$nome_imagem = $imagem['name'];

//GERANDO NOVO NOME ÚNICO (PARA ARMAZENAR EM PASTA SEM GERAR DUPLICIDADE) E CAPTURANDO EXTENSÃO
$novo_nome_imagem = uniqid();
$extensao = strtolower(pathinfo($nome_imagem, PATHINFO_EXTENSION));

//VERIFICANDO EXTENSÃO
$extensoes_validas = ['jpg', 'jpeg', 'png'];
if (!in_array($extensao, $extensoes_validas)) {
    header("Location: ../front/main.php?erro=extensao_invalida");
    exit;
}

//MOVENDO PARA PASTA DEDICADA
$sucesso = move_uploaded_file($imagem['tmp_name'], $pasta . $novo_nome_imagem . "." . $extensao);

//---------------------INSERINDO INFORMAÇÕES NO BANCO DE DADOS---------------------------
$src_email = "SELECT email FROM usuarios WHERE id = " . $_SESSION["log_key"] . " ; ";
$result = mysqli_query($conn, $src_email);
$rows = mysqli_fetch_assoc($result);

$email = $rows['email'];
$data = date('Y-m-d');
$hora = date('H:i:s');
$caminho = $pasta . $novo_nome_imagem . "." . $extensao;

$sql = "INSERT INTO imagens (email_usuario, nome, descricao, caminho, id_grupo, data_upload, hora_upload) 
VALUES ('$email','$nome_imagem', '$descricao','$caminho', '$grupo' ,'$data','$hora');";



if ($sucesso && $conn->query($sql) === true) {
    //POSICIONANDO IMAGEM COMO CAPA DO SEU GRUPO
    $capa = "UPDATE grupos SET caminho_ultima_imagem = '$caminho' WHERE id = '$grupo';";
    $conn->query($capa);

    $conn->close();
    header("Location: ../front/main.php");
    exit;
} else {
    echo "Oops! Algo deu errado.";
}
