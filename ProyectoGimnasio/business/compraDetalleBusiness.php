<?php

include '../data/compraDetalleData.php';

class CompraDetalleBusiness {

    public function CompraDetalleBusiness() {
        $this->CompraDetalleData = new CompraDetalleData();
    }

    public function insertar($compraDetalle) {
        return $this->CompraDetalleData->insertCompraDetalle($compraDetalle);
    }

    public function update($compraDetalle) {
        return $this->CompraDetalleData->updateCompraDetalle($compraDetalle);
    }

    public function delete($id) {
        return $this->CompraDetalleData->deleteCompraDetalle($id);
    }

    public function obtener() {
        return $this->CompraDetalleData->getComprasDetalles();
    }

    public function buscar($palabra) {
        return $this->CompraDetalleData->buscarCompraDetalle($palabra);
    }

    
}