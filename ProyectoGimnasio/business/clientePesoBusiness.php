<?php

include '../data/clientePesoData.php';

class ClientePesoBusiness{

    public function ClientePesoBusiness() {
        $this->ClientePesoData = new ClientePesoData();
    }

    public function insertar($clientepeso) {
        return $this->ClientePesoData->insertarClientePeso($clientepeso);
    }

    public function obtener() {
        return $this->ClientePesoData->obtenerClientePeso();
    }

    public function buscar($palabra) {
        return $this->ClientePesoData->buscarClientePeso($palabra);
    }

};