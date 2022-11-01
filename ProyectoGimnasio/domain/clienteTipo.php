<?php

class ClienteTipo{
    private $idTBClienteTipo;
    private $nombreTBClienteTipo;
    private $descripcionTBClienteTipo;
    private $activoTBClienteTipo;

    function ClienteTipo($idTBClienteTipo, $nombreTBClienteTipo, $descripcionTBClienteTipo, $activoTBClienteTipo){
        $this->idTBClienteTipo = $idTBClienteTipo;
        $this->nombreTBClienteTipo = $nombreTBClienteTipo;
        $this->descripcionTBClienteTipo = $descripcionTBClienteTipo;
        $this->activoTBClienteTipo = $activoTBClienteTipo;
    }

    public function getIDClienteTipo(){
        return $this->idTBClienteTipo;
    }

    public function getNombreTBClienteTipo(){
        return $this->nombreTBClienteTipo;
    }

    public function setNombreTBClienteTipo($nombreTBClienteTipo){
        $this->nombreTBClienteTipo = $nombreTBClienteTipo;
    }

    public function getDescripcionTBClienteTipo(){
        return $this->descripcionTBClienteTipo;
    }

    public function setDescripcionTBClienteTipo($descripcionTBClienteTipo){
        $this->descripcionTBClienteTipo = $descripcionTBClienteTipo;
    }
    
    public function getActivoTBClienteTipo(){
        return $this->activoTBClienteTipo;
    }

    public function setActivoTBClienteTipo($activoTBClienteTipo){
        $this->activoTBClienteTipo = $activoTBClienteTipo;
    }
}
?>