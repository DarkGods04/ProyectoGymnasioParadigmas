<?php

class GrupoMuscular{
    private $idTBGrupoMuscular;
    private $nombreTBGrupoMuscular;
    private $descripcionTBGrupoMuscular;
    private $activoTBGrupoMuscular;

    function GrupoMuscular($idTBGrupoMuscular, $nombreTBGrupoMuscular, $descripcionTBGrupoMuscular, $activoTBGrupoMuscular){
        $this->idTBGrupoMuscular = $idTBGrupoMuscular;
        $this->nombreTBGrupoMuscular = $nombreTBGrupoMuscular;
        $this->descripcionTBGrupoMuscular = $descripcionTBGrupoMuscular;
        $this->activoTBGrupoMuscular = $activoTBGrupoMuscular;
    }

    public function getIDGrupoMuscular(){
        return $this->idTBGrupoMuscular;
    }

    public function getNombreTBGrupoMuscular(){
        return $this->nombreTBGrupoMuscular;
    }

    public function setNombreTBGrupoMuscular($nombreTBGrupoMuscular){
        $this->nombreTBGrupoMuscular = $nombreTBGrupoMuscular;
    }

    public function getDescripcionTBGrupoMuscular(){
        return $this->descripcionTBGrupoMuscular;
    }

    public function setDescripcionTBGrupoMuscular($descripcionTBGrupoMuscular){
        $this->descripcionTBGrupoMuscular = $descripcionTBGrupoMuscular;
    }
    
    public function getActivoTBGrupoMuscular(){
        return $this->activoTBGrupoMuscular;
    }

    public function setActivoTBGrupoMuscular($activoTBGrupoMuscular){
        $this->activoTBGrupoMuscular = $activoTBGrupoMuscular;
    }
}
?>