<?php
include '../data/rutinaNivelData.php';

class RutinaNivelBusiness{

    public function RutinaNivelBusiness() {
        $this->RutinaNivelData = new RutinaNivelData();
    }

    public function insertar($rutinaNivel) {
        return $this->RutinaNivelData->insertRutinaNivel($rutinaNivel);
    }

    public function update($rutinaNivel) {
        return $this->RutinaNivelData->updateRutinaNivel($rutinaNivel);
    }

    public function delete($idTBGrupoMuscular) {
        return $this->RutinaNivelData->deleteRutinaNivel($idTBGrupoMuscular);
    }

    public function obtener() {
        return $this->RutinaNivelData->getRutinaNivel();
    }

    public function buscar($palabra) { 
        return $this->RutinaNivelData->buscarRutinaNivel($palabra);
    }
}