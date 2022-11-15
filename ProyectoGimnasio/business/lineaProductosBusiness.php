<?php
include '../data/lineaProductosData.php';

class LineaProductosBusiness {

    public function LineaProductosBusiness() {
        $this->LineaProductosData = new LineaProductosData();
    }

    public function insertar($lineaProductos) {
        return $this->LineaProductosData->insertLineaProductos($lineaProductos);
    }

    public function update($lineaProductos) {
        return $this->LineaProductosData->updateLineaProductos($lineaProductos);
    }

    public function delete($id) {
        return $this->LineaProductosData->deleteLineaProductos($id);
    }

    public function obtener() { 
        return $this->LineaProductosData->getLineaProductos();
    }

    public function buscar($palabra) { 
        return $this->LineaProductosData->buscarLineaProductos($palabra);
    }

}