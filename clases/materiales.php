<?php
/**
*		ACCESO POR TXT
*/				
class MaterialesTXT
{
	public $id;
	public $nombre;
	public $precio;
	public $tipo;

	//CONSTRUCTOR
	function __construct($nombre=NULL,$precio=NULL,$tipo=NULL)
	{
		if ($nombre!=NULL && $precio !=NULL && $tipo!=NULL) {
			$this->id = MaterialesTXT::ObtenerUltimoId() + 1;
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->tipo = $tipo;
		}
	}

	//METODO DE CLASE
	public function ToString(){
		return $this->id." - ".$this->nombre." - ".$this->precio." - ".$this->tipo."\n\r";
	}

	//METODOS STATICOS
	public static function ObtenerUltimoId(){
		$a = fopen("BD/materiales.txt", "r");
		$ultimoID = 0;
		while (!feof($a)) {
			$arr = explode(" - ",fgets($a));
			if (count($arr) > 1) {
				$ultimoID = $arr[0];
			}
		}
		return $ultimoID;
	}
	public static function ObtenerMaterialesPorId($id){
		$objAuto = new AutoTXT();
		$a = fopen("BD/materiales.txt", "r");
		while (!feof($a)) {
			$arr = explode(" - ", fgets($a));

			if (count($arr) > 1) {
				if ($arr[0] == $id) {
					$objAuto->nombre = $arr[1];
					$objAuto->precio = $arr[2];
					$objAuto->tipo = trim($arr[3]);
					break;
				}
			}
		}
		fclose($a);
		return $objAuto;
	}
	public function InsertarMaterial(){
		$a = fopen("BD/materiales.txt", "a");
		$r = fwrite($a, $this->ToString());	//DEVUELVE la cantidad de caracteres que escribio
		fclose($a);
		return $r;
	}
	public static function TraerTodosLosMateriales(){
		$arrMateriales = array();
		$a = fopen("BD/materiales.txt", "r"); //BD/materiales.txt si llamo directo
		while (!feof($a)) {
			$arr = explode(" - ", fgets($a));
			if (count($arr) > 1) {
				$material = array();
				$material['id'] = $arr[0];
				$material['nombre'] = $arr[1];
				$material['precio'] = $arr[2];
				$material['tipo'] = trim($arr[3]);

				// $material = new MaterialesTXT();
				// $material->id = $arr[0];
				// $material->nombre = $arr[1];
				// $material->precio = $arr[2];
				// $material->tipo = $arr[3];

				array_push($arrMateriales, $material);
			}
		}
		fclose($a);
		return $arrMateriales;
	}

}


?>
