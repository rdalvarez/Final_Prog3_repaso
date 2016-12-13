<?php 
	require_once('lib/nusoap.php'); 
	require_once('clases/materiales.php');
	$server = new nusoap_server(); 

	$server->configureWSDL('WebService Materiales', 'urn:wsMaterialesTXT'); 

///**********************************************************************************************************///


//AGREGO TIPO COMPLEJO, INFORMANDO SU ESTRUCTURA	
	$server->wsdl->addComplexType(
									'Material',
									'complexType',
									'struct',
									'all',
									'',
									array('Nombre' => array('name' => 'Nombre', 'type' => 'xsd:string'),
										  'Precio' => array('name' => 'Precio', 'type' => 'xsd:int'),
										  'Tipo' => array('name' => 'Tipo', 'type' => 'xsd:string')
										 )
								);
//PARAMETROS DE SALIDA DE TIPOS COMPLEJOS								
	$server->wsdl->addComplexType(
									'Retorno',
									'complexType',
									'struct',
									'all',
									'',
									array('Mensaje' => array('name' => 'Mensaje', 'type' => 'xsd:string')
										 )
								);
///**********************************************************************************************************///								
//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('AltaMaterial',                	
						array('Material' => 'tns:Material'),  
						array('return' => 'xsd:string'),   
						'urn:wsMaterialesTXT',                		
						'urn:wsMaterialesTXT#SaludarPersona',             
						'rpc',                        		
						'encoded',                    		
						'Intertar un Material'    			
					);


	function AltaMaterial($p) {
		$material = new MaterialesTXT($p['Nombre'], $p['Precio'],$p['Tipo']);

		return $material->InsertarMaterial();
	}
///**********************************************************************************************************///

//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('ModificarMaterial',                	
						array('Material' => 'tns:Material'),  
						array('return' => 'xsd:string'),   
						'urn:wsMaterialesTXT',                		
						'urn:wsMaterialesTXT#SaludarPersona',             
						'rpc',                        		
						'encoded',                    		
						'Intertar un Material'    			
					);


	function ModificarMaterial($p) {
		$material = new MaterialesTXT($p['Nombre'], $p['Precio'],$p['Tipo']);

		return $material->InsertarMaterial();
	}
///**********************************************************************************************************///

//REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'
	$server->register('ObtenerTodosLosMateriales',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsMaterialesTXT',                		
						'urn:wsMaterialesTXT#ObtenerTodosLosMateriales',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los Materiales del archivo TXT'    			
					);


	function ObtenerTodosLosMateriales() {
		
		$r =  MaterialesTXT::TraerTodosLosMateriales();
		return $r;
		//return "llegue";
	}

///**********************************************************************************************************///								

	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
	$server->service($HTTP_RAW_POST_DATA);
?>