<?php
require_once 'classe_artista.php';
$p = new Artista("site_music", "localhost", "root", "");
$nome = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Artista</title>
</head>
<body>
    <?php
    if (isset($_POST['artista'])) {
        $nome = addslashes($_POST['artista']);
        if (!empty($nome)) {
            if (!$p->cadastrarArtista($nome)) {
                echo "Artista já cadastrado";
            }
        } else {
            echo "Preencha todos os campos";
        }
    }

    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
        $p->excluirArtista($id);
        header("Location: artista.php");
    }

    if (isset($_GET['id_up'])) {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscaDadosArtista($id_update);
    }
    ?>

    <section id="esquerda">
        <form method="POST">
            <label for="artista">Artista
                <input type="text" name="artista" id="artista" placeholder="Digite o Artista"
                value="<?php if (isset($res) && !empty($res)) { echo $res['nome']; } ?>">
            </label>
            <input type="submit" value="<?php echo isset($res) ? "Atualizar" : "Cadastrar artista"; ?>">
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo">
                <td>Nome do Artista</td>
            </tr>
            <?php
            $dados = $p->buscardados();
            if (count($dados) > 0) {
                foreach ($dados as $nome) {
                    echo "<tr>";
                    echo "<td>" . $nome['nome'] . "</td>";
                    echo "<td>
                        <a href='artista.php?id_up=" . $nome['id'] . "'>Editar</a>
                        <a href='artista.php?id=" . $nome['id'] . "'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Ainda não há artista cadastrada</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>