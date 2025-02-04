<?php
//FUNÇÕES PARA REUTILIZAÇÃO
include('../conexao/conn.php');

//BUSCA EMAIL DO USUÁRIO USANDO ID E ARQUIVO DE CONEXÃO DO BANCO
function searchEmail($id_user, $connect){
    $cons = "SELECT email FROM usuarios WHERE id = '$id_user';";
    $res_cons = mysqli_query($connect, $cons);
    $rows_cons = mysqli_fetch_assoc($res_cons);
    $email_user = $rows_cons['email'];
    return $email_user;
}