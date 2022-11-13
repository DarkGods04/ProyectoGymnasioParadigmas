<?php 

class Ejercicio{

    private $idEjercicio;
    private $nombreEjercicio;
    private $descripcionEjercicio;
    private $activoEjercicio;

    function Ejercicio($idEjercicio,$nombreEjercicio,$descripcionEjercicio,$activoEjercicio){
        $this->idEjercicio = $idEjercicio;
        $this->nombreEjercicio = $nombreEjercicio;
        $this->descripcionEjercicio = $descripcionEjercicio;
        $this->activoEjercicio = $activoEjercicio;
    }

    public function getIdEjercicio(){
        return $this->idEjercicio;
    }

    function setIdEjercicio($idEjercicio){
        $this->idEjercicio = $idEjercicio;
    }

    function getNombreEjercicio(){
        return $this->nombreEjercicio;
    }

    function setNombreEjercicio($nombreEjercicio){
        $this->nombreEjercicio = $nombreEjercicio;
    }

    function getDescripcionEjercicio(){
        return $this->descripcionEjercicio;
    }

    function setDescripcionEjercicio($descripcionEjercicio){
        $this->descripcionEjercicio = $descripcionEjercicio;
    }

    function getActivoEjercicio(){
        return $this->activoEjercicio;
    }

    function setActivoEjercicio($activoEjercicio){
        $this->activoEjercicio = $activoEjercicio;
    }

}
