<?php

class Servicio{

    private $idTBServicio;
    private $nombreTBServicio;
    private $descripcionTBServicio;
    private $montoTBServicio;
    private $activoTBServicio;

    function Servicio($idTBServicio, $nombreTBServicio, $descripcionTBServicio, $montoTBServicio, $activoTBServicio){
        $this->idTBServicio = $idTBServicio;
        $this->nombreTBServicio = $nombreTBServicio;
        $this->descripcionTBServicio = $descripcionTBServicio;
        $this->montoTBServicio = $montoTBServicio;
        $this->activoTBServicio = $activoTBServicio;
    }

    function setNombreTBServicio($nombreTBServicio){
        $this->nombreTBServicio = $nombreTBServicio;
    }

    function setDescripcionTBServicio($descripcionTBServicio){
        $this->descripcionTBServicio = $descripcionTBServicio;
    }

    function setMontoTBServicio($montoTBServicio){
        $this->montoTBServicio = $montoTBServicio;
    }

    function setActivoTBServicio($activoTBServicio){
        $this->activoTBServicio = $activoTBServicio;
    }

    function getIdTBServicio(){
        return $this->idTBServicio;
    }

    function getNombreTBServicio(){
        return $this->nombreTBServicio;
    }

    function getDescripcionTBServicio(){
        return $this->descripcionTBServicio;
    }

    function getMontoTBServicio(){
        return $this->montoTBServicio;
    }

    function getActivoTBServicio(){
        return $this->activoTBServicio;
    }

};