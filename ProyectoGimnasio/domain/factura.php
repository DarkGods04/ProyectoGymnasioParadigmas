<?php
 
class Factura{

    private $idTBFactura;
    private $clienteidTBFactura;
    private $instructoridTBFactura;
    private $fechaPagoTBFactura;
    private $pagoModalidadTBFactura;
    private $impuestoVentaidTBFactura;
    private $montoNetoTBFactura;
	private $metodoDePagoidTBFactura;
    private $activoTBFactura;

    function Factura($idTBFactura, $clienteidTBFactura, $instructoridTBFactura, $fechaPagoTBFactura,$pagoModalidadTBFactura,$impuestoVentaidTBFactura,
    	$montoNetoTBFactura,$metodoDePagoidTBFactura,$activoTBFactura) {
		$this->idTBFactura = $idTBFactura;
        $this->clienteidTBFactura = $clienteidTBFactura;
        $this->instructoridTBFactura = $instructoridTBFactura;
        $this->fechaPagoTBFactura = $fechaPagoTBFactura;
        $this->pagoModalidadTBFactura = $pagoModalidadTBFactura;
        $this->impuestoVentaidTBFactura = $impuestoVentaidTBFactura;
        $this->montoNetoTBFactura = $montoNetoTBFactura;
		$this->metodoDePagoidTBFactura = $metodoDePagoidTBFactura;
        $this->activoTBFactura = $activoTBFactura;
	}

	public function getIdTBFactura() {
		return $this->idTBFactura;
	}

	public function setIdTBFactura($idTBFactura) {
		$this->idTBFactura = $idTBFactura;
	}

	public function getClienteidTBFactura() {
		return $this->clienteidTBFactura;
	}

	public function setClienteidTBFactura($clienteidTBFactura) {
		$this->clienteidTBFactura = $clienteidTBFactura;
	}

	public function getInstructoridTBFactura() {
		return $this->instructoridTBFactura;
	}

	public function setInstructoridTBFactura($instructoridTBFactura) {
		$this->instructoridTBFactura = $instructoridTBFactura;
	}

	public function getFechaPagoTBFactura() {
		return $this->fechaPagoTBFactura;
	}

	public function setFechaPagoTBFactura($fechaPagoTBFactura) {
		$this->fechaPagoTBFactura = $fechaPagoTBFactura;
	}

	public function getPagoModalidadTBFactura() {
		return $this->pagoModalidadTBFactura;
	}

	public function setPagoModalidadTBFactura($pagoModalidadTBFactura) {
		$this->pagoModalidadTBFactura = $pagoModalidadTBFactura;
	}
    
	public function getImpuestoVentaidTBFactura() {
		return $this->impuestoVentaidTBFactura;
	}

	public function setImpuestoVentaidTBFactura($impuestoVentaidTBFactura) {
		$this->impuestoVentaidTBFactura = $impuestoVentaidTBFactura;
	}

	public function getMontoNetoTBFactura() {
		return $this->montoNetoTBFactura;
	}

	public function setMontoNetoTBFactura($montoNetoTBFactura) {
		$this->montoNetoTBFactura = $montoNetoTBFactura;
	}

	public function setMetodoDePagoidTBFactura($metodoDePagoidTBFactura) {
		$this->metodoDePagoidTBFactura = $metodoDePagoidTBFactura;
	}

	public function getMetodoDePagoidTBFactura() {
		return $this->metodoDePagoidTBFactura;
	}

	public function getActivoTBFactura() {
		return $this->activoTBFactura;
	}

	public function setActivoTBFactura($activoTBFactura) {
		$this->activoTBFactura = $activoTBFactura;
	}

}
?>