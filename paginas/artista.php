<?php
require_once 'classe_artista.php';
$p = new artista("site_music", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="estilo.css">
    <title>Artista</title>
</head>
<body>

<section id = "esquerda">

 <form>
    <h2>
    Cadastrar artista</h2>
    <label for="nome">Nome do Artista</label>
    <input type="text" name= "nome" id = "nome">

    <input type="submit" value="Cadastrar Artista">
</form>
 
</section>

<section id = "direita">
<table>
    <tr id= "titulo">
        <td>Nome Do Artista</td>
    </tr>
<?php
    $dados = $p-> buscardados();
    if(count($dados)>0)
    {
        for($i=0; $i < count ($dados); $i++){
            echo"<tr>";
            foreach($dados[$i] as $k => $v){
                if($k != "id"){
                    echo"<td>".$v."</td>";

                }
            }
            echo "</tr>";
            
        }
        ?>
        <td> <a href="">Editar</a> <a href="">Excluir</a></td>
        <?php
    } 
    
?>
</table>
</body>
</html>