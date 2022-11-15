<?php
 
class Compra{
    private $idCompra;
    private $fechaCompra;
    private $proveedorId;
    private $montoNetoCompra;
    private $modoPagoCompra;
    private $activo;


    function Compra($idCompra, $fechaCompra, $proveedorId, $montoNetoCompra,$modoPagoCompra,$activo) {
		$this->idCompra = $idCompra;
        $this->fechaCompra = $fechaCompra;
        $this->proveedorId = $proveedorId;
        $this->montoNetoCompra = $montoNetoCompra;
        $this->modoPagoCompra = $modoPagoCompra;
        $this->activo = $activo;

	}

	public function getIdCompra() {
		return $this->idCompra;
	}

	public function setIdCompra($idCompra) {
		$this->idCompra = $idCompra;
	}

	public function getFechaCompra() {
		return $this->fechaCompra;
	}

	public function setFechaCompra($fechaCompra) {
		$this->fechaCompra = $fechaCompra;
	}

	public function getProveedorId() {
		return $this->proveedorId;
	}

	public function setProveedorId($proveedorId) {
		$this->proveedorId = $proveedorId;
	}

	public function getMontoNetoCompra() {
		return $this->montoNetoCompra;
	}

	public function setMontoNetoCompra($montoNetoCompra) {
		$this->montoNetoCompra = $montoNetoCompra;
	}

	public function getModoPagoCompra() {
		return $this->modoPagoCompra;
	}

	public function setModoPagoCompra($modoPagoCompra) {
		$this->modoPagoCompra = $modoPagoCompra;
	}


	public function getActivo() {
		return $this->activo;
	}

	public function setActivo($activo) {
		$this->activo = $activo;
	}


    


}
?>