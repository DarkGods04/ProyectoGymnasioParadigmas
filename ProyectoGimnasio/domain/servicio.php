<?php

class Servicio{

    private $idTBServicio;
    private $nombreTBServicio;
    private $descripcionTBServicio;
    private $montoTBServicio;
    private $activoTBServicio;
    private $periodicidadTBServicio;
    private $fechaactualizacionTBServicio;

    function __construct($idTBServicio, $nombreTBServicio, $descripcionTBServicio, $montoTBServicio, $activoTBServicio, $periodicidadTBServicio,$fechaactualizacionTBServicio){
        $this->idTBServicio = $idTBServicio;
        $this->nombreTBServicio = $nombreTBServicio;
        $this->descripcionTBServicio = $descripcionTBServicio;
        $this->montoTBServicio = $montoTBServicio;
        $this->activoTBServicio = $activoTBServicio;
        $this->periodicidadTBServicio = $periodicidadTBServicio;
        $this->fechaactualizacionTBServicio = $fechaactualizacionTBServicio;
    }

    function setNombreTBServicio($nombreTBServicio){
        $this->nombreTBServicio = $nombreTBServicio;
    }

    function setFechaactualizacionTBServicio($fechaactualizacionTBServicio){
        $this->fechaactualizacionTBServicio = $fechaactualizacionTBServicio;
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

    function setPeriodicidadTBServicio($periodicidadTBServicio){
        $this->periodicidadTBServicio = $periodicidadTBServicio;
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

    function getPeriodicidadTBServicio(){
        return $this->periodicidadTBServicio;
    }

    function getFechaactualizacionTBServicio(){
        return $this->fechaactualizacionTBServicio;
    }
};
