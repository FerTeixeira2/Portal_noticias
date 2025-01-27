<?php
    require_once 'Conexao.php';

    class AutorDAO {
        public function getAutores() {
            $conexao = (new conexao())->getConexao();

            $sql = "SELECT * FROM autor";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createAutor(AutorModel $autor) {
            $conexao = (new conexao())->getConexao();

            $sql = "INSERT INTO autor VALUES (:id, :nome)";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':nome', $autor->nomeAutor);

            return $stmt->execute();
        }

        public function updateAutor(AutorModel $autor) {
            $conexao = (new conexao())->getConexao();

            $sql = "UPDATE autor SET nomeAutor = :nome WHERE idAutor = :idAutor";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idAutor', $autor->idAutor);
            $stmt->bindValue(':nome', $autor->nomeAutor);

            return $stmt->execute();
        }

        public function deleteAutor (AutorModel $autor) {
            $conexao = (new conexao())->getConexao();

            $sql = "DELETE FROM autor WHERE idAutor = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $autor->idAutor);

            return $stmt->execute();
        }
    }
?>