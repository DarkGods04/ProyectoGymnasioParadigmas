<?php

class PagoTipo{

    private $idTBPagoTipo;
    private $nombreTBPagoTipo;
    private $activoTBPagoTipo;

    function PagoTipo($idTBPagoTipo, $nombreTBPagoTipo, $activoTBPagoTipo){
        $this->idTBPagoTipo = $idTBPagoTipo;
        $this->nombreTBPagoTipo = $nombreTBPagoTipo;
        $this->activoTBPagoTipo = $activoTBPagoTipo;
    }

    public function getIDPagoTipo(){
        return $this->idTBPagoTipo;
    }

    public function getNombreTBPagoTipo(){
        return $this->nombreTBPagoTipo;
    }

    public function setNombreTBPagoTipo($nombreTBPagoTipo){
        $this->nombreTBPagoTipo = $nombreTBPagoTipo;
    }
    
    public function getActivoTBPagoTipo(){
        return $this->activoTBPagoTipo;
    }

    public function setActivoTBPagoTipo($activoTBPagoTipo){
        $this->activoTBPagoTipo = $activoTBPagoTipo;
    }
}