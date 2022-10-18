<?php

include '../data/activoFijoData.php';

class ActivoFijoBusiness {

    public function ActivoFijoBusiness() {
        $this->ActivoFijoData = new ActivoFijoData();
    }

    public function insertar($activoFijo) {
        return $this->ActivoFijoData->insertActivoFijo($activoFijo);
    }

    public function update($activoFijo) {
        return $this->ActivoFijoData->updateActivoFijo($activoFijo);
    }

    public function delete($id) {
        return $this->ActivoFijoData->deleteActivoFijo($id);
    }

    public function obtener() {
        return $this->ActivoFijoData->getActivoFijo();
    }

    public function buscar($palabra) {
        return $this->ActivoFijoData->buscarActivoFijo($palabra);
    }

}