<?php

include '../data/clienteRutinaData.php';

class ClienteRutinaBusiness {

    public function ClienteRutinaBusiness() {
        $this->ClienteRutinaData = new ClienteRutinaData();
    }

    public function insertar($clienteRutina) {
        return $this->ClienteRutinaData->insertClienteRutina($clienteRutina);
    }

    public function update($clienteRutina) {
        return $this->ClienteRutinaData->updateClienteRutina($clienteRutina);
    }

    public function delete($id) {
        return $this->ClienteRutinaData->deleteClienteRutina($id);
    }

    public function obtener() {
        return $this->ClienteRutinaData->getClienteRutina();
    }

    public function obtenerTodos() {
        return $this->ClienteRutinaData->getClienteRutinaPasadas();
    }


    public function buscar($palabra) {
        return $this->ClienteRutinaData->buscarClienteRutina($palabra);
    }

}
