<?php
require_once 'classe_genero.php';
$p = new Genero("site_music", "localhost", "root", "");
$genero = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gênero</title>
</head>
<body>
    <?php
    if (isset($_POST['genero'])) {
        $genero = addslashes($_POST['genero']);
        if (!empty($genero)) {
            if (!$p->cadastrarGenero($genero)) {
                echo "Gênero já cadastrado";
            }
        } else {
            echo "Preencha todos os campos";
        }
    }

    if (isset($_GET['id_genero'])) {
        $id_genero = addslashes($_GET['id_genero']);
        $p->excluirGenero($id_genero);
        header("Location: genero.php");
    }

    if (isset($_GET['id_up'])) {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscaDadosGenero($id_update);
    }
    ?>

    <section id="esquerda">
        <form method="POST">
            <h2><?php echo isset($res) ? "Atualizar Gênero" : "Cadastrar Gênero"; ?></h2>
            <label for="genero">Nome Do Gênero
                <input type="text" name="genero" id="genero" placeholder="Digite o Gênero"
                value="<?php if (isset($res) && !empty($res)) { echo $res['genero']; } ?>">
            </label>
            <input type="submit" value="<?php echo isset($res) ? "Atualizar" : "Cadastrar Gênero"; ?>">
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo">
                <td>Nome Do Gênero</td>
                <td>Ações</td>
            </tr>
            <?php
            $dados = $p->buscarGeneros();
            if (count($dados) > 0) {
                foreach ($dados as $genero) {
                    echo "<tr>";
                    echo "<td>" . $genero['genero'] . "</td>";
                    echo "<td>
                        <a href='genero.php?id_up=" . $genero['id_genero'] . "'>Editar</a>
                        <a href='genero.php?id_genero=" . $genero['id_genero'] . "'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Ainda não há gêneros cadastrados</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>