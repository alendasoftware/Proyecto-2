<?php

// ##############################################################################
// # ARCHIVO:		email.inc - Version 1.1
// # DESCRIPCION:	Librer�a de control de direcciones de email
// ##############################################################################

// ******************************************************************************
// * General
// ******************************************************************************

// ******************************************************************************
// * Clase aspEmail
// ******************************************************************************

Class phpEmail{

	Private $Email;		// Texto con el e-mail
	
	// ******************************************************************************
	// * Creaci�n y eliminaci�n
	// ******************************************************************************

	public function __construct(){
	
		$this->Email="";
		
	}
	
    function __destruct() {
		
	    //Hay que destruir los objetos

	}

	// ******************************************************************************
	// * Propiedades
	// ******************************************************************************
	public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
	}

	public function __set($property, $value) {
        if (property_exists($this, $property)) {
        	$this->$property = $value;
        }
	}

	
	public function Dominio(){
			
	    $intPosicion = strpos($this->Email, "@");
	    if ($intPosicion > 0) {
			return substr($this->Email, $intPosicion+1, strlen($this->Email)-$intPosicion);	
        }else{
			return "";
	    }
	
	}

	public function Cuenta(){
	
	    $intPosicion = strpos($this->Email, "@");
	    if ($intPosicion > 0) {
	    	return substr($this->Email, 0, $intPosicion);			
        }else{
			return "";
	    }
	
	}


	// ******************************************************************************
	// * Chequeo
	// ******************************************************************************
    
	public function EsValido($strEmail){
	    
        if (!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$strEmail)){ 
			return false; 
		} else { 
			return true;
		} 

	}
	
}

?>