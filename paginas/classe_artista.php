<?php
class artista{
    

    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try{
            $this->pdo = new pdo("mysql:dbname=".$dbname. ";host=".$host,$user,$senha);

        }
        catch(PDOException $e){
            echo "Erro com Banco de dados";

            exit();
        }
        catch(Exception $e){
            echo"Erro generico:" .$e->getmessage();
            exit();
        }
    }

    public function buscardados(){

        $res = array();
    $cmd = $this->pdo->query("select * FROM artista ORDER by nome");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $res;

    }

}

?>