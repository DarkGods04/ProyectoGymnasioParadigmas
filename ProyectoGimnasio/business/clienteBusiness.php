<?php

include '../data/clienteData.php';

class ClienteBusiness {

    public function ClienteBusiness() {
        $this->ClienteData = new ClienteData();
    }

    public function insertar($cliente) {
        return $this->ClienteData->insertCliente($cliente);
    }

    public function update($cliente) {
        return $this->ClienteData->updateCliente($cliente);
    }

    public function delete($id) {
        return $this->ClienteData->deleteCliente($id);
    }

    public function recuperar($id){
        return $this->ClienteData->recuperarCliente($id);
    }

    public function obtener() {
        return $this->ClienteData->getClientes();
    }

    public function buscar($palabra) {
        return $this->ClienteData->buscarClientes($palabra);
    }

    public function buscarRecuperar($palabra) {
        return $this->ClienteData->buscarClientesDesactivados($palabra);
    }

}
