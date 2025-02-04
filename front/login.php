<?php
//PÁGINA DE LOGIN DO USUÁRIO
include('../conexao/conn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pic Storage</title>
    <link rel="stylesheet" href="../style/components.css">
    <link rel="stylesheet" href="../style/pages.css">
</head>

<body>
    <div class="container">

        <!--HEADER-->
        <?php
        include('../components/header_login.php');
        ?>
        <!--FIM DO HEADER-->

        <!--FORMULÁRIO DE LOGIN-->
        <form class="window-form" action="../back/login.php" method="post">
            <h1>Seja bem-vindo!</h1>

            <label for="email">Email</label>
            <input required type="email" name="email">

            <label for="senha">Senha</label>
            <input required type="password" name="senha">

            <button type="submit">Entrar</button>
        </form>
        <!--FIM DO FORMULÁRIO-->

        <!--RODAPÉ-->
        <?php
        include('../components/footer.php');
        ?>
        <!--FIM DO RODAPÉ-->

    </div>



</body>

<script>
    //VERIFICAÇÃO DE ERRO VIA URL
    window.onload = function() {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);
        const erro = params.get('erro');
        //alert(erro);
        errorAlert(erro);
    }
    //DISPARA ALERTA DE ERRO 
    function errorAlert(erro) {
        if (erro == 'true'){
            alert('Email ou senha incorretos!');
        }
        //window.location.href = window.location.href.replace(`?erro=${params.get('erro')}`, '');
    }
</script>

</html>