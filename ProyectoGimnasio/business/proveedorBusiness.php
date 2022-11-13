<?php

include '../data/proveedorData.php';

class ProveedorBusiness {

    private $proveedorData;

    public function ProveedorBusiness() {
        $this->proveedorData = new ProveedorData();
    }

    public function insertar($proveedor) {
        return $this->proveedorData->insertProveedor($proveedor);
    }

    public function update($proveedor) {
        return $this->proveedorData->updateProveedor($proveedor);
    }

    public function delete($id) {
        return $this->proveedorData->deleteProveedor($id);
    }

    public function obtener() {
        return $this->proveedorData->getProveedores();
    }

    public function buscar($palabra) {
        return $this->proveedorData->buscarProveedores($palabra);
    }

}