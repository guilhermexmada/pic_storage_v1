<?php
//PÁGINA DE VISUALIZAÇÃO ÚNICA DE IMAGENS
include('../conexao/conn.php');
include('../back/functions.php');
session_start();

//CAPTURANDO DADOS DA IMAGEM
$id = $_GET['id'];
$sql = "SELECT * FROM imagens WHERE id = '$id';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

//CAPTURANDO EMAIL
$email = searchEmail($_SESSION['log_key'], $conn);

//TRATANDO NOME E EXTENSÃO
$extensao = strtolower(pathinfo($rows['nome'], PATHINFO_EXTENSION));
$nome = str_replace("." . $extensao, "", $rows['nome']);

//VERIFICANDO GRUPO E DEFININDO CAMINHO DE VOLTA
$grp = "SELECT id_grupo FROM imagens WHERE id = '$id';";
$grp_result = mysqli_query($conn, $grp);
$grp_rows = mysqli_fetch_assoc($grp_result);

$grp2 = "SELECT nome FROM grupos WHERE id = '$grp_rows[id_grupo]';";
$grp2_result = mysqli_query($conn, $grp2);
$grp2_rows = mysqli_fetch_assoc($grp2_result);

//SE O GRUPO FOR GERAL, VOLTA PARA PRINCIPAL
//SE O GRUPO FOR ESPECÍFICO, VOLTA PARA PÁGINA DO GRUPO
if ($grp2_rows['nome'] == 'general') {
    $wayback = 'main.php';
} else {
    $wayback = 'visualizacao_grupo.php?grupo=' . $grp_rows['id_grupo'] . '';
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
        include('../components/header_main.php');
        ?>
        <!--FIM DO HEADER-->

        <!--MENU-->
        <nav>
            <button class="btn-search" onclick="window.location.href='<?php echo $wayback ?>'">
                <ion-icon name="arrow-undo-outline"></ion-icon>
            </button>
            <p><strong>Formato</strong>: <?php echo $extensao ?></p>
            <p><strong>Nome</strong>: <?php echo $nome ?></p>
            <p><strong>Upload</strong>: <?php echo date("d/m/Y", strtotime($rows['data_upload'])) . ' ' . date("H:i", strtotime($rows['hora_upload'])) ?></p>
            <button onclick="openForm('switch-form')">Mover Imagem</button>
            <button class="btn-search" style="background-color: #FF8383" onclick="confirmDelete(<?php echo $rows['id'] ?>)">
            <ion-icon name="trash-outline"></ion-icon>
            </button>
        </nav>
        <!--FIM DO MENU-->

        <!--FORMULÁRIO DE TROCA-->
        <form id="switch-form" class="upload-form" action="../back/move.php" method="POST">
            <div class="form-header">
                <h1>Trocar de álbum</h1>
                <button type="button" onclick="closeForm('switch-form')">X</button>
            </div>
            <input type="hidden" name="id" value="<?php echo $rows['id'] ?>">
            <label for="atual">Álbum atual</label>
            <input type="text" name="atual" value="<?php echo $grp2_rows['nome'] ?>" readonly>
            <label for="novo_grupo">Álbum de destino</label>
            <select name="novo_grupo">
                <option value="general" selected></option>
                <?php
                //LISTA DE GRUPOS PARA SELEÇÃO
                $sel = "SELECT nome, id FROM grupos WHERE email_usuario = '$email';";
                $res_sel = mysqli_query($conn, $sel);
                while ($rows_sel = mysqli_fetch_assoc($res_sel)) {
                    echo "
                            <option value='" . $rows_sel['id'] . "'>" . $rows_sel['nome'] . "</option>
                        ";
                }
                ?>
            </select>

            <button type="submit">Enviar</button>

        </form>
        <!--FIM DO FORMULÁRIO DE TROCA-->

        <!--VISUALIZAÇÃO DA IMAGEM-->
        <p class="description"><?php echo $rows['descricao']. ' '. $grp2_rows['nome']?></p>
        <img class="original-pic" src="<?php echo $rows['caminho'] ?>">
        

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
        } else if (erro == 'falha_delete') {
            alert("Ocorreu um erro ao excluir um álbum ou uma imagem.");
        } else if (erro == 'falha_move') {
            alert("Ocorreu um erro ao mover a imagem de um álbum para outro.");
        }
        //window.location.href = window.location.href.replace(`?erro=${params.get('erro')}`, '');
    }

    //CONFIRMAÇÃO DE EXCLUSÃO DA IMAGEM
    function confirmDelete(id) {
        var del = confirm("Tem certeza que deseja excluir esta imagem?");
        if (del == true) {
            window.location.href = "../back/delete_image.php?id=" + id;
        } else if (del == false) {
            return;
        }
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>