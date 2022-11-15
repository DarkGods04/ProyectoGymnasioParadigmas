<?php

include '../data/facturaDetalleData.php';

class FacturaDetalleBusiness {

    public function FacturaDetalleBusiness() {
        $this->FacturaDetalleData = new FacturaDetalleData();
    }

    public function insertar($facturaDetalle) {
        return $this->FacturaDetalleData->insertFacturaDetalle($facturaDetalle);
    }

    public function delete($id) {
        return $this->FacturaDetalleData->deleteFacturaDetalle($id);
    }

    public function obtener() {
        return $this->FacturaDetalleData->getFacturaDetalle();
    }
}
