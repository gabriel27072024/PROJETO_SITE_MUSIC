<?php
class Genero {
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

    public function cadastrarGenero($genero) {
        $cmd = $this->pdo->prepare("SELECT id_genero FROM genero WHERE genero = :g");
        $cmd->bindValue(":g", $genero);
        $cmd->execute();
        
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO genero (genero) VALUES (:g)");
            $cmd->bindValue(":g", $genero);
            $cmd->execute();
            return true;
        }
    }

    public function buscarGeneros() {
        $cmd = $this->pdo->query("SELECT * FROM genero ORDER BY genero");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirGenero($id_genero) {
        $cmd = $this->pdo->prepare("DELETE FROM genero WHERE id_genero = :id_genero");
        $cmd->bindValue(":id_genero", $id_genero);
        $cmd->execute();
    }

    public function buscaDadosGenero($id_genero) {
        $cmd = $this->pdo->prepare("SELECT * FROM genero WHERE id_genero = :id");
        $cmd->bindValue(":id", $id_genero);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarGenero($id_genero, $genero) {
        $cmd = $this->pdo->prepare("UPDATE genero SET genero = :g WHERE id_genero = :id");
        $cmd->bindValue(":g", $genero);
        $cmd->bindValue(":id", $id_genero);
        $cmd->execute();
    }
}
?>
