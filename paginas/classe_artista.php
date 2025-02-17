<?php
class Artista {
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
        $cmd = $this->pdo->query("SELECT * FROM artista ORDER BY nome");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarArtista($nome) {
        $cmd = $this->pdo->prepare("SELECT id FROM artista WHERE nome = :n");
        $cmd->bindValue(":n", $nome);
        $cmd->execute();
        
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO artista (nome) VALUES (:n)");
            $cmd->bindValue(":n", $nome);
            $cmd->execute();
            return true;
        }
    }

    public function excluirArtista($id) {
        $cmd = $this->pdo->prepare("DELETE FROM artista WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    public function buscaDadosArtista($id) {
        $cmd = $this->pdo->prepare("SELECT * FROM artista WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarDados($id, $nome) {
        $cmd = $this->pdo->prepare("UPDATE artista SET nome = :n WHERE id = :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
}