<?php

class TecnicoDAO {
    
    public function listAll() {

        try {
            $sql = "SELECT * FROM tb_tecnicos";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $user;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listOnly(int $id) {

        try {
            $sql = "SELECT * FROM tb_tecnicos WHERE idTec = $id";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function insert(Tecnico $tecnico) {

        try {
            $sql = "INSERT INTO tb_tecnicos (nomeTec, cpfTec) VALUES (:nome, :cpf)";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $tecnico->getNome());
            $stmt->bindValue(':cpf', $tecnico->getCpf());
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Tecnico $tecnico, int $id) {

        try {
            $sql = "UPDATE tb_tecnicos SET nomeTec = :nome,cpfTec = :cpf WHERE idTec = $id";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $tecnico->getNome());
            $stmt->bindValue(':cpf', $tecnico->getCpf());
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id) {
        try {
            $sql = "DELETE FROM tb_tecnicos WHERE idTec = $id";
            $stmt = DB::prepare($sql);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}