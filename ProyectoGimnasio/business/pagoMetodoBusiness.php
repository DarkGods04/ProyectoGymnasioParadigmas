<?php
include '../data/pagoMetodoData.php';

class PagoMetodoBusiness{

    public function PagoMetodoBusiness() {
        $this->PagoMetodoData = new PagoMetodoData();
    }

    public function insertar($pagoMetodo) {
        return $this->PagoMetodoData->insertPagoMetodo($pagoMetodo);
    }

    public function update($pagoMetodo) {
        return $this->PagoMetodoData->updatePagoMetodo($pagoMetodo);
    }

    public function delete($idTBPagoMetodo) {
        return $this->PagoMetodoData->deletePagoMetodo($idTBPagoMetodo);
    }

    public function obtener() {
        return $this->PagoMetodoData->getPagoMetodos();
    }

    public function buscar($palabra) { 
        return $this->PagoMetodoData->buscarPagoMetodo($palabra);
    }
    
}