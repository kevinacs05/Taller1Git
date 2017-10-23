<?php 

class Producto{
	private $IDProducto;
	private $DescripcionPro;
	private $PrecioUnitarioPro;
	private $ObservPro;
	private $Productocol;
	private $TamanoPresentacion_IdTamanoPresentacion;
	private $TipoProducto_IdTipoProducto;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}

?>