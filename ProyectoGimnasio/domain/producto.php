<?php

class Producto {

	private $idTBProducto;
	private $nombreTBProducto;
	private $descripcionTBProducto;
	private $precioCompraTBProducto;
	private $precioVentaTBProducto;
    private $cantidadTBProducto;
    private $activoTBProducto;

	function Producto($idTBProducto, $nombreTBProducto, $descripcionTBProducto, $precioCompraTBProducto, $precioVentaTBProducto,$cantidadTBProducto,$activoTBProducto) {
		$this->idTBProducto = $idTBProducto;
		$this->nombreTBProducto = $nombreTBProducto;
		$this->descripcionTBProducto = $descripcionTBProducto;
		$this->precioCompraTBProducto = $precioCompraTBProducto;
		$this->precioVentaTBProducto = $precioVentaTBProducto;
        $this->cantidadTBProducto = $cantidadTBProducto;
        $this->activoTBProducto = $activoTBProducto;
	}

	public function getIdTBProducto() {
		return $this->idTBProducto;
	}

	public function setIdTBProducto($idTBProducto) {
		$this->idTBProducto = $idTBProducto;
	}

    public function getNombreTBProducto() {
		return $this->nombreTBProducto;
	}

	public function setNombreTBProducto($nombreTBProducto) {
		$this->nombreTBProducto = $nombreTBProducto;
	}

	

	public function setDescripcionTBProducto($descripcionTBProducto) {
		$this->descripcionTBProducto = $descripcionTBProducto;
	}

	public function getDescripcionTBProducto() {
		return $this->descripcionTBProducto;
	}

	public function setPrecioCompraTBProducto($precioCompraTBProducto) {
		$this->precioCompraTBProducto = $precioCompraTBProducto;
	}

	public function getPrecioCompraTBProducto() {
		return $this->precioCompraTBProducto;
	}

	public function setPrecioVentaTBProducto($precioVentaTBProducto) {
		$this->precioVentaTBProducto = $precioVentaTBProducto;
	}

    public function getPrecioVentaTBProducto() {
		return $this->precioVentaTBProducto;
	}

    public function setCantidadTBProducto($cantidadTBProducto) {
		$this->cantidadTBProducto = $cantidadTBProducto;
	}

    public function getCantidadTBProducto() {
		return $this->cantidadTBProducto;
	}


    public function setActivoTBProducto($activoTBProducto) {
		$this->activoTBProducto = $activoTBProducto;
	}

    public function getActivoTBProducto() {
		return $this->activoTBProducto;
	}

}
?>