<?php
require_once 'classe_musica.php';
$p = new musica("site_music", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="estilo.css">
    <title>Musica</title>
</head>
<body>

<section id = "esquerda">

 <form>
    <h2>Cadastrar Musica</h2>
    <label for="nome">Nome Da Musica</label>
    <input type="text" name= "nome" id = "nome">

    <input type="submit" value="Cadastrar Musica">
</form>
 
</section>

<section id = "direita">
<table>
    <tr id= "titulo">
        <td>Nome Da Musica</td>
    </tr>
<?php
    $dados = $p-> buscardados();
    if(count($dados)>0)
    {
        //echo"<pre>"; print_r($dados); die();
        for($i=0; $i < count ($dados); $i++){
            echo"<tr>";
            foreach($dados[$i] as $k => $v){
                if($k != "id_musica"){
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