<?php

class PagoMetodo{
    private $idTBPagoMetodo;
    private $nombreTBPagoMetodo;
    private $descripcionTBPagoMetodo;
    private $activoTBPagoMetodo;

    function PagoMetodo($idTBPagoMetodo, $nombreTBPagoMetodo, $descripcionTBPagoMetodo, $activoTBPagoMetodo){
        $this->idTBPagoMetodo = $idTBPagoMetodo;
        $this->nombreTBPagoMetodo = $nombreTBPagoMetodo;
        $this->descripcionTBPagoMetodo = $descripcionTBPagoMetodo;
        $this->activoTBPagoMetodo = $activoTBPagoMetodo;
    }

    public function getIDPagoMetodo(){
        return $this->idTBPagoMetodo;
    }

    public function getNombreTBPagoMetodo(){
        return $this->nombreTBPagoMetodo;
    }

    public function setNombreTBPagoMetodo($nombreTBPagoMetodo){
        $this->nombreTBPagoMetodo = $nombreTBPagoMetodo;
    }

    public function getDescripcionTBPagoMetodo(){
        return $this->descripcionTBPagoMetodo;
    }

    public function setDescripcionTBPagoMetodo($descripcionTBPagoMetodo){
        $this->descripcionTBPagoMetodo = $descripcionTBPagoMetodo;
    }
    
    public function getActivoTBPagoMetodo(){
        return $this->activoTBPagoMetodo;
    }

    public function setActivoTBPagoMetodo($activoTBPagoMetodo){
        $this->activoTBPagoMetodo = $activoTBPagoMetodo;
    }
}