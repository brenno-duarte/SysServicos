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
            $sql = "INSERT INTO tb_tecnicos (nomeTec, cpfTec, foneTec) VALUES (:nomeTec, :cpfTec, :foneTec)";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nomeTec', $tecnico->getNome());
            $stmt->bindValue(':cpfTec', $tecnico->getCpf());
            $stmt->bindValue(':foneTec', $tecnico->getFone());
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Tecnico $tecnico, int $id) {

        try {
            $sql = "UPDATE tb_tecnicos SET 
            nomeTec = :nomeTec,
            cpfTec = :cpfTec,
            foneTec = :foneTec 
            WHERE idTec = $id";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nomeTec', $tecnico->getNome());
            $stmt->bindValue(':cpfTec', $tecnico->getCpf());
            $stmt->bindValue(':foneTec', $tecnico->getFone());
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