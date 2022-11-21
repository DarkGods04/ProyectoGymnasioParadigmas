<?php 

class ClienteRutinaDetalle{

    private $idClienteRutinaDetalle;
    private $idClienteRutina;
    private $idEjercicio;

    function ClienteRutinaDetalle($idClienteRutinaDetalle,$idClienteRutina,$idEjercicio){
        $this->idClienteRutinaDetalle = $idClienteRutinaDetalle;
        $this->idClienteRutina = $idClienteRutina;
        $this->idEjercicio = $idEjercicio;
    }

    public function getIdClienteRutinaDetalle(){
        return $this->idClienteRutinaDetalle;
    }

    function setIdClienteRutinaDetalle($idClienteRutinaDetalle){
        $this->idClienteRutinaDetalle = $idClienteRutinaDetalle;
    }

    function getIdClienteRutina(){
        return $this->idClienteRutina;
    }

    function setIdClienteRutina($idClienteRutina){
        $this->idClienteRutina = $idClienteRutina;
    }

    function getIdEjercicio(){
        return $this->idEjercicio;
    }

    function setIdEjercicio($idEjercicio){
        $this->idEjercicio = $idEjercicio;
    }

}
