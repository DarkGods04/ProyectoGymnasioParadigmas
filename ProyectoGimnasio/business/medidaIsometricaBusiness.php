<?php

include '../data/medidaIsometricaData.php';

class MedidaIsometricaBusiness {

    public function MedidaIsometricaBusiness() {
        $this-> MedidaIsometricaData = new MedidaIsometricaData();
    }

    public function insertar($medida) {
        return $this->MedidaIsometricaData->insertMedida($medida);
    }

    public function update($medida) {
        return $this->MedidaIsometricaData->updateMedida($medida);
    }

    public function delete($id) {
        return $this->MedidaIsometricaData->deleteMedida($id);
    }

    public function obtener() {
        return $this->MedidaIsometricaData->getMedida();
    }

    public function buscar($palabra) {
        return $this->MedidaIsometricaData->buscarMedida($palabra);
    }

}