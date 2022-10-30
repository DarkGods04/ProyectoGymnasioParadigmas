<?php
 
class Factura{
    private $idTBFactura;
    private $clienteidTBFactura;
    private $instructoridTBFactura;
    private $fechaPagoTBFactura;
    private $pagoModalidadTBFactura;
    private $serviciosTBFactura;
    private $montoBrutoTBFactura;
    private $impuestoVentaidTBFactura;
    private $montoNetoTBFactura;
    private $activoTBFactura;

    function Factura($idTBFactura, $clienteidTBFactura, $instructoridTBFactura, $fechaPagoTBFactura,$pagoModalidadTBFactura,$serviciosTBFactura,$montoBrutoTBFactura,$impuestoVentaidTBFactura,
    	$montoNetoTBFactura,$activoTBFactura) {
		$this->idTBFactura = $idTBFactura;
        $this->clienteidTBFactura = $clienteidTBFactura;
        $this->instructoridTBFactura = $instructoridTBFactura;
        $this->fechaPagoTBFactura = $fechaPagoTBFactura;
        $this->pagoModalidadTBFactura = $pagoModalidadTBFactura;
        $this->serviciosTBFactura = $serviciosTBFactura;
        $this->montoBrutoTBFactura = $montoBrutoTBFactura;
        $this->impuestoVentaidTBFactura = $impuestoVentaidTBFactura;
        $this->montoNetoTBFactura = $montoNetoTBFactura;
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


	public function getServiciosTBFactura() {
		return $this->serviciosTBFactura;
	}

	public function setServiciosTBFactura($serviciosTBFactura) {
		$this->serviciosTBFactura = $serviciosTBFactura;
	}


    public function getMontoBrutoTBFactura() {
		return $this->montoBrutoTBFactura;
	}

	public function setMontoBrutoTBFactura($montoBrutoTBFactura) {
		$this->montoBrutoTBFactura = $montoBrutoTBFactura;
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

	public function getActivoTBFactura() {
		return $this->activoTBFactura;
	}

	public function setActivoTBFactura($activoTBFactura) {
		$this->activoTBFactura = $activoTBFactura;
	}


}
?>