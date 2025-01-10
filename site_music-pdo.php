<?php
$nome ="Jhenifer";
$id = "?";
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


    //insert
//$res = $pdo-> prepare("INSERT INTO artista (nome) VALUES (:n )");

//$res->bindValue(":n", "Tribalistas");
//$res->execute();


    // outra forma de Select
//$sql = $pdo-> prepare ("SELECT *FROM artista where nome = :n");
//$sql->bindValue(":n", $nome);
//$sql->execute();
//$resultado = $sql->fetch(PDO::FETCH_ASSOC);

//foreach ($resultado as $key => $value){
//	echo $key.":".$value. "<br>";
//}



    //Atualização de informações
//$res = $pdo->prepare ("UPDATE artista SET nome = :n WHERE id = :id");
//$res->bindValue(":n", $nome);
//$res->bindValue(":id", $id);
//$res->execute();


    //select 
//$res = $pdo->prepare("SELECT*FROM artista where id = :id");
//$res->bindValue(":id" , $id);
//$res->execute();
//$resultado = $res->fetchAll(PDO::FETCH_ASSOC);
//echo"<pre>";
//print_r($resultado);
//echo"</pre>";


    //delete
//$res = $pdo ->prepare("DELETE FROM artista where id = :id");
//$res->bindValue(":id", $id);
//$res->execute();