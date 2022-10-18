<?php

class ModalidadFuncional{

    private $idTBModalidadFuncional;
    private $nombreTBModalidadFuncional;
    private $descripcionTBModalidadFuncional;
    private $activoTBModalidadFuncional;

    function ModalidadFuncional($idTBModalidadFuncional, $nombreTBModalidadFuncional, $descripcionTBModalidadFuncional, $activoTBModalidadFuncional){
        $this->idTBModalidadFuncional = $idTBModalidadFuncional;
        $this->nombreTBModalidadFuncional = $nombreTBModalidadFuncional;
        $this->descripcionTBModalidadFuncional = $descripcionTBModalidadFuncional;
        $this->activoTBModalidadFuncional = $activoTBModalidadFuncional;
    }

    function setNombreTBModalidadFuncional($nombreTBModalidadFuncional){
        $this->nombreTBModalidadFuncional = $nombreTBModalidadFuncional;
    }

    function setDescripcionTBModalidadFuncional($descripcionTBModalidadFuncional){
        $this->descripcionTBModalidadFuncional = $descripcionTBModalidadFuncional;
    }

    function setActivoTBModalidadFuncional($activoTBModalidadFuncional){
        $this->activoTBModalidadFuncional = $activoTBModalidadFuncional;
    }

    function getIdTBModalidadFuncional(){
        return $this->idTBModalidadFuncional;
    }

    function getNombreTBModalidadFuncional(){
        return $this->nombreTBModalidadFuncional;
    }

    function getDescripcionTBModalidadFuncional(){
        return $this->descripcionTBModalidadFuncional;
    }

    function getActivoTBModalidadFuncional(){
        return $this->activoTBModalidadFuncional;
    }

};