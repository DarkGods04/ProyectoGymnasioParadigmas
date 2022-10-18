<?php

include '../data/modalidadFuncionalData.php';

class ModalidadFuncionalBusiness {

    private $modalidadFuncionalData;

    public function ModalidadFuncionalBusiness() {
        $this->modalidadFuncionalData = new ModalidadFuncionalData();
    }

    public function insertar($mondalidadFuncional) {
        return $this->modalidadFuncionalData->insertModalidadFuncional($mondalidadFuncional);
    }

    public function update($mondalidadFuncional) {
        return $this->modalidadFuncionalData->updateModalidadFuncional($mondalidadFuncional);
    }

    public function delete($id) {
        return $this->modalidadFuncionalData->deleteModalidadFuncional($id);
    }

    public function obtener() {
        return $this->modalidadFuncionalData->getModalidadesFuncionales();
    }

    public function buscar($palabra) {
        return $this->modalidadFuncionalData->buscarModalidadesFuncionales($palabra);
    }

};