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
    //Função para cadastrar a artista
    public function cadastrarartista($nome)
    {
        $cmd = $this ->pdo-> prepare("select id from musica where nome = :n ");
        $cmd->bindValue(":n",  $nome);
        $cmd->execute();
        if($cmd-> rowCount()> 0)//musica ja existe
        {
            return false;
        }else //musica não foi encontrada
        {
            $cmd = $this->pdo->prepare ("insert into artista (nome) values(:n)");
            $cmd->bindValue(":n", $nome);
            $cmd->execute();
            return true;
        }
    }

}

?>
