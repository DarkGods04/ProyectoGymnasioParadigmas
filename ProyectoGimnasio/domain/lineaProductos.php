<?php

class LineaProductos {

	private $idTBCatalogoLineaProductos;
	private $nombreTBCatalogoLineaProductos;
	private $descripcionTBCatalogoLineaProductos;
	private $activoTBCatalogoLineaProductos;
	
	function LineaProductos($idTBCatalogoLineaProductos, $nombreTBCatalogoLineaProductos, $descripcionTBCatalogoLineaProductos, $activoTBCatalogoLineaProductos) {
		$this->idTBCatalogoLineaProductos = $idTBCatalogoLineaProductos;
		$this->nombreTBCatalogoLineaProductos = $nombreTBCatalogoLineaProductos;
		$this->descripcionTBCatalogoLineaProductos = $descripcionTBCatalogoLineaProductos;
		$this->activoTBCatalogoLineaProductos = $activoTBCatalogoLineaProductos;
	}

	public function getIdTBCatalogoLineaProductos() {
		return $this->idTBCatalogoLineaProductos;
	}

	public function getNombreTBCatalogoLineaProductos() {
		return $this->nombreTBCatalogoLineaProductos;
	}

	public function setNombreTBCatalogoLineaProductos($nombreTBCatalogoLineaProductos) {
		$this->nombreTBCatalogoLineaProductos = $nombreTBCatalogoLineaProductos;
	}

	public function getDescripcionTBCatalogoLineaProductos() {
		return $this->descripcionTBCatalogoLineaProductos;
	}

	public function setDescripcionTBCatalogoLineaProductos($descripcionTBCatalogoLineaProductos) {
		$this->descripcionTBCatalogoLineaProductos = $descripcionTBCatalogoLineaProductos;
	}

	public function getActivoTBCatalogoLineaProductos() {
		return $this->activoTBCatalogoLineaProductos;
	}

	public function setActivoTBCatalogoLineaProductos($activoTBCatalogoLineaProductos) {
		$this->activoTBCatalogoLineaProductos = $activoTBCatalogoLineaProductos;
	}

}
?>