<?php 

class ImpuestoVenta{

    private $idImpuestoVenta;
    private $valorImpuestoVenta;
    private $descripcionImpuestoVenta;
    private $activoImpuestoVenta;

    function ImpuestoVenta($idImpuestoVenta,$valorImpuestoVenta,$descripcionImpuestoVenta,$activoImpuestoVenta){
        $this->idImpuestoVenta = $idImpuestoVenta;
        $this->valorImpuestoVenta = $valorImpuestoVenta;
        $this->descripcionImpuestoVenta = $descripcionImpuestoVenta;
        $this->activoImpuestoVenta = $activoImpuestoVenta;
    }

    public function getidImpuestoVenta(){
        return $this->idImpuestoVenta;
    }

    function setIdActivo($idImpuestoVenta){
        $this->idImpuestoVenta = $idImpuestoVenta;
    }

    function getValorImpuestoVenta(){
        return $this->valorImpuestoVenta;
    }

    function setValorImpuestoVenta($valorImpuestoVenta){
        $this->valorImpuestoVenta = $valorImpuestoVenta;
    }

    function getDescripcionImpuestoVenta(){
        return $this->descripcionImpuestoVenta;
    }

    function setDescripcionImpuestoVenta($descripcionImpuestoVenta){
        $this->descripcionImpuestoVenta = $descripcionImpuestoVenta;
    }

    function getActivoImpuestoVenta(){
        return $this->activoImpuestoVenta;
    }

    function setActivoImpuestoVenta($activoImpuestoVenta){
        $this->activoImpuestoVenta = $activoImpuestoVenta;
    }

}
