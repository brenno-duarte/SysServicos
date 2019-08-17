<?php

class OS {

    private $idCli;
    private $situacao;
    private $equip;
    private $defeito;
    private $tecnico;
    private $valor;

    public function getIdCli() {
        return $this->idCli;
    }

    public function setIdCli($idCli) {
        $this->idCli = $idCli;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getEquip() {
        return $this->equip;
    }

    public function setEquip($equip) {
        $this->equip = $equip;
    }

    public function getDefeito() {
        return $this->defeito;
    }

    public function setDefeito($defeito) {
        $this->defeito = $defeito;
    }

    public function getTecnico() {
        return $this->tecnico;
    }

    public function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
}
