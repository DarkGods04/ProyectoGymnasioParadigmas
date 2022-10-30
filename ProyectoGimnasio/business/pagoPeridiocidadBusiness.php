<?php
include '../data/pagoPeridiocidadData.php';

class PagoPeridiocidadBusiness {

    public function PagoPeridiocidadBusiness() {
        $this->PagoPeridiocidadData = new PagoPeridiocidadData();
    }

    public function insertar($pagoPeridiocidad) {
        return $this->PagoPeridiocidadData->insertPagoPeridiocidad($pagoPeridiocidad);
    }

    public function update($pagoPeridiocidad) {
        return $this->PagoPeridiocidadData->updatePagoPeridiocidad($pagoPeridiocidad);
    }

    public function delete($id) {
        return $this->PagoPeridiocidadData->deletePagoPeridiocidad($id);
    }

    public function obtener() { 
        return $this->PagoPeridiocidadData->getPagoPeridiocidad();
    }

    public function buscar($palabra) { 
        return $this->PagoPeridiocidadData->buscarPagoPeridiocidad($palabra);
    }

}