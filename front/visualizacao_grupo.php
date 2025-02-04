<?php
//PÁGINA DE VISUALIZAÇÃO DO GRUPO DE IMAGENS SELECIONADO
include('../conexao/conn.php');
session_start();

//CAPTURANDO PARÂMETRO DE BUSCA PARA MANTER CONTEÚDO DA BARRA DE BUSCA
if (isset($_GET['busca'])) {
    $busca  = $_GET['busca'];
} else {
    $busca = '';
}

//CAPTURANDO DADOS DO GRUPO
$sql = "SELECT * FROM grupos WHERE id = '".$_GET['grupo']."'; ";
$res = mysqli_query($conn, $sql);
$rws = mysqli_fetch_assoc($res);

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
        ?>
        <!--FIM DO HEADER-->

        <h1 class="page-title" style="color: <?php echo $rws['cor'] ?>;"><?php echo $rws['nome'] ?></h1>

        <!--MENU-->
        <nav>
            <button class="btn-search" onclick="window.location.href='main.php'">
                <ion-icon name="arrow-undo-outline"></ion-icon>
            </button>

            <button onclick="openForm('img-form')">Nova Imagem</button>
            <p><strong>Criado: </strong><?php echo $rws['data_criado']." ".$rws['hora_criado'] ?></p>
            <form class="nav-form" action="../back/group_filter.php" method="post">
                <input class="search-bar" type="search" name="busca" value="<?php echo $busca ?>">
                <input type="hidden" name="grupo" value="<?php echo $_GET['grupo'] ?>">
                <button class="btn-search" type="submit">
                <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
            <button class="btn-search" style="background-color: #FF8383" onclick="confirmDeleteGroup('<?php echo $_GET['grupo'] ?>')">
            <ion-icon name="trash-outline"></ion-icon>
            </button>
        </nav>
        <!--FIM DO MENU-->

        <!--FORMULÁRIO DE UPLOAD PARA GRUPO-->
        <form id="img-form" class="upload-form" enctype="multipart/form-data" action="../back/upload.php" method="POST">
            <div class="form-header">
                <h1>Upload de imagem</h1>
                <button type="button" onclick="closeForm('img-form')">X</button>
            </div>
            <label for="descricao">Descrição curta</label>
            <input type="text" name="descricao">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem">
            <label for="grupo">Álbum</label>
            <select name="grupo">
                <option value="<?php echo $_GET['grupo'] ?>" selected><?php echo $rws['nome'] ?></option>
            </select>

            <button type="submit">Enviar</button>

        </form>
        <!--FIM DO FORMULÁRIO DE UPLOAD-->

        <!--VISUALIZAÇÃO DAS IMAGENS DO GRUPO-->
        <main>
            <?php
            include('../components/group_picture.php');
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
            alert("Ocorreu um erro ao excluir um álbumo ou uma imagem.");
        }
        //window.location.href = window.location.href.replace(`?erro=${params.get('erro')}`, '');
    }
    //ABRE PÁGINA DE VISUALIZAÇÃO ÚNICA DA IMAGEM
    function openImage(id) {
        window.location.href = 'visualizacao_imagem.php?id=' + id;
    }

    //CONFIRMAÇÃO DA EXCLUSÃO DO GRUPO DE IMAGENS
    function confirmDeleteGroup(id) {
        var del = confirm("Tem certeza que deseja excluir esse álbum? Todas as imagens dele serão perdidas.");
        if (del == true) {
            window.location.href = "../back/delete_group.php?grupo=" + id;
        } else if (del == false) {
            return;
        }
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>