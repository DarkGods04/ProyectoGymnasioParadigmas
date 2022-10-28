<?php

class PagoPeridiocidad {

	private $idTBPagoPeridiocidad;
	private $nombreTBPagoPeridiocidad;
	private $descripcionTBPagoPeridiocidad;
	private $activoTBPagoPeridiocidad;
	
	function PagoPeridiocidad($idTBPagoPeridiocidad, $nombreTBPagoPeridiocidad, $descripcionTBPagoPeridiocidad, $activoTBPagoPeridiocidad) {
		$this->idTBPagoPeridiocidad = $idTBPagoPeridiocidad;
		$this->nombreTBPagoPeridiocidad = $nombreTBPagoPeridiocidad;
		$this->descripcionTBPagoPeridiocidad = $descripcionTBPagoPeridiocidad;
		$this->activoTBPagoPeridiocidad = $activoTBPagoPeridiocidad;
	}

	public function getIdTBPagoPeridiocidad() {
		return $this->idTBPagoPeridiocidad;
	}

	public function getNombreTBPagoPeridiocidad() {
		return $this->nombreTBPagoPeridiocidad;
	}

	public function setNombreTBPagoPeridiocidad($nombreTBPagoPeridiocidad) {
		$this->nombreTBPagoPeridiocidad = $nombreTBPagoPeridiocidad;
	}

	public function getDescripcionTBPagoPeridiocidad() {
		return $this->descripcionTBPagoPeridiocidad;
	}

	public function setDescripcionTBPagoPeridiocidad($descripcionTBPagoPeridiocidad) {
		$this->descripcionTBPagoPeridiocidad = $descripcionTBPagoPeridiocidad;
	}

	public function getActivoTBPagoPeridiocidad() {
		return $this->activoTBPagoPeridiocidad;
	}

	public function setActivoTBPagoPeridiocidad($activoTBPagoPeridiocidad) {
		$this->activoTBPagoPeridiocidad = $activoTBPagoPeridiocidad;
	}

}
?>