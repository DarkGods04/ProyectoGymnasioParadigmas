<?php
include '../data/grupoMuscularData.php';

class GrupoMuscularBusiness{

    public function GrupoMuscularBusiness() {
        $this->GrupoMuscularData = new GrupoMuscularData();
    }

    public function insertar($grupoMuscular) {
        return $this->GrupoMuscularData->insertGrupoMuscular($grupoMuscular);
    }

    public function update($grupoMuscular) {
        return $this->GrupoMuscularData->updateGrupoMuscular($grupoMuscular);
    }

    public function delete($idTBGrupoMuscular) {
        return $this->GrupoMuscularData->deleteGrupoMuscular($idTBGrupoMuscular);
    }

    public function obtener() {
        return $this->GrupoMuscularData->getGrupoMuscular();
    }

    public function buscar($palabra) { 
        return $this->GrupoMuscularData->buscarGrupoMuscular($palabra);
    }
}