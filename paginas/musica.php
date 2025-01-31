<?php
require_once 'classe_musica.php';
$p = new Musica("site_music", "localhost", "root", "");
$musica = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Musica</title>
</head>
<body>
    <?php
    if (isset($_POST['musica'])) {
        $musica = addslashes($_POST['musica']);
        $artista = addslashes($_POST['artista']);
        if (!empty($musica) && !empty($artista)) {
            if (!$p->cadastrarMusica($musica, $artista)) {
                echo "Música já cadastrada";
            }
        } else {
            echo "Preencha todos os campos";
        }
    }

    if (isset($_GET['id_musica'])) {
        $id_musica = addslashes($_GET['id_musica']);
        $p->excluirMusica($id_musica);
        header("Location: musica.php");
    }

    if (isset($_GET['id_up'])) {
        $id_update = addslashes($_GET['id_up']);
        $res = $p->buscaDadosMusica($id_update);
    }
    ?>

    <section id="esquerda">
        <form method="POST">
            <h2><?php echo isset($res) ? "Atualizar Música" : "Cadastrar Música"; ?></h2>
            <label for="nome">Nome Da Música
                <input type="text" name="musica" id="nome" placeholder="Digite a Música"
                value="<?php if (isset($res) && !empty($res)) { echo $res['musica']; } ?>">
            </label>
            <label for="artista">Artista
                <input type="text" name="artista" id="artista" placeholder="Digite o Artista"
                value="<?php if (isset($res) && !empty($res)) { echo $res['artista']; } ?>">
            </label>
            <input type="submit" value="<?php echo isset($res) ? "Atualizar" : "Cadastrar Música"; ?>">
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo">
                <td>Nome Da Música</td>
                <td>Artista</td>
                <td>Ações</td>
            </tr>
            <?php
            $dados = $p->buscardados();
            if (count($dados) > 0) {
                foreach ($dados as $musica) {
                    echo "<tr>";
                    echo "<td>" . $musica['musica'] . "</td>";
                    echo "<td>" . $musica['artista'] . "</td>";
                    echo "<td>
                        <a href='musica.php?id_up=" . $musica['id_musica'] . "'>Editar</a>
                        <a href='musica.php?id_musica=" . $musica['id_musica'] . "'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Ainda não há música cadastrada</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>