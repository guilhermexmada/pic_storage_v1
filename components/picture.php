<?php
//COMPONENTE DE VISUALIZAÇÃO EM LISTA DAS IMAGENS DO ÁLBUM GERAL
include('../conexao/conn.php');

//CAPTURANDO ID DO USUÁRIO
$id = $_SESSION['log_key'];

//CAPTURANDO EMAIL DO USUÁRIO
$src_email = "SELECT email FROM usuarios WHERE id = '$id';";
$result = mysqli_query($conn, $src_email);
$rows = mysqli_fetch_assoc($result);
$email = $rows['email'];

//CAPTURANDO ID DO GRUPO GERAL DO USUÁRIO
$src_id = "SELECT id FROM grupos WHERE nome = 'general' AND email_usuario = '$email';";
$exec_src_id = mysqli_query($conn, $src_id);
$rows_id = mysqli_fetch_assoc($exec_src_id);
$id_general = $rows_id['id'];

//APLICANDO FILTRO CASO ELE EXISTA
if (isset($_SESSION['filtro'])) {
    $filtro = $_SESSION['filtro'];
    $sql = "SELECT * FROM imagens WHERE email_usuario = '$email' AND id_grupo = '$id_general' AND descricao = '$filtro' ;";
} else{
    $filtro = "";
    $sql = "SELECT * FROM imagens WHERE email_usuario = '$email' AND id_grupo = '$id_general' ;";
}


$res = mysqli_query($conn, $sql);   

//LISTANDO IMAGENS DO GRUPO GERAL
while ($rw = mysqli_fetch_assoc($res)) {
    echo "
        <button class='picture' 
        onclick='openImage(" . $rw['id'] . ")' 
        id='" . $rw['id'] . "'
        style='background-image: url(" . $rw['caminho'] . ")'>
        </button>
        
    ";
}

// $sql . "<br>";
//echo $filtro;
