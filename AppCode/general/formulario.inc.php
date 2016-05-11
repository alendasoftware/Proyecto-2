<?php



// ##############################################################################

// # ARCHIVO:		formulario.inc.php - Versión 1.0

// # DESCRIPCION:	

// ##############################################################################



// *****************************************************************************

// * Clase phpCifrado

// *****************************************************************************



// Público

	

class phpFormulario{

    

    //Propiedades públicas  

    public $Id;

    public $Nombre;

    public $Metodo;

    public $Accion;

    public $Titulo;

    public $Subtitulo;

    public $TextoEnvio;

    public $TextoSubmit;  

    public $EnvioAjax;

    public $PoliticaPrivacidad;

    public $Archivos;		

    public $ColForm;

    public $ColFormOffset;

    public $Recaptcha;



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

        $this->Metodo = null;

        $this->Accion = null;

        $this->TextoEnvio = null;

        $this->TextoSubmit = null;

        $this->Archivos = false;

        $this->PoliticaPrivacidad = true;

        $this->EnvioAjax = true;

        $this->ColForm = 12;

        $this->ColFormOffset = 0;

        $this->Recaptcha = true;

    }	



    // *****************************************************************************

    // * Propiedades

    // *****************************************************************************  

    



    // *****************************************************************************

    // * Métodos Públicos

    // *****************************************************************************

    Public function DevuelveCadena(){

		

	    $strValor = "";

		$strValor .= "Id:" . $this->Id . ";";

    	$strValor .= "Nombre:" . $this->Nombre . ";";

        $strValor .= "Metodo:" . $this->Metodo . ";";

        $strValor .= "Accion:" . $this->Accion . ";";

        $strValor .= "TextoEnvio:" . $this->TextoEnvio . ";";

        $strValor .= "TextoSubmit:" . $this->TextoSubmit . ";";        

        $strValor .= "Archivos:" . $this->Archivos . ";";

        $strValor .= "PoliticaPrivacidad:" . $this->PoliticaPrivacidad . ";";

        $strValor .= "EnvioAjax:" . $this->EnvioAjax . ";";



        return $strValor;



    } 

	

    

    public function AbreDibujo()

    {

        $strHtml = "";



        if ($this->Valido()){



            $strHtml .= "<div class=\"get-started center wow fadeInDown animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";

            if (($this->Titulo != null) && ($this->Titulo != "")) $strHtml .= "<h2>" . $this->Titulo . "</h2>";

            if (($this->Subtitulo != null) && ($this->Subtitulo != "")) $strHtml .= "<p class=\"lead\">" . $this->Subtitulo . "</p>";

            $strHtml .= "<div class=\"row contact-wrap\">";

            $strHtml .= "<div class=\"status alert alert-success\" style=\"display: none\"></div>";

            

            $strHtml .= "<div class=\"row\">";

            $strHtml .= "<div class=\"col-md-" . $this->ColForm;

            if ($this->ColFormOffset>0) $strHtml .= " col-md-offset-" . $this->ColFormOffset;

            $strHtml .= "\">";



            $strHtml .= "<form id=\"" . $this->Id . "\" class=\"contact-form\" name=\"" . $this->Nombre . "\" method=\"" . $this->Metodo . "\" action=\"" . $this->Accion . "\"";

            if ($this->Archivos) $strHtml .= " enctype=\"multipart/form-data\"";

            $strHtml .= ">";



        }



        return $strHtml;

    }



    public function CierraDibujo($objTraductor)

    {

        $strHtml = "";



        if ($this->Valido())

        {

            

            $strHtml .= "<div class=\"row\">";                            

                $strHtml .= "<div class=\"text-center col-md-12 col-xs-12\">";

                    if ($this->Recaptcha){

                        $strHtml .= "<div>";

                            $strHtml .= "<div class=\"g-recaptcha\" data-sitekey=\"" . vbKeyRecaptcha . "\"></div>";

                        $strHtml .= "</div>"; 

                    }  

                    $strHtml .= "<div class=\"row\">";

                        

                        $strHtml .= "<div class=\"col-md-12 form-group\">";

                            $strHtml .= "<button type=\"submit\" name=\"submit\" class=\"btn btn-primary btn-lg\" required=\"required\">" . $this->TextoSubmit  . "</button>";

                        $strHtml .= "</div>";



                        if ($this->PoliticaPrivacidad)

                        {

                            $strHtml .= "<div class=\"col-md-3 center col-sm-offset-5 text-center\">";

                                $strHtml .= "<div class=\"checkbox\">";

                                    $strHtml .= "<label class=\"privacidad\" for=\"acepto\">";

                                        $strHtml .= $objTraductor->Traducir("Acepto");

                                        $strHtml .= "&nbsp;<a data-target=\"#pagePoliticaCalidad\" data-toggle=\"modal\">" . $objTraductor->Traducir("ProteccionDatos") . "</a>";

                                        $strHtml .= "<input type=\"checkbox\" value=\"1\" name=\"acepto\" class=\"\" required=\"required\">";                                  

                                    $strHtml .= "</label>";

                                $strHtml .= "</div>";

                            $strHtml .= "</div>";

                        }      

                    $strHtml .= "</div>";

                $strHtml .= "</div>";

            $strHtml .= "</div>";



            $strHtml .= "</form>";            

            $strHtml .= "</div>";

            $strHtml .= "</div>";



            $strHtml .= "</div><!--/.row-->";

            $strHtml .= "</div>";

        }



        return $strHtml;

    }



    public function DibujaScript()

    {

        $strHtml = "";

        if ($this->EnvioAjax)

        {

            $strHtml  .= "<script>";

            $strHtml  .= "$( document ).ready(function() {";

            $strHtml  .= "var form = $('#" . $this->Id . "');";

            $strHtml  .= "form.submit(function (event) {";

            $strHtml  .= "event.preventDefault();";

            $strHtml  .= "var form_status = $('<div class=\"form_status\"></div>');";

            $strHtml  .= "var formData = new FormData($(this)[0]);";
            
            if ($this->Id=="opinion-comment-form") {
                $strHtml .= "$('#opinion-comment-form button').removeClass('btn-primary');";
                $strHtml .= "$('#opinion-comment-form button').addClass('btn-warning');";
                $strHtml .= "$('#opinion-comment-form button').html('<i class=\"fa fa-spinner fa-spin\"></i>&nbsp;Enviando, espera por favor...');";
            }

            $strHtml  .= "$.ajax({";

            $strHtml  .= "url: $(this).attr('action'),";

            $strHtml  .= "type: \"POST\",";

            $strHtml  .= "data: formData,";

            $strHtml  .= "async: false,";

            $strHtml  .= "cache: false,";

            $strHtml  .= "contentType: false,";

            $strHtml  .= "processData: false,";

            $strHtml  .= "beforeSend: function () {";

            $strHtml  .= "form.prepend(form_status.html('<p class=\"text-info\"><i class=\"fa fa-spinner fa-spin\"></i> " . $this->TextoEnvio . "</p>').fadeIn());";

            $strHtml  .= "}";

            $strHtml  .= "}).done(function (data) {";

            $strHtml  .= "if (data.message != undefined) {";

            $strHtml  .= "form_status.html('<p class=\"text-success\"><i class=\"fa fa-check\"></i> ' + data.message + '</p>').delay(3000).fadeOut();";

            $strHtml  .= "form[0].reset();";

            $strHtml  .= "$('#mensajeSistema .modal-body').html('<p class=\"text-success\"><i class=\"fa fa-check\">&nbsp;</i>' + data.message + '</p>');";

            $strHtml  .= "$('#mensajeSistema').modal('show');";
            if ($this->Id=="opinion-comment-form") $strHtml  .= "location.reload();";
            $strHtml  .= "} else {";

            $strHtml  .= "if (data.error != undefined) form_status.html('<p class=\"text-danger\"><i class=\"fa fa-exclamation-triangle\"></i> ' + data.error + '</p>').delay(3000).fadeOut();";

            $strHtml  .= "$('#mensajeSistema .modal-body').html('<p class=\"text-danger\"><i class=\"fa fa-exclamation-triangle\">&nbsp;</i>' + data.error + '</p>');";

            $strHtml  .= "$('#mensajeSistema').modal('show');";

            $strHtml  .= "}";

            $strHtml  .= "});";

            $strHtml  .= "});";

            $strHtml  .= "});";

            $strHtml  .= "</script>";

        }

        return $strHtml;

    }

    

    public function ControlBuscador($strVar, $strFormText)

    {

        $formText = "";



        if (isset($_POST[$strFormText])) {

            

            $formText = $_POST[$strFormText];

            if ($formText != "")

            {

                $_SESSION[$strVar] = $formText;

            }

            else

            {

                unset($_SESSION[$strVar]);

            }

        }else{

            if (isset($_SESSION[$strVar])) $formText = $_SESSION[$strVar];    

        }

   

        return $formText;

    }



    public function RecogeParametro($strParametro)

    {

        $strValor = null;



        if (isset($_POST[$strParametro])) $strValor = $_POST[$strParametro];



        return $strValor;

    }



    // *****************************************************************************

    // * Métodos Privados

    // *****************************************************************************

    private function Valido()

    {

        $bolValor = true;



        if (($this->Id == null) || ($this->Id == "")) $bolValor = false;

        if ($bolValor && (($this->Nombre == null) || ($this->Nombre == ""))) $bolValor = false;

        if ($bolValor && (($this->Metodo == null) || ($this->Metodo == ""))) $bolValor = false;

        if ($bolValor && (($this->Accion == null) || ($this->Accion == ""))) $bolValor = false;



        return $bolValor;

    }

}



?>