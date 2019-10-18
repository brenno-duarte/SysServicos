<?php

class ClienteDAO {
    
    public function listAll() {

        try {
            $sql = "SELECT * FROM tb_clientes";
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
            $sql = "SELECT * FROM tb_clientes WHERE idCli = $id";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function countCliente(){
        try {
            $sql = "SELECT count(*) FROM tb_clientes";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $user;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function insert(Cliente $cliente) {

        try {
            $sql = "INSERT INTO tb_clientes (nome,cpf,fone) VALUES (:nome,:cpf,:fone)";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $cliente->getNome());
            $stmt->bindValue(':cpf', $cliente->getCpf());
            $stmt->bindValue(':fone', $cliente->getFone());
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update(Cliente $cliente, int $id) {

        try {
            $sql = "UPDATE tb_clientes SET nome = :nome,cpf = :cpf,fone = :fone WHERE idCli = $id";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $cliente->getNome());
            $stmt->bindValue(':cpf', $cliente->getCpf());
            $stmt->bindValue(':fone', $cliente->getFone());
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id) {
        try {
            $sql = "DELETE FROM tb_clientes WHERE idCli = $id";
            $stmt = DB::prepare($sql);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}