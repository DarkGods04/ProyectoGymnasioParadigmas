<?php

include '../data/activoVariableData.php';

class ActivoVariableBusiness {

    public function ActivoVariableBusiness() {
        $this->ActivoVariableData = new ActivoVariableData();
    }

    public function insertar($activoVariable) {
        return $this->ActivoVariableData->insertActivoVariable($activoVariable);
    }

    public function update($activoVariable) {
        return $this->ActivoVariableData->updateActivoVariable($activoVariable);
    }

    public function delete($id) {
        return $this->ActivoVariableData->deleteActivoVariable($id);
    }

    public function obtener() { 
        return $this->ActivoVariableData-> getActivoVariable();
    }

    public function buscar($palabra) { 
        return $this->ActivoVariableData-> buscarActivoVariable($palabra);
    }

}
