<?php

// ##############################################################################
// # ARCHIVO:		elementoFormulario.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpElementoFormulario
// *****************************************************************************

// Público
	
class phpElementoFormulario{
    
    //Propiedades públicas  
    public $Id;
    public $Nombre;
    public $Valor;
    public $Atributo;
    public $Longitud;
    public $Etiqueta;
    public $Requerido;
    public $Visible;

    public $m_intTipo;    

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	   //Crea objetos		

	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Id = null;
        $this->Nombre = null;
        $this->Valor = null;
        $this->Etiqueta = true;
        $this->Requerido = false;
        $this->Visible = true;
        $this->Longitud = 0;
        $this->m_intTipo = vbTipoTexto;
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    Public function Reinicia(){
        $this->Inicia();
    }
    
    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    public function getTipo()
    {
        return $this->m_intTipo;
    }

    public function setTipo($value)
    {
        if (($value == vbTipoTexto) || ($value == vbTipoTextoPanel) || ($value == vbTipoEntero) || ($value == vbTipoTextArea) || ($value == vbTipoCombo) || ($value == vbTipoNumber) || ($value == vbTipoEmail) || ($value == vbTipoChequeo) || ($value == vbTipoArchivo) || ($value == vbTipoClave)) $this->m_intTipo = $value;                    
    }
	
    public function AbreDibujo()
    {
        $strHtml = "";

        if ($this->Valido()){

            if (!$this->Visible) $strHtml .= "<div style=\"display:none;\">";

            switch ($this->getTipo())
            {
                case vbTipoTexto:

                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    $strHtml .= "</label>";
                    $strHtml .= "<input type=\"text\" name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    if ($this->Longitud>0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                    $strHtml .= " value=\"" . $this->Valor . "\">";

                    $strHtml .= "</div>";

                    break; 
                
                case vbTipoTextoPanel:
                   
                    $strHtml .= "<div class=\"control-group\">";
                    $strHtml .= "<label class=\"control-label\" for=\"focusedInput\">" . $this->Nombre . "</label>";
                    $strHtml .= "<div class=\"controls\">";
                        $strHtml .= "<input type=\"text\" name=\"" . $this->Id . "\" class=\"input-xlarge focused\"";
                        if ($this->Requerido) $strHtml .= " required=\"required\"";
                        if ($this->Longitud>0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                        $strHtml .= " value=\"" . $this->Valor . "\">";                        
                    $strHtml .= "</div>";
                    $strHtml .= "</div>";

                case vbTipoEntero:
                    
                    break;
                
                case vbTipoCombo:

                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    $strHtml .= "</label>";
                    $strHtml .= "<select name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    $strHtml .= " autocomplete=\"off\">";
                    $strHtml .= $this->Valor;
                    $strHtml .= "</select>";
                    $strHtml .= "</div>";

                    break;

                case vbTipoTextArea:

                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    $strHtml .= "</label>";
                    $strHtml .= "<textarea name=\"" . $this->Id . "\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    if ($this->Longitud>0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                    $strHtml .= " class=\"form-control\" rows=\"8\">";
                    $strHtml .= $this->Valor;
                    $strHtml .= "</textarea>";

                    $strHtml .= "</div>";

                    break;
               
                case vbTipoEmail:

                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    $strHtml .= "</label>";
                    $strHtml .= "<input type=\"email\" name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    if ($this->Longitud > 0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                    $strHtml .= " value=\"" . $this->Valor . "\">";

                    $strHtml .= "</div>";

                    break; 

                case vbTipoNumber:
                    
                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    $strHtml .= "</label>";
                    $strHtml .= "<input type=\"number\" name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    if ($this->Longitud > 0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                    $strHtml .= " value=\"" . $this->Valor . "\">";

                    $strHtml .= "</div>";

                    break;

                case vbTipoChequeo:
                    
                    $strHtml .= "<div class=\"checkbox\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";

                    $strHtml .= "<input type=\"checkbox\" name=\"" . $this->Id . "\" class=\"\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    $strHtml .= " value=\"" . $this->Valor . "\" " . $this->Atributo . ">";
                    
                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "</label>";

                    $strHtml .= "</div>";

                    break;

                case vbTipoArchivo:
                    
                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "</label>";

                    $strHtml .= "<input type=\"file\" name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    $strHtml .= " value=\"" . $this->Valor . "\" " . $this->Atributo . ">";
                    
                    $strHtml .= "</div>";

                    break;

                case vbTipoClave:

                    $strHtml .= "<div class=\"form-group\">";

                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "<label>" . $this->Nombre;
                    if ($this->Requerido) $strHtml .= " *";
                    if ($this->Etiqueta && ($this->Nombre != null) && ($this->Nombre != "")) $strHtml .= "</label>";

                    $strHtml .= "<input type=\"password\" name=\"" . $this->Id . "\" class=\"form-control\"";
                    if ($this->Requerido) $strHtml .= " required=\"required\"";
                    if ($this->Longitud > 0) $strHtml .= " maxlength=\"" . $this->Longitud . "\"";
                    $strHtml .= " value=\"" . $this->Valor . "\" " . $this->Atributo . ">";
                    
                    $strHtml .= "</div>";

                    break;
            }

            if (!$this->Visible) $strHtml .= "</div>";
        }

        return $strHtml;
    }
    
    public function DibujaSubmit($strTexto)
    {
        $strHtml = "";

        $strHtml .= "<div class=\"col-md-12 form-group\">";
        $strHtml .= "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary btn-lg\" required=\"required\">" . $strTexto . "</button>";
        $strHtml .= "</div>";

        return $strHtml;
    }
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function Valido()
    {
        $bolValor = true;

        if (($this->Id == null) || ($this->Id == "")) $bolValor = false;
        if ($bolValor && (($this->Nombre == null) || ($this->Nombre == ""))) $bolValor = false;
       
        return $bolValor;
    }
}

?>