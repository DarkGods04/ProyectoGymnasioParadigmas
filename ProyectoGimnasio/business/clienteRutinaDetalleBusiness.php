<?php

include '../data/clienteRutinaDetalleData.php';

class ClienteRutinaDetalleBusiness {

    public function ClienteRutinaDetalleBusiness() {
        $this->ClienteRutinaDetalleData = new ClienteRutinaDetalleData();
    }

    public function insertar($clienteRutinaDetalle) {
        return $this->ClienteRutinaDetalleData->insertClienteRutinaDetalle($clienteRutinaDetalle);
    }

    public function update($clienteRutinaDetalle) {
        return $this->ClienteRutinaDetalleData->updateClienteRutinaDetalle($clienteRutinaDetalle);
    }

    public function obtener() {
        return $this->ClienteRutinaDetalleData->getClienteRutinaDetalle();
    }

    public function buscar($palabra) {
        return $this->ClienteRutinaDetalleData->buscarClienteRutinaDetalle($palabra);
    }

}
