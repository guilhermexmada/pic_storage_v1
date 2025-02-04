<?php
//COMPONENTE DE VISUALIZAÇÃO EM LISTA DAS IMAGENS DE UM ÁLBUM
include('../conexao/conn.php');
include('../back/functions.php');

//CAPTURANDO ID DO ÁLBUM E DO USUÁRIO
$id = $_SESSION['log_key'];
$id_grupo = $_GET['grupo'];

//CAPTURANDO EMAIL DO USUÁRIO
$email = searchEmail($id, $conn);

//APLICANDO FILTRO DE IMAGENS CASO ELE EXISTA
if (isset($_SESSION['filtro'])) {
    $filtro = $_SESSION['filtro'];
    $sql = "SELECT * FROM imagens WHERE email_usuario = '$email' AND id_grupo = '$id_grupo' AND descricao = '$filtro' ;";
} else{
    $filtro = "";
    $sql = "SELECT * FROM imagens WHERE email_usuario = '$email' AND id_grupo = '$id_grupo' ;";
}
$res = mysqli_query($conn, $sql);

//LISTANDO AS IMAGENS DO GRUPO
while ($rw = mysqli_fetch_assoc($res)) {
    echo "
        <button class='picture' 
        onclick='openImage(".$rw['id'].")' 
        id='" . $rw['id'] . "'
        style='background-image: url(".$rw['caminho'].")'>
            
        </button>
    ";
}
