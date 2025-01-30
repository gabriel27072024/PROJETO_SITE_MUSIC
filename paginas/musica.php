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
                echo "Musica já cadastrada";
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
    ?>

    <section id="esquerda">
        <form method="POST">
            <h2>Cadastrar Musica</h2>
            <label for="nome">Nome Da Musica
                <input type="text" name="musica" id="nome" placeholder="Digite a Música">
            </label>
            <label for="artista">Artista
                <input type="text" name="artista" id="artista" placeholder="Digite o Artista">
            </label>
            <input type="submit" value="Cadastrar Musica">
        </form>
    </section>

    <section id="direita">
        <table>
            <tr id="titulo">
                <td>Nome Da Musica</td>
            </tr>
            <?php
            $dados = $p->buscardados();
            if (count($dados) > 0) {
                for ($i = 0; $i < count($dados); $i++) {
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id_musica") {
                            echo "<td>" . $v . "</td>";
                        }
                    }
                    echo "<td>
                        <a href=''>Editar</a>
                        <a href='musica.php?id_musica=" . $dados[$i]['id_musica'] . "'>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "Ainda não há música cadastrada";
            }
            ?>
        </table>
    </section>
</body>
</html>
