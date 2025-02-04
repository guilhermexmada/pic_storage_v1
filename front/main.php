<?php
//PÁGINA PRINCIPAL
include('../conexao/conn.php');
include('../back/functions.php');
session_start();

//CAPTURNADO O PARÂMETRO DE BUSCA PARA MANTER CONTEÚDO DA BARRA DE BUSCA
if(isset($_GET['busca'])){
    $busca  = $_GET['busca'];
} else{
    $busca = '';
}

//CAPTURANDO EMAIL DO USUÁRIO
$email = searchEmail($_SESSION['log_key'], $conn);

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
        include('../components/header_main.php');
        //echo searchEmail($_SESSION['log_key'],$conn);
        ?>
        <!--FIM DO HEADER-->

        <h1 class="page-title">Minhas Imagens</h1>

        <!--MENU-->
        <nav>
            <button class="openForm" onclick="openForm('img-form')">Nova Imagem</button>
            <button class="openForm" onclick="openForm('group-form')">Novo Álbum</button>
            <button class="import">
                <ion-icon name="download-outline"></ion-icon>
            </button>
            <form class="nav-form" action="../back/filter.php" method="post">
                <input class="search-bar" type="search" name="busca" value="<?php echo $busca ?>">
                <button class="btn-search" type="submit" >
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
        </nav>
        <!--FIM DO MENU-->

        <!--FORMULÁRIO DE UPLOAD-->
        <form id="img-form" class="upload-form" enctype="multipart/form-data" action="../back/upload.php" method="POST">
            <div class="form-header">
                <h1>Upload de imagem</h1>
                <button type="button" onclick="closeForm('img-form')">
                <ion-icon name="close-outline"></ion-icon>
                </button>
            </div>
            <label for="descricao">Descrição curta</label>
            <input type="text" name="descricao" required>
            <label for="imagem" required>Imagem</label>
            <input type="file" name="imagem">
            <label for="grupo">Álbum</label>
            <select name="grupo">
                <?php
                //LISTA DE ÁLBUNS PARA SELEÇÃO
                $sql = "SELECT nome, id FROM grupos WHERE email_usuario = '$email';";
                $result = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo "
                            <option value='" . $rows['id'] . "'>" . $rows['nome'] . "</option>
                        ";
                }
                ?>
            </select>

            <button type="submit">Enviar</button>

        </form>
        <!--FIM DO FORMULÁRIO DE UPLOAD-->

        <!--FORMULÁRIO DE GRUPO-->
        <form id="group-form" class="upload-form" action="../back/new_group.php" method="POST">
            <div class="form-header">
                <h1>Criação de Álbum</h1>
                <button type="button" onclick="closeForm('group-form')">
                <ion-icon name="close-outline"></ion-icon>
                </button>
            </div>
            <label for="nome">Nome do álbum</label>
            <input type="text" name="nome" required>
            <label for="cor">Cor do álbum</label>
            <input type="color" name="cor">

            <button type="submit">Enviar</button>

        </form>
        <!--FIM DO FORMULÁRIO DE GRUPO-->

        <!--VISUALIZAÇÃO DE GRUPOS E FOTOS-->
        <main>
            <?php
            include('../components/group.php');
            include('../components/picture.php');
            ?>
        </main>
        <!--FIM DO VISUALIZAÇÃO-->

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

    //ABRE FORMULÁRIOS
    function openForm(form) {
        var form = document.getElementById(`${form}`);
        form.style.display = "flex";
        form.style.animationName = "aparecer";
        form.style.animationDuration = "1s";
        form.style.animationIterationCount = "1";
    }

    //FECHA FORMULÁRIOS
    function closeForm(form) {
        var form = document.getElementById(`${form}`);
        form.style.display = "none";
    }

    //DISPARA ALERTA DE ERRO 
    function errorAlert(erro) {
        if (erro == 'falha_upload') {
            alert("Falha no upload da imagem. Tente novamente.");
        } else if (erro == 'extensao_invalida') {
            alert("Extensão inválida. Use JPG, JPEG ou PNG.");
        } else if (erro == 'grupo_existente') {
            alert("Você já tem um grupo com esse nome.");
        } else if (erro == 'falha_delete') {
            alert("Ocorreu um erro ao excluir um álbum ou uma imagem.");
        }
        //window.location.href = window.location.href.replace(`?erro=${params.get('erro')}`, '');
    }

    //ABRE PÁGINA DE VISUALIZAÇÃO ÚNICA DA IMAGEM
    function openImage(id) {
        window.location.href = 'visualizacao_imagem.php?id=' + id;
    }

    //ABRE PÁGINA DE VISUALIZAÇÃO DO GRUPO DE IMAGENS
    function openGroup(id) {
        window.location.href = 'visualizacao_grupo.php?grupo=' + id;
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>