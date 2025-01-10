<?php
class musica{
    

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
    $cmd = $this->pdo->query("select * FROM musica ORDER by musica");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $res;
    }

}

?>