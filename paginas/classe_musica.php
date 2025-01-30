<?php
class Musica {
    private $pdo;

    public function __construct($dbname, $host, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com o banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: " . $e->getMessage();
            exit();
        }
    }

    public function buscardados() {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM musica ORDER BY musica");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarMusica($musica, $artista) {
        $cmd = $this->pdo->prepare("SELECT id_musica FROM musica WHERE musica = :m");
        $cmd->bindValue(":m", $musica);
        $cmd->execute();
        
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO musica (musica, artista) VALUES (:m, :a)");
            $cmd->bindValue(":m", $musica);
            $cmd->bindValue(":a", $artista);
            $cmd->execute();
            return true;
        }
    }

    public function excluirMusica($id_musica) {
        $cmd = $this->pdo->prepare("DELETE FROM musica WHERE id_musica = :id_musica");
        $cmd->bindValue(":id_musica", $id_musica);
        $cmd->execute();
    }
}
?>