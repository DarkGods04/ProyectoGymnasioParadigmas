<?php

class PagoModalidad {

	private $idTBpagoModalidad;
	private $nombreTBpagoModalidad;
	private $descripcionTBpagoModalidad;
	private $activoTBpagoModalidad;
	
	function PagoModalidad($idTBpagoModalidad, $nombreTBpagoModalidad, $descripcionTBpagoModalidad, $activoTBpagoModalidad) {
		$this->idTBpagoModalidad = $idTBpagoModalidad;
		$this->nombreTBpagoModalidad = $nombreTBpagoModalidad;
		$this->descripcionTBpagoModalidad = $descripcionTBpagoModalidad;
		$this->activoTBpagoModalidad = $activoTBpagoModalidad;
	}

	public function getIdTBpagoModalidad() {
		return $this->idTBpagoModalidad;
	}

	public function setIdTBpagoModalidad($idTBpagoModalidad) {
		$this->idTBpagoModalidad = $idTBpagoModalidad;
	}

	public function getNombreTBpagoModalidad() {
		return $this->nombreTBpagoModalidad;
	}

	public function setNombreTBpagoModalidad($nombreTBpagoModalidad) {
		$this->nombreTBpagoModalidad = $nombreTBpagoModalidad;
	}

	public function getDescripcionTBpagoModalidad() {
		return $this->descripcionTBpagoModalidad;
	}

	public function setDescripcionTBpagoModalidad($descripcionTBpagoModalidad) {
		$this->descripcionTBpagoTipo = $descripcionTBpagoModalidad;
	}

	public function getActivoTBpagoModalidad() {
		return $this->activoTBpagoModalidad;
	}

	public function setActivoTBpagoModalidad($activoTBpagoModalidad) {
		$this->activoTBpagoModalidad = $activoTBpagoModalidad;
	}

}
?>