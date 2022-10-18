<?php

class ActivoVariable {

	private $idTBActivo;
	private $nameTBActivo;
	private $descripcionTBActivo;
	private $cantidadTBActivo;
	private $montoCompraTBActivo;
	private $activoTBActivo;

	function ActivoVariable($idTBActivo, $nameTBActivo, $descripcionTBActivo, $cantidadTBActivo, $montoCompraTBActivo, $activoTBActivo) {
		$this->idTBActivo = $idTBActivo;
		$this->nameTBActivo = $nameTBActivo;
		$this->descripcionTBActivo = $descripcionTBActivo;
		$this->cantidadTBActivo = $cantidadTBActivo;
		$this->montoCompraTBActivo = $montoCompraTBActivo;
		$this->activoTBActivo = $activoTBActivo;
	}

	public function getIdTBActivo() {
		return $this->idTBActivo;
	}

	public function setIdTBActivo($idTBActivo) {
		$this->idTBActivo = $idTBActivo;
	}

	public function getNameTBActivo() {
		return $this->nameTBActivo;
	}

	public function setNameTBActivo($nameTBActivo) {
		$this->nameTBActivo = $nameTBActivo;
	}

	public function getDescripcionTBActivo() {
		return $this->descripcionTBActivo;
	}

	public function setDescripcionTBActivo($descripcionTBActivo) {
		$this->descripcionTBActivo = $descripcionTBActivo;
	}

	public function getCantidadTBActivo() {
		return $this->cantidadTBActivo;
	}

	public function setCantidadTBActivo($cantidadTBActivo) {
		$this->cantidadTBActivo = $cantidadTBActivo;
	}

	public function getMontoCompraTBActivo(){
		return $this->montoCompraTBActivo;
	}

	public function setMontoCompraTBActivo($montoCompraTBActivo){
		$this->montoCompraTBActivo = $montoCompraTBActivo;
	}

	public function getActivoTBActivo() {
		return $this->activoTBActivo;
	}

	public function setActivoTBActivo($activoTBActivo) {
		$this->activoTBActivo = $activoTBActivo;
	}

}
?>