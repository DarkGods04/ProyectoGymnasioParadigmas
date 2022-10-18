<?php

class Instructor {

    private $idTBInstructor;
    private $nombreTBInstructor;
    private $apellidoTBInstructor;
    private $correoTBInstructor;
    private $telefonoTBInstructor;
    private $numcuentaTBInstructor;
    private $tipoTBInstructor;
    private $activoTBInstructor;

    function Instructor($idTBInstructor, $nombreTBInstructor,$apellidoTBInstructor, $correoTBInstructor, $telefonoTBInstructor, $numcuentaTBInstructor, $tipoTBInstructor, $activoTBInstructor) {
        $this->idTBInstructor = $idTBInstructor;
        $this->nombreTBInstructor = $nombreTBInstructor;
        $this->apellidoTBInstructor = $apellidoTBInstructor;
        $this->correoTBInstructor = $correoTBInstructor;
        $this->telefonoTBInstructor = $telefonoTBInstructor;
        $this->numcuentaTBInstructor = $numcuentaTBInstructor;
        $this->tipoTBInstructor = $tipoTBInstructor;
        $this->activoTBInstructor = $activoTBInstructor;
    }

    function getIdTBInstructor() {
        return $this->idTBInstructor;
    }
    
    function getNombreTBInstructor() {
        return $this->nombreTBInstructor;
    }

    function setNombreTBInstructor($nombreTBInstructor) {
        $this->nombreTBInstructor = $nombreTBInstructor;
    }

    function getApellidoTBInstructor() {
        return $this->apellidoTBInstructor;
    }

    function setApellidoTBInstructor($apellidoTBInstructor) {
        $this->apellidoTBInstructor = $apellidoTBInstructor;
    }

    function getCorreoTBInstructor() {
        return $this->correoTBInstructor;
    }

    function setCorreoTBInstructor($correoTBInstructor) {
        $this->correoTBInstructor = $correoTBInstructor;
    }

    function getTelefonoTBInstructor() {
        return $this->telefonoTBInstructor;
    }

    function setTelefonoTBInstructor($telefonoTBInstructor) {
        $this->telefonoTBInstructor = $telefonoTBInstructor;
    }

    function getNumCuentaTBInstructor() {
        return $this->numcuentaTBInstructor;
    }

    function setNumCuentaTBInstructor($numcuentaTBInstructor) {
        $this->numcuentaTBInstructor = $numcuentaTBInstructor;
    }

    function getTipoTBInstructor() {
        return $this->tipoTBInstructor;
    }

    function setTipoTBInstructor($tipoTBInstructor) {
        $this->tipoTBInstructor = $tipoTBInstructor;
    }

    function getActivoTBInstructor() {
        return $this->activoTBInstructor;
    }

    function setActivoTBInstructor($activoTBInstructor) {
        $this->activoTBInstructor = $activoTBInstructor;
    }

}