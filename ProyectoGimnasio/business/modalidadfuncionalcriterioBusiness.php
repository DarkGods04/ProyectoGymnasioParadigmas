<?php

include '../data/modalidadfuncionalcriterioData.php';

class ModalidadfuncionalcriterioBusiness {

    private $modalidadfuncionalcriterioData;


    public function ModalidadfuncionalcriterioBusiness() {
        $this->modalidadfuncionalcriterioData = new ModalidadfuncionalcriterioData();
    }

    public function insertar($modalidadfuncionalcriterio) {
        return $this->modalidadfuncionalcriterioData->insertModalidadfuncionalcriterio($modalidadfuncionalcriterio);
    }

    public function update($modalidadfuncionalcriterio) {
        return $this->modalidadfuncionalcriterioData->updateModalidadfuncionalcriterio($modalidadfuncionalcriterio);
    }

    public function delete($id) {
        return $this->modalidadfuncionalcriterioData->deleteModalidadfuncionalcriterio($id);
    }

    public function obtener() {
        return $this->modalidadfuncionalcriterioData->getModalidadfuncionalcriterio();
    }

    public function buscar($palabra) {
        return $this->modalidadfuncionalcriterioData->buscarModalidadfuncionalcriterio($palabra);
    }

}