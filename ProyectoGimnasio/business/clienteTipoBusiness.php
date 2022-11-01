<?php
include '../data/clienteTipoData.php';

class ClienteTipoBusiness{

    public function ClienteTipoBusiness() {
        $this->ClienteTipoData = new ClienteTipoData();
    }

    public function insertar($clienteTipo) {
        return $this->ClienteTipoData->insertClienteTipo($clienteTipo);
    }

    public function update($clienteTipo) {
        return $this->ClienteTipoData->updateClienteTipo($clienteTipo);
    }

    public function delete($idTBGrupoMuscular) {
        return $this->ClienteTipoData->deleteClienteTipo($idTBGrupoMuscular);
    }

    public function obtener() {
        return $this->ClienteTipoData->getClienteTipo();
    }

    public function buscar($palabra) { 
        return $this->ClienteTipoData->buscarClienteTipo($palabra);
    }
}