<?php
 
class cliente{

    private $idTBCliente;
    private $nombreTBCliente;
    private $apellido1TBCliente;
    private $apellido2TBCliente;
    private $telefonoTBCliente;
    private $fechaNacimientoTBCliente;
    private $generoTBCliente;
    private $pesoTBCliente;
    private $alturaTBCliente;
    private $correoTBCliente;
    private $activoTBCliente;


    function cliente($idTBCliente, $nombreTBCliente, $apellido1TBCliente, $apellido2TBCliente,$telefonoTBCliente,$fechaNacimientoTBCliente,$generoTBCliente,$pesoTBCliente,
    $alturaTBCliente,$correoTBCliente,$activoTBCliente) {
		$this->idTBCliente = $idTBCliente;
        $this->nombreTBCliente = $nombreTBCliente;
        $this->apellido1TBCliente = $apellido1TBCliente;
        $this->apellido2TBCliente = $apellido2TBCliente;
        $this->telefonoTBCliente = $telefonoTBCliente;
        $this->fechaNacimientoTBCliente = $fechaNacimientoTBCliente;
        $this->generoTBCliente = $generoTBCliente;
        $this->pesoTBCliente = $pesoTBCliente;
        $this->alturaTBCliente = $alturaTBCliente;
        $this->correoTBCliente = $correoTBCliente;
        $this->activoTBCliente = $activoTBCliente;
		
	}

	public function getIdTBCliente() {
		return $this->idTBCliente;
	}

	public function setIdTBCliente($idTBCliente) {
		$this->idTBCliente = $idTBCliente;
	}

	public function getNombreTBCliente() {
		return $this->nombreTBCliente;
	}

	public function setNombreTBCliente($nombreTBCliente) {
		$this->nombreTBCliente = $nombreTBCliente;
	}

	public function getApellido1TBCliente() {
		return $this->apellido1TBCliente;
	}

	public function setApellido1TBCliente($apellido1TBCliente) {
		$this->apellido1TBCliente = $apellido1TBCliente;
	}

	public function getApellido2TBCliente() {
		return $this->apellido2TBCliente;
	}

	public function setApellido2TBCliente($apellido2TBCliente) {
		$this->apellido2TBCliente = $apellido2TBCliente;
	}

	public function getTelefonoTBCliente() {
		return $this->telefonoTBCliente;
	}

	public function setTelefonoTBCliente($telefonoTBCliente) {
		$this->telefonoTBCliente = $telefonoTBCliente;
	}


	public function getFechaNacimientoTBCliente() {
		return $this->fechaNacimientoTBCliente;
	}

	public function setFechaNacimientoTBCliente($fechaNacimientoTBCliente) {
		$this->fechaNacimientoTBCliente = $fechaNacimientoTBCliente;
	}


    public function getPesoTBCliente() {
		return $this->pesoTBCliente;
	}

	public function setPesoTBCliente($pesoTBCliente) {
		$this->pesoTBCliente = $pesoTBCliente;
	}
    
	public function getGeneroTBCliente() {
		return $this->generoTBCliente;
	}

	public function setGeneroTBCliente($generoTBCliente) {
		$this->generoTBCliente = $generoTBCliente;
	}

	public function getAlturaTBCliente() {
		return $this->alturaTBCliente;
	}

	public function setAlturaTBCliente($alturaTBCliente) {
		$this->alturaTBCliente = $alturaTBCliente;
	}

	public function getCorreoTBCliente() {
		return $this->correoTBCliente;
	}

	public function setCorreoTBCliente($correoTBCliente) {
		$this->correoTBCliente = $correoTBCliente;
	}

	public function getActivoTBCliente() {
		return $this->activoTBCliente;
	}

	public function setActivoTBCliente($activoTBCliente) {
		$this->activoTBCliente = $activoTBCliente;
	}

}
?>