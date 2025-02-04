<?php
//PÁGINA DE CONFIGURAÇÕES
include('../conexao/conn.php');
include('../back/functions.php');
session_start();

//CONSULTANDO DADOS DO USUÁRIO A PARTIR DO SEU ID
$sql = "SELECT * FROM usuarios WHERE id = '" . $_SESSION['log_key'] . "';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

//CAPTURANDO EMAIL DO USUÁRIO
$email = searchEmail($_SESSION['log_key'], $conn);

//CONTANDO QUANTIDADE DE IMAGENS DO USUÁRIO
$count_imgs = mysqli_query($conn, "SELECT * FROM imagens WHERE email_usuario = '$email';");
$num_imgs = mysqli_num_rows($count_imgs);

//CONTANDO QUANTIDADE DE GRUPOS DO USUÁRIO
$count_grps = mysqli_query($conn, "SELECT * FROM grupos WHERE email_usuario = '$email';");
$num_grps = mysqli_num_rows($count_grps) - 1;

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

        <h1 class="page-title">Configurações</h1>

        <!--MENU-->
        <nav>
            <button class="btn-search" onclick="window.location.href='main.php'">
                <ion-icon name="arrow-undo-outline"></ion-icon>
            </button>
            <p> <strong>Email: </strong> <?php echo $rows['email'] ?></p>
            <p> <strong>Nome de usuário: </strong> <?php echo $rows['nome'] ?></p>
            <p> Senha: <?php echo $rows['senha'] ?></p>
            <p> Cadastro: <?php echo $rows['data_cadastro'] . " " . $rows['hora_cadastro'] ?></p>
            
            <button class="btn-search" style="background-color: #FF8383" onclick="confirmDeleteAccount(<?php echo $rows['id'] ?>)">
                <ion-icon name="trash-outline"></ion-icon>
            </button>
        </nav>

        <nav>
        <p> Imagens salvas: <?php echo $num_imgs ?></p>
        
        <p> Imagens favoritas: 0</p>

        <p> Álbuns criados: <?php echo $num_grps ?></p>

        <p>Pinterest: desconectado</p>
        <p>Google Drive: desconectado</p>
        <p>Google Fotos: desconectado</p>
        </nav>
        <!--FIM DO MENU-->


        <!--VISUALIZAÇÃO DE GRUPOS E FOTOS-->
        <main>

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
        form.style.visibility = "visible";
    }

    //FECHA FORMULÁRIOS
    function closeForm(form) {
        var form = document.getElementById(`${form}`);
        form.style.visibility = "hidden";
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
    function openGroup(nome) {
        window.location.href = 'visualizacao_grupo.php?grupo=' + nome;
    }

    //CONFIRMAÇÃO DE EXCLUSÃO DA CONTA
    function confirmDeleteAccount(id) {
        var del = confirm("Tem certeza que deseja excluir essa conta? Todos os seus dados serão perdidos.");
        if (del == true) {
            window.location.href = "../back/delete_account.php?id=" + id;
        } else if (del == false) {
            return;
        }
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>