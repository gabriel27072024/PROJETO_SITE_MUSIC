<?php
try {
	$pdo = new PDO ("mysql:host=localhost;dbname=site_music","root", "");
 

} 
catch (PDOException $e) {
   echo "erro com banco de dados; ".$e->getMessage();
}
catch (Exception $e)
{
 echo "erro generico;" .$e->getMessage();;
}

$res = $pdo-> prepare("INSERT INTO artista (nome) VALUES 
	(:n )");

$res->bindValue(":n", "Hiago");
$res->execute();


$teste = $pdo-> query ("SELECT *FROM artista order by id desc limit 3");
$teste2 = $teste-> fetchAll(PDO::FETCH_ASSOC);
echo'<pre>';
print_r($teste2);
?>

