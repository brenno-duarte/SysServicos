<?php

class Cliente {

    private $nome;
    private $cpf;
    private $fone;

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

}