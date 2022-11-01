<?php

class RutinaNivel{
    private $idTBRutinaNivel;
    private $nombreTBRutinaNivel;
    private $descripcionTBRutinaNivel;
    private $activoTBRutinaNivel;

    function RutinaNivel($idTBRutinaNivel, $nombreTBRutinaNivel, $descripcionTBRutinaNivel, $activoTBRutinaNivel){
        $this->idTBRutinaNivel = $idTBRutinaNivel;
        $this->nombreTBRutinaNivel = $nombreTBRutinaNivel;
        $this->descripcionTBRutinaNivel = $descripcionTBRutinaNivel;
        $this->activoTBRutinaNivel = $activoTBRutinaNivel;
    }

    public function getIDRutinaNivel(){
        return $this->idTBRutinaNivel;
    }

    public function getNombreTBRutinaNivel(){
        return $this->nombreTBRutinaNivel;
    }

    public function setNombreTBRutinaNivel($nombreTBRutinaNivel){
        $this->nombreTBRutinaNivel = $nombreTBRutinaNivel;
    }

    public function getDescripcionTBRutinaNivel(){
        return $this->descripcionTBRutinaNivel;
    }

    public function setDescripcionTBRutinaNivel($descripcionTBRutinaNivel){
        $this->descripcionTBRutinaNivel = $descripcionTBRutinaNivel;
    }
    
    public function getActivoTBRutinaNivel(){
        return $this->activoTBRutinaNivel;
    }

    public function setActivoTBRutinaNivel($activoTBRutinaNivel){
        $this->activoTBRutinaNivel = $activoTBRutinaNivel;
    }
}
?>