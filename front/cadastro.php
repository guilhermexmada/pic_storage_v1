<?php
//PÁGINA DE CADASTRO DO USUÁRIO
include('../conexao/conn.php');
session_start();

//VERIFICAÇÃO DE ERRO NO CADASTRO VIA URL
if (isset($_GET['erro'])) {
    echo '
        <script>alert("Este email já está em uso. Tente outro.")</script>
    ';
}
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

        <!--FORMULÁRIO DE CADASTRO-->
        <form class="window-form" action="../back/cadastrar.php" method="post">
            <h1>Cadastro</h1>

            <label for="nome">Nome de usuário</label>
            <input type="text" name="nome" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
        <!--FIM DO FORMULÁRIO-->

        <!--RODAPÉ-->
        <?php
        include('../components/footer.php');
        ?>
        <!--FIM DO RODAPÉ-->

    </div>



</body>

</html>