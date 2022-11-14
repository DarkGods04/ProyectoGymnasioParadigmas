<?php

include '../data/productoData.php';

class ProductoBusiness {

    public function ProductoBusiness() {
        $this->ProductoData = new ProductoData();
    }

    public function insertar($producto) {
        return $this->ProductoData->insertProducto($producto);
    }

    public function update($producto) {
        return $this->ProductoData->updateProducto($producto);
    }

    public function delete($id) {
        return $this->ProductoData->deleteProducto($id);
    }

    public function obtener() {
        return $this->ProductoData->getProductos();
    }

    public function buscar($palabra) {
        return $this->ProductoData->buscarProductos($palabra);
    }

}
