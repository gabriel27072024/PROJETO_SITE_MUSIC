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
        //Função para cadastrar a musica
        public function cadastrarmusica($musica , $artista)
        {
            $cmd = $this ->pdo-> prepare("select musica from musica where musica = :m ");
            $cmd->bindValue(":m",  $musica);
            $cmd->execute();
            if($cmd-> rowCount()> 0)//musica ja existe
            {
                return false;
            }else //musica não foi encontrada
            {
                $cmd = $this->pdo->prepare ("insert into musica (musica, artista) values (:m, :a)");
                $cmd->bindValue(":m", $musica);
                $cmd->bindValue(":a",$artista);
                $cmd->execute();
                return true;
            }
        }    

}

?>