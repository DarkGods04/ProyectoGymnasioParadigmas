<?php
include '../data/categorizacionClienteData.php';

class CategorizacionClienteBusiness{

    public function CategorizacionClienteBusiness() {
        $this->CategorizacionClienteData = new CategorizacionClienteData();
    }

    public function insertar($categorizacion) {
        return $this->CategorizacionClienteData->insertCategorizacionCliente($categorizacion);
    }

    public function update($categorizacion) {
        return $this->CategorizacionClienteData->updateCategorizacionCliente($categorizacion);
    }

    public function delete($idCategorizacion) {
        return $this->CategorizacionClienteData->deleteCategorizacionCliente($idCategorizacion);
    }

    public function obtener() {
        return $this->CategorizacionClienteData->getCategorizacionCliente();
    }

    public function buscar($palabra) { 
        return $this->CategorizacionClienteData->buscarCategorizacion($palabra);
    }
}