<?php

include '../data/pagoTipoData.php';

class PagoTipoBusiness{

    public function PagoTipoBusiness() {
        $this->PagoTipoData = new PagoTipoData();
    }

    public function insertar($pagoTipo) {
        return $this->PagoTipoData->insertPagoTipo($pagoTipo);
    }

    public function update($pagoTipo) {
        return $this->PagoTipoData->updatePagoTipo($pagoTipo);
    }

    public function delete($idTBPagoTipo) {
        return $this->PagoTipoData->deletePagoTipo($idTBPagoTipo);
    }

    public function getPagosTipo() {
        return $this->PagoTipoData->getPagosTipo();
    }
}