<?php 
	require_once('./lib/nusoap.php'); 
	require_once('../clases/materiales.php');
	$arrMateriales2 = MaterialesTXT::TraerTodosLosMateriales();
var_dump($arrMateriales2);
// 	$server = new nusoap_server(); 

// 	$server->configureWSDL('WebService Materiales', 'urn:wsMaterialesTXT'); 

// ///**********************************************************************************************************///								
// //REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'
// 	$server->register('ObtenerTodosLosMateriales',                	
// 						array(),  
// 						array('return' => 'xsd:Array'),   
// 						'urn:wsMaterialesTXT',                		
// 						'urn:wsMaterialesTXT#ObtenerTodosLosMateriales',             
// 						'rpc',                        		
// 						'encoded',                    		
// 						'Obtiene todos los Materiales del archivo TXT'    			
// 					);


// 	function ObtenerTodosLosMateriales() {
		
// 		$r =  MaterialesTXT::TraerTodosLosMateriales();
// 		return $r;
// 		//return "llegue";
// 	}

// ///**********************************************************************************************************///								

// 	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
// 	$server->service($HTTP_RAW_POST_DATA);
?>