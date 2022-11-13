<?php

class Proveedor {

	private $idTBProveedor;
	private $nombreCompletoTBProveedor;
	private $casaComercialTBProveedor;
	private $idlineaProductosTBCatalogoLineaProductos;
	private $activoTBProveedor;

	function Proveedor($idTBProveedor, $nombreCompletoTBProveedor, $casaComercialTBProveedor, $idlineaProductosTBCatalogoLineaProductos, $activoTBProveedor) {
		$this->idTBProveedor = $idTBProveedor;
		$this->nombreCompletoTBProveedor = $nombreCompletoTBProveedor;
		$this->casaComercialTBProveedor = $casaComercialTBProveedor;
		$this->idlineaProductosTBCatalogoLineaProductos = $idlineaProductosTBCatalogoLineaProductos;
		$this->activoTBProveedor = $activoTBProveedor;
	}

	public function getIdTBProveedor() {
		return $this->idTBProveedor;
	}

	public function getNombreCompletoTBProveedor() {
		return $this->nombreCompletoTBProveedor;
	}

	public function setNombreCompletoTBProveedor($nombreCompletoTBProveedor) {
		$this->nombreCompletoTBProveedor = $nombreCompletoTBProveedor;
	}

	public function getCasaComercialTBProveedor() {
		return $this->casaComercialTBProveedor;
	}

	public function setCasaCormercialTBProveedor($casaComercialTBProveedor) {
		$this->casaComercialTBProveedor = $casaComercialTBProveedor;
	}

	public function getIdLineaProductosTBCatalogoLineaProductos() {
		return $this->idlineaProductosTBCatalogoLineaProductos;
	}

	public function setIdLineaProductosTBCatalogoLineaProductos($idlineaProductosTBCatalogoLineaProductos) {
		$this->idlineaProductosTBCatalogoLineaProductos = $idlineaProductosTBCatalogoLineaProductos;
	}

	public function getActivoTBProveedor() {
		return $this->activoTBProveedor;
	}

	public function setActivoTBProveedor($activoTBProveedor) {
		$this->activoTBProveedor = $activoTBProveedor;
	}

}
?>