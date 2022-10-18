<?php 

class ActivoFijo{

    private $idActivo;
    private $placa;
    private $serie;
    private $modelo;
    private $fechaCompra;
    private $montoCompra;
    private $estadoUso;
    private $activo;

    function ActivoFijo($idActivo,$placa,$serie,$modelo,$fechaCompra,$montoCompra,$estadoUso,$activo){
        $this->idActivo = $idActivo;
        $this->placa = $placa;
        $this->serie = $serie;
        $this->modelo = $modelo;
        $this->fechaCompra = $fechaCompra;
        $this->montoCompra = $montoCompra;
        $this->estadoUso = $estadoUso;
        $this->activo = $activo;
    }

    public function getIdActivo(){
        return $this->idActivo;
    }

    function setIdActivo($idActivo){
        $this->idActivo = $idActivo;
    }

    function getplaca(){
        return $this->placa;
    }

    function setplaca($placa){
        $this->placa = $placa;
    }

    function getserie(){
        return $this->serie;
    }

    function setserie($serie){
        $this->serie = $serie;
    }

    function getmodelo(){
        return $this->modelo;
    }

    function setmodelo($modelo){
        $this->modelo = $modelo;
    }

    function getfechaCompra(){
        return $this->fechaCompra;
    }

    function setfechaCompra($fechaCompra){
        $this->fechaCompra = $fechaCompra;
    }

    function getMontoCompra(){
       return $this->montoCompra;
    }

    function setMontoCompra($montoCompra){
        $this->montoCompra = $montoCompra;
    }

    function getestadoUso(){
        return $this->estadoUso;
    }

    function setestadoUso($estadoUso){
        $this->estadoUso = $estadoUso;
    }

    function getActivo(){
        return $this->activo;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }

}

?>