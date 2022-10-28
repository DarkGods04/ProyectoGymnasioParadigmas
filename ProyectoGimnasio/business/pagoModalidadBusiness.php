<?php

include '../data/pagoModalidadData.php';

class PagoModalidadBusiness {

    public function PagoModalidadBusiness() {
        $this->PagoModalidadData = new PagoModalidadData();
    }

    public function insertar($pagoModalidad) {
        return $this->PagoModalidadData->insertPagoModalidad($pagoModalidad);
    }

    public function update($pagoModalidad) {
        return $this->PagoModalidadData->updatePagoModalidad($pagoModalidad);
    }

    public function delete($id) {
        return $this->PagoModalidadData->deletePagoModalidad($id);
    }

    public function obtener() { 
        return $this->PagoModalidadData->getPagoModalidad();
    }

    public function buscar($palabra) { 
        return $this->PagoModalidadData->buscarPagoModalidad($palabra);
    }

}