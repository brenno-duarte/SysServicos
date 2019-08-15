<?php

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

class Usuarios extends SQL {

    protected $table = 'tb_usuarios';
    private $nome;
    private $cpf;
    private $fone;
    private $login;
    private $senha;

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getFone() {
        return $this->fone;
    }

    public function setFone($fone) {
        $this->fone = $fone;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function validarLogin($login, $senha) {

        try {
            $sql = "SELECT * FROM $this->table WHERE login=:login AND senha=:senha";
            $stmt = DB::prepare($sql);
            $stmt->execute([
                ':login' => $login,
                ':senha' => $senha
            ]);
            $valor = $stmt->rowCount();

            if ($valor > 0) {
                $_SESSION['login'] = $_POST['login'];
                header("location: painel.php");
            } else {
                $_SESSION['error'] = "Login e/ou senha inválido";
                header("location: index.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    

    public function insert() {

        try {
            $sql = "INSERT INTO $this->table (nome,cpf,fone,login,senha) VALUES (:nome,:cpf,:fone,:login,:senha)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':fone', $this->fone);
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($id) {

        try {
            $sql = "UPDATE $this->table SET nome = :nome,cpf = :cpf,fone = :fone,login = :login,senha = :senha WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':fone', $this->fone);
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>