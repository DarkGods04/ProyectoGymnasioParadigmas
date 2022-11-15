<?php
 
class CompraDetalle{
    private $idCompraDetalle;
    private $idCompra;
    private $idProducto;
    private $cantidadProducto;
    private $precioBrutoProducto;
    private $compraDetalleActivo;


    function CompraDetalle($idCompraDetalle,$idCompra,$idProducto,$cantidadProducto,$precioBrutoProducto, $compraDetalleActivo) {
		
        $this->idCompraDetalle = $idCompraDetalle;
        $this->idCompra = $idCompra;
        $this->idProducto = $idProducto;
        $this->cantidadProducto = $cantidadProducto;
        $this->precioBrutoProducto = $precioBrutoProducto;
        $this->compraDetalleActivo = $compraDetalleActivo;

	}

    public function getIdCompraDetalle() {
		return $this->idCompraDetalle;
	}

	public function setIdCompraDetalle($idCompraDetalle) {
		$this->idCompraDetalle = $idCompraDetalle;
	}


	public function getIdCompra() {
		return $this->idCompra;
	}

	public function setIdCompra($idCompra) {
		$this->idCompra = $idCompra;
	}

	public function getIdProducto() {
		return $this->idProducto;
	}

	public function setIdProducto($idProducto) {
		$this->idProducto = $idProducto;
	}

	public function getCantidadProducto() {
		return $this->cantidadProducto;
	}

	public function setCantidadProducto($cantidadProducto) {
		$this->cantidadProducto = $cantidadProducto;
	}

	public function getPrecioBrutoProducto() {
		return $this->precioBrutoProducto;
	}

	public function setPrecioBrutoProducto($precioBrutoProducto) {
		$this->precioBrutoProducto = $precioBrutoProducto;
	}

	public function getCompraDetalleActivo() {
		return $this->compraDetalleActivo;
	}

	public function setCompraDetalleActivo($compraDetalleActivo) {
		$this->compraDetalleActivo = $compraDetalleActivo;
	}


    


}
?>