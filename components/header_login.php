<!-- COMPONENTE DE CABEÇALHO DA PÁGINA DE LOGIN E DE CADASTRO -->
<header>

    <?php
        //OBTÉM URL COMPLETA
        $url = $_SERVER['REQUEST_URI'];
        //DIVIDE URL EM PARTES
        $path = parse_url($url, PHP_URL_PATH);
        //VERIFICA PÁGINA E ALTERA BOTÃO
        if($path == "/pic_storage/front/login.php"){
            $new_route = 'cadastro.php';
            $btn_text = 'Cadastrar';
        } else if($path == "/pic_storage/front/cadastro.php"){
            $new_route = 'login.php';
            $btn_text = 'Entrar';
        }
    ?>

    <img class="logo" src="../assets/logo.png">
    <h1 class="title">Pic Storage</h1>
    <button onclick="window.location.href='<?php echo $new_route ?>'">
        <?php 
            echo $btn_text;
        ?>
    </button>
</header>