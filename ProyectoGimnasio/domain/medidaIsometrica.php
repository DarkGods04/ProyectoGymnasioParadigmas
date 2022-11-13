<?php 

class MedidaIsometrica{

    private $idMedida;
    private $idGrupoMuscular;
    private $idCliente;
    private $fechaMedicion;
    private $medida;
    private $activo;

    function MedidaIsometrica($idMedida,$idGrupoMuscular,$idCliente,$fechaMedicion,$medida,$activo){
        $this->idMedida = $idMedida;
        $this->idGrupoMuscular = $idGrupoMuscular;
        $this->idCliente = $idCliente;
        $this->fechaMedicion = $fechaMedicion;
        $this->medida = $medida;
        $this->activo = $activo;
    }

    public function getIdMedida(){
        return $this->idMedida;
    }

    function setIdMedida($idMedida){
        $this->idMedida = $idMedida;
    }

    function getIdGrupoMuscular(){
        return $this->idGrupoMuscular;
    }

    function setIdGrupoMuscular($idGrupoMuscular){
        $this->idGrupoMuscular = $idGrupoMuscular;
    }

    function getIdCliente(){
        return $this->idCliente;
    }

    function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    function getFechaMedicion(){
        return $this->fechaMedicion;
    }

    function setFechaMedicion($fechaMedicion){
        $this->fechaMedicion = $fechaMedicion;
    }

    function getMedida(){
        return $this->medida;
    }

    function setMedida($medida){
        $this->medida = $medida;
    }

    function getActivo(){
        return $this->activo;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }

}