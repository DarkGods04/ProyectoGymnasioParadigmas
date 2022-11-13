<?php

include '../data/ejercicioData.php';

class EjercicioBusiness {

    public function EjercicioBusiness() {
        $this->EjercicioData = new EjercicioData();
    }

    public function insertar($ejercicio) {
        return $this->EjercicioData->insertEjercicio($ejercicio);
    }

    public function update($ejercicio) {
        return $this->EjercicioData->updateEjercicio($ejercicio);
    }

    public function delete($id) {
        return $this->EjercicioData->deleteEjercicio($id);
    }

    public function obtener() {
        return $this->EjercicioData->getEjercicio();
    }

    public function buscar($palabra) {
        return $this->EjercicioData->buscarEjercicio($palabra);
    }

}