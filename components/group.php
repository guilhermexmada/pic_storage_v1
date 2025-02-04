<?php
//COMPONENTE DE VISUALIZAÇÃO EM LISTA DOS ÁLBUNS DO USUÁRIO
include('../conexao/conn.php');

//CAPTURANDO ID DO USUÁRIO
$id = $_SESSION['log_key'];

//CAPTURANDO EMAIL DO USUÁRIO
$src_email = "SELECT email FROM usuarios WHERE id = '$id';";
$result = mysqli_query($conn, $src_email);
$rows = mysqli_fetch_assoc($result);
$email = $rows['email'];

//SELECIONANDO TODOS OS ÁLBUNS MENOS O GERAL
$sql = "SELECT * FROM grupos WHERE email_usuario = '$email' AND nome != 'general';";
$res = mysqli_query($conn, $sql);

//LISTANDO OS ÁLBUNS
while ($rw = mysqli_fetch_assoc($res)) {

    $src_img = mysqli_query($conn, "SELECT caminho FROM imagens WHERE id_grupo = '" . $rw['id'] . "' ORDER BY id DESC LIMIT 3;");

    echo "
         <button class='group' 
        onclick='openGroup(" . json_encode($rw['id']) . ")' 
        id='" . $rw['id'] . "'
        style='background-image: url(" . $rw['caminho_ultima_imagem'] . "); box-shadow: 2px 2px 2px " . $rw['cor'] . " '> ";
    while ($rw_img = mysqli_fetch_assoc($src_img)) {
        echo "<img class='group-history' src='" . $rw_img['caminho'] . "'>";
    }
    echo "       
    <p>" . $rw['nome'] . "</p>
    </button>
    ";
}
