<?php

include '../data/impuestoVentaData.php';

class ImpuestoVentaBusiness {

    public function ImpuestoVentaBusiness() {
        $this->ImpuestoVentaData = new ImpuestoVentaData();
    }

    public function insertar($impuestoVenta) {
        return $this->ImpuestoVentaData->insertImpuestoVenta($impuestoVenta);
    }

    public function update($impuestoVenta) {
        return $this->ImpuestoVentaData->updateImpuestoVenta($impuestoVenta);
    }

    public function delete($id) {
        return $this->ImpuestoVentaData->deleteImpuestoVenta($id);
    }

    public function obtener() {
        return $this->ImpuestoVentaData->getImpuestoVenta();
    }

    public function buscar($palabra) {
        return $this->ImpuestoVentaData->buscarImpuestoVenta($palabra);
    }

}