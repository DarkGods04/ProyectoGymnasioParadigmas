<?php

include '../data/servicioData.php';

class ServicioBusiness {

    private $servicioData;

    public function ServicioBusiness() {
        $this->servicioData = new ServicioData();
    }

    public function insertar($servicio) {
        return $this->servicioData->insertServicio($servicio);
    }

    public function update($servicio) {
        return $this->servicioData->updateServicio($servicio);
    }

    public function delete($id) {
        return $this->servicioData->deleteServicio($id);
    }

    public function obtener() {
        return $this->servicioData->getServicios();
    }

    public function buscar($palabra) {
        return $this->servicioData->buscarServicios($palabra);
    }

};