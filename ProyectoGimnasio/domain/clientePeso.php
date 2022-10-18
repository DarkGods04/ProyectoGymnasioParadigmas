<?php
 
class ClientePeso{

    private $clientePesoID;
    private $clienteID;
    private $clientePesoFecha;
    private $clientePesoPeso;
    private $instructorID;

    function ClientePeso($clientePesoID, $clienteID, $clientePesoFecha, $clientePesoPeso, $instructorID){
        $this->clientePesoID = $clientePesoID;
        $this->clienteID = $clienteID;
        $this->clientePesoFecha = $clientePesoFecha;
        $this->clientePesoPeso = $clientePesoPeso;
        $this->instructorID = $instructorID;
    }

    function setClientePesoID($clientePesoID){
        $this->clientePesoID = $clientePesoID;
    }

    function setClienteID($clienteNombre){
        $this->clienteID = $clienteID;
    }

    function setClientePesoFecha($clientePesoFecha){
        $this->clientePesoFecha = $clientePesoFecha;
    }

    function setClientePesoPeso($clientePesoPeso){
        $this->clientePesoPeso = $clientePesoPeso;
    }

    function setInstructorID($instructorID){
        $this->instructorID = $instructorID;
    }

    function getClientePesoID(){
        return $this->clientePesoID;
    }

    function getClienteID(){
        return $this->clienteID;
    }

    function getClientePesoFecha(){
        return $this->clientePesoFecha;
    }

    function getClientePesoPeso(){
        return $this->clientePesoPeso;
    }
    
    function getInstructorID(){
        return $this->instructorID;
    }

}