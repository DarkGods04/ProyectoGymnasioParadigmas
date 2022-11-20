<?php

class CategorizacionCliente{
    private $idCategorizacionCliente;
    private $idCliente;
    private $idTipoCliente;
    private $categorizacionClienteActivo;

    function CategorizacionCliente($idCategorizacionCliente, $idCliente, $idTipoCliente, $categorizacionClienteActivo){
        $this->idCategorizacionCliente = $idCategorizacionCliente;
        $this->idCliente = $idCliente;
        $this->idTipoCliente = $idTipoCliente;
        $this->categorizacionClienteActivo = $categorizacionClienteActivo;
    }

    public function getIdCategorizacionCliente(){
        return $this->idCategorizacionCliente;
    }

    public function setIdCategorizacionCliente($idCategorizacionCliente){
        return $this->idCategorizacionCliente = $idCategorizacionCliente;
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function getIdTipoCliente(){
        return $this->idTipoCliente;
    }

    public function setIdTipoCliente($idTipoCliente){
        $this->idTipoCliente = $idTipoCliente;
    }
    
    public function getCategorizacionClienteActivo(){
        return $this->categorizacionClienteActivo;
    }

    public function setCategorizacionClienteActivo($categorizacionClienteActivo){
        $this->categorizacionClienteActivo = $categorizacionClienteActivo;
    }
}
?>