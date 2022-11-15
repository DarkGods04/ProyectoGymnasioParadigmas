<?php

include '../data/compraData.php';

class CompraBusiness {

    public function CompraBusiness() {
        $this->CompraData = new CompraData();
    }

    public function insertar($compra) {
        return $this->CompraData->insertCompra($compra);
    }

    public function update($compra) {
        return $this->CompraData->updateCompra($compra);
    }

    public function delete($id) {
        return $this->CompraData->deleteCompra($id);
    }

    public function obtener() {
        return $this->CompraData->getCompras();
    }

    public function buscar($palabra) {
        return $this->CompraData->buscarCompra($palabra);
    }

    
}
