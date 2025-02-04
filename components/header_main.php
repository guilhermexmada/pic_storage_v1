<!-- COMPONENTE DE CABEÇALHO PADRÃO -->
<header>

    <img class="logo" src="../assets/logo.png">
    <h1 class="title">Pic Storage</h1>
    <p class="username">
        <?php 
            echo 'Seja bem-vindo, ' . $_SESSION['log_name'];
        ?>
    </p>
    <button class="btn_icon" onclick="window.location.href='configuracoes.php' ">
        Configurações
    </button>
    <button class="btn_icon" onclick="window.location.href='../back/logout.php' ">
        Sair
    </button>
</header>