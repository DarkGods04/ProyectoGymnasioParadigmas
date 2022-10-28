<?php

class ModalidadFuncionalCriterio {

	private $idTBModalidadfuncionalcriterio;
    private $idModalidadfuncionalTBModalidadfuncionalcriterio;
    private $nombreTBModalidadfuncionalcriterio;
    private $descripcionTBModalidadfuncionalcriterio;
    private $rangoValorMinimoTBModalidadfuncionalcriterio;
    private $rangoValorMaximoTBModalidadfuncionalcriterio;
    private $activoTBModalidadfuncionalcriterio;

	function ModalidadFuncionalCriterio($idTBModalidadfuncionalcriterio, $idModalidadfuncionalTBModalidadfuncionalcriterio, $nombreTBModalidadfuncionalcriterio, $descripcionTBModalidadfuncionalcriterio, $rangoValorMaximoTBModalidadfuncionalcriterio, $rangoValorMinimoTBModalidadfuncionalcriterio, $activoTBModalidadfuncionalcriterio) {
		$this->idTBModalidadfuncionalcriterio = $idTBModalidadfuncionalcriterio;
		$this->idModalidadfuncionalTBModalidadfuncionalcriterio = $idModalidadfuncionalTBModalidadfuncionalcriterio;
		$this->nombreTBModalidadfuncionalcriterio = $nombreTBModalidadfuncionalcriterio;
		$this->descripcionTBModalidadfuncionalcriterio = $descripcionTBModalidadfuncionalcriterio;
		$this->rangoValorMinimoTBModalidadfuncionalcriterio = $rangoValorMinimoTBModalidadfuncionalcriterio;
		$this->rangoValorMaximoTBModalidadfuncionalcriterio = $rangoValorMaximoTBModalidadfuncionalcriterio;
        $this->activoTBModalidadfuncionalcriterio = $activoTBModalidadfuncionalcriterio;
	}

	public function getIdTBModalidadfuncionalcriterio() {
		return $this->idTBModalidadfuncionalcriterio;
	}

	public function setIdTBModalidadfuncionalcriterio($idTBModalidadfuncionalcriterio) {
		$this->idTBModalidadfuncionalcriterio = $idTBModalidadfuncionalcriterio;
	}

	public function getIdModalidadfuncionalTBModalidadfuncionalcriterio() {
		return $this->idModalidadfuncionalTBModalidadfuncionalcriterio;
	}

	public function setIdModalidadfuncionalTBModalidadfuncionalcriterio($idModalidadfuncionalTBModalidadfuncionalcriterio) {
		$this->idModalidadfuncionalTBModalidadfuncionalcriterio = $idModalidadfuncionalTBModalidadfuncionalcriterio;
	}

	public function getNombreTBModalidadfuncionalcriterio() {
		return $this->nombreTBModalidadfuncionalcriterio;
	}

	public function setNombreTBModalidadfuncionalcriterio($nombreTBModalidadfuncionalcriterio) {
		$this->nombreTBModalidadfuncionalcriterio = $nombreTBModalidadfuncionalcriterio;
	}

	public function getDescripcionTBModalidadfuncionalcriterio() {
		return $this->descripcionTBModalidadfuncionalcriterio;
	}

	public function setDescripcionTBModalidadfuncionalcriterio($descripcionTBModalidadfuncionalcriterio) {
		$this->descripcionTBModalidadfuncionalcriterio = $descripcionTBModalidadfuncionalcriterio;
	}

	public function getRangoValorMinimoTBModalidadfuncionalcriterio(){
		return $this->rangoValorMinimoTBModalidadfuncionalcriterio;
	}

	public function setRangoValorMinimoTBModalidadfuncionalcriterio($rangoValorMinimoTBModalidadfuncionalcriterio){
		$this->rangoValorMinimoTBModalidadfuncionalcriterio = $rangoValorMinimoTBModalidadfuncionalcriterio;
	}

	public function getRangoValorMaximoTBModalidadfuncionalcriterio() {
		return $this->rangoValorMaximoTBModalidadfuncionalcriterio;
	}

	public function setRangoValorMaximoTBModalidadfuncionalcriterio($rangoValorMaximoTBModalidadfuncionalcriterio) {
		$this->rangoValorMaximoTBModalidadfuncionalcriterio = $rangoValorMaximoTBModalidadfuncionalcriterio;
	}

    public function getActivoTBModalidadfuncionalcriterio() {
		return $this->activoTBModalidadfuncionalcriterio;
	}

	public function setActivoTBModalidadfuncionalcriterio($activoTBModalidadfuncionalcriterio) {
		$this->activoTBModalidadfuncionalcriterio = $activoTBModalidadfuncionalcriterio;
	}

}
?>