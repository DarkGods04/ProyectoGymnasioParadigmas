<?php

include '../data/facturaData.php';

class FacturaBusiness {

    public function FacturaBusiness() {
        $this->FacturaData = new FacturaData();
    }

    public function insertar($factura) {
        return $this->FacturaData->insertFactura($factura);
    }

    public function update($factura) {
        return $this->FacturaData->updateFactura($factura);
    }

    public function delete($id) {
        return $this->FacturaData->deleteFactura($id);
    }

    public function obtener() {
        return $this->FacturaData->getFacturas();
    }

    public function buscar($palabra) {
        return $this->FacturaData->buscarFactura($palabra);
    }

    public function obtenerImpuesto($id) {
        return $this->FacturaData->obtenerValorImpuesto($id);
    }
}
