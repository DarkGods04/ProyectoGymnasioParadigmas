<?php 
class FacturaDetalle{
    
    private $idTBFacturaDetalle;
    private $idServicioTBFacturaDetalle;
    private $idTBFactura;
    private $montoBrutoTBFacturaDetalle;
    private $activoTBFacturaDetalle;
    private $cantidadTBServicioFacturaDetalle;

    function FacturaDetalle($idTBFacturaDetalle,$idServicioTBFacturaDetalle,$idTBFactura,$montoBrutoTBFacturaDetalle,$metodoDePagoidTBFactura,$activoTBFacturaDetalle, $cantidadTBServicioFacturaDetalle) {
		$this->idTBFacturaDetalle = $idTBFacturaDetalle;
        $this->idServicioTBFacturaDetalle = $idServicioTBFacturaDetalle;
        $this->idTBFactura=$idTBFactura;
        $this->montoBrutoTBFacturaDetalle = $montoBrutoTBFacturaDetalle;
		$this->metodoDePagoidTBFactura=$metodoDePagoidTBFactura;
        $this->activoTBFacturaDetalle = $activoTBFacturaDetalle;
        $this->cantidadTBServicioFacturaDetalle = $cantidadTBServicioFacturaDetalle;
	}
    
	public function getCantidadTBServicioFacturaDetalle() {
		return $this->cantidadTBServicioFacturaDetalle;
	}

	public function setCantidadTBServicioFacturaDetalle($cantidadTBServicioFacturaDetalle) {
		$this->cantidadTBServicioFacturaDetalle = $cantidadTBServicioFacturaDetalle;
	}

	public function getIdTBFacturaDetalle() {
		return $this->idTBFacturaDetalle;
	}

	public function setIdTBFacturaDetalle($idTBFacturaDetalle) {
		$this->idTBFacturaDetalle = $idTBFacturaDetalle;
	}

	public function getIdServicioTBFacturaDetalle() {
		return $this->idServicioTBFacturaDetalle;
	}

	public function setIdServicioTBFacturaDetalle($idServicioTBFacturaDetalle) {
		$this->idServicioTBFacturaDetalle = $idServicioTBFacturaDetalle;
	}

    public function getIdTBFactura() {
		return $this->idTBFactura;
	}

	public function setIdTBFactura($idTBFactura) {
		$this->idTBFactura = $idTBFactura;
	}

    public function getMontoBrutoTBFacturaDetalle() {
		return $this->montoBrutoTBFacturaDetalle;
	}

	public function setMontoBrutoTBFacturaDetalle($montoBrutoTBFacturaDetalle) {
		$this->montoBrutoTBFacturaDetalle = $montoBrutoTBFacturaDetalle;
	}
    
	public function getActivoTBFacturaDetalle() {
		return $this->activoTBFacturaDetalle;
	}

	public function setActivoTBFacturaDetalle($activoTBFacturaDetalle) {
		$this->activoTBFacturaDetalle = $activoTBFacturaDetalle;
	}

}
?>