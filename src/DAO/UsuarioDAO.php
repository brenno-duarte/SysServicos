<?php

include_once PATH . '/src/DB/DB.php';

class UsuarioDAO {
    
    public function validarLogin(Usuario $usuario) {

        try {
            $sql = "SELECT * FROM tb_usuarios WHERE loginUsu = :loginUsu AND senhaUsu = :senhaUsu";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':loginUsu', $usuario->getLogin());
            $stmt->bindValue(':senhaUsu', $usuario->getSenha());
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $valor = $stmt->rowCount();

            if ($valor > 0) {
                return true;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listAll() {

        try {
            $sql = "SELECT * FROM tb_usuarios";
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
            $sql = "SELECT * FROM tb_usuarios WHERE idUsu = $id";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert(Usuario $usuario) {

        try {
            $sql = "INSERT INTO tb_usuarios 
            (nome,cpf,fone,loginUsu,senhaUsu) 
            VALUES 
            (:nome,:cpf,:fone,:loginUsu,:senhaUsu)";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':fone', $usuario->getFone());
            $stmt->bindValue(':loginUsu', $usuario->getLogin());
            $stmt->bindValue(':senhaUsu', $usuario->getSenha());
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Usuario $usuario, int $id) {

        try {
            $sql = "UPDATE tb_usuarios SET 
            nome = :nome,
            cpf = :cpf,
            fone = :fone,
            loginUsu = :loginUsu,
            senhaUsu = :senhaUsu 
            WHERE idUsu = $id";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':fone', $usuario->getFone());
            $stmt->bindValue(':loginUsu', $usuario->getLogin());
            $stmt->bindValue(':senhaUsu', $usuario->getSenha());
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id) {
        try {
            $sql = "DELETE FROM tb_usuarios WHERE idUsu = $id";
            $stmt = DB::prepare($sql);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}