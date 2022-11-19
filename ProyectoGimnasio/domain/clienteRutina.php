<?php
 
class ClienteRutina{

    private $idTBClienteRutina;
    private $idTBCliente;
    private $idTBIstructor;
    private $idTBModalidadFuncional;
    private $fechaTBClienteRutina;
    private $activoTBClienteRutina;

    function ClienteRutina($idTBClienteRutina, $idTBCliente, $idTBIstructor, $idTBModalidadFuncional,$fechaTBClienteRutina,$activoTBClienteRutina) {
		$this->$idTBClienteRutina = $idTBClienteRutina;
        $this->idTBCliente = $idTBCliente;
        $this->$idTBIstructor = $idTBIstructor;
        $this->$idTBModalidadFuncional = $idTBModalidadFuncional;
        $this->fechaTBClienteRutina = $fechaTBClienteRutina;
        $this->activoTBClienteRutina = $activoTBClienteRutina;
	}

	public function getIdTBClienteRutina() {
		return $this->idTBClienteRutina;
	}

	public function setIdTBClienteRutina($idTBClienteRutina) {
		$this->idTBClienteRutina = $idTBClienteRutina;
	}

	public function getIdTBCliente() {
		return $this->idTBCliente;
	}

	public function setIdTBCliente($idTBCliente) {
		$this->idTBCliente = $idTBCliente;
	}

	public function getIdTBIstructor() {
		return $this->idTBIstructor;
	}

	public function setIdTBIstructor($idTBIstructor) {
		$this->idTBIstructor = $idTBIstructor;
	}

	public function getIdTBModalidadFuncional() {
		return $this->idTBModalidadFuncional;
	}

	public function setIdTBModalidadFuncional($idTBModalidadFuncional) {
		$this->idTBModalidadFuncional = $idTBModalidadFuncional;
	}

	public function getFechaTBClienteRutina() {
		return $this->fechaTBClienteRutina;
	}

	public function setFechaTBClienteRutina($fechaTBClienteRutina) {
		$this->fechaTBClienteRutina = $fechaTBClienteRutina;
	}
    
	public function getActivoTBClienteRutina() {
		return $this->activoTBClienteRutina;
	}

	public function setActivoTBClienteRutina($activoTBClienteRutina) {
		$this->activoTBClienteRutina = $activoTBClienteRutina;
	}

}
?>