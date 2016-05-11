<?php

// #############################################################################
// # ARCHIVO:		recaptcha.inc - Version 1.0
// # DESCRIPCION:	Librería de dibujo de un recaptcha
// #############################################################################

// *****************************************************************************
// * General
// *****************************************************************************

define('vbRecaptchaApi', "https://www.google.com/recaptcha/api");
define('vbRecaptchaSiteverify', "https://www.google.com/recaptcha/api/siteverify");

define('vbRecaptchaTemaLight', "light");
define('vbRecaptchaTemaDark', "dark");

define('vbRecaptchaTipoImage', "image");
define('vbRecaptchaTipoAudio', "audio");



' *****************************************************************************
' * Clase aspTitulo
' *****************************************************************************

class phpRecaptcha{

    public NombreCaptcha;                // Nombre del input del CAPTCHA
    public RecaptchaKeyPublic;
    public RecaptchaKeyPrivate;
    public $Clase;                       // Clase que se aplicará para configurar el recaptcha si se usa el tema "custom"
    public $Lenguaje;                    // Lenguaje a usar en los diversos textos ReCaptcha
	
    private $m_strTema;                  // Tema por defecto que puede aplicarse al ReCaptcha
    private $m_strTipo;                  // Tema por defecto que puede aplicarse al ReCaptcha
    private $m_recaptcha_response_field;

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){	
        
        $this->NombreCaptcha = "TurismoPlanificacionCAPTCHA";
        $this->RecaptchaKeyPublic = null;
	$this->RecaptchaKeyPrivate = null;
        $this->Clase = null;
        $this->Lenguaje = "es";

        $this->m_strTema = vbRecaptchaTemaLight;
	$this->m_strTipo = vbRecaptchaTipoImage;	        
        $m_recaptcha_response_field = $_POST['g-recaptcha-response'];
			
    }

    function __destruct() {
		
        //Hay que destruir los objetos
    }

    public function Tema($strTema){
		
	if (($strTema == vbRecaptchaTemaLight) || ($strTema = vbRecaptchaTemaDark)) $m_strTema = $strTema;
    }

    public function Tema(){
		
	return $m_strTema;

    }

    public function Tipo($strTipo){
		
	if (($strTipo == vbRecaptchaTipoImage) || ($strTipo = vbRecaptchaTipoAudio)) $m_strTipo = $strTipo;
    }

    public function Tipo(){
		
	return $m_strTipo;

    }

    // *****************************************************************************
    // * Dibujo
    // *****************************************************************************
	
    public function Dibuja(){
		
		dim strDibuja: strDibuja = ""
		
		objServidor.Error=""    	
		
		if (is_null($this->RecaptchaKeyPublic) || (RecaptchaKeyPublic=="")) $objServidor.Error = "No se encuentra la clave pública";

		if ($objServidor.Error=""){
			
			$this->DibujaScript();
		
			strDibuja .= "<div id=""" . NombreCaptcha . """ class=""g-recaptcha";
		
			if not isnull(Clase) AND Clase<>"" then strDibuja .= " " & Clase;
		
			strDibuja .= """ data-sitekey=""" . RecaptchaKeyPublic . """";
		
			if ($this->Tema!=vbRecaptchaTemaLight) strDibuja .= " data-theme=""" . Tema . """";
		
			if ($this->Tipo!=vbRecaptchaTipoImage) strDibuja .= " data-type=""" . Tipo . """";

			strDibuja .= "></div>";

			strDibuja .= "<noscript>";
			  strDibuja .= "<div style=""width: 302px; height: 352px;"">";
				strDibuja .= "<div style=""width: 302px; height: 352px; position: relative;"">";
				  strDibuja .= "<div style=""width: 302px; height: 352px; position: absolute;"">";
					strDibuja .= "<iframe src=""" . vbRecaptchaApi . "/fallback?k=" . RecaptchaKeyPublic . """";
							strDibuja .= "frameborder=""0"" scrolling=""no""";
							strDibuja .= "style=""width: 302px; height:352px; border-style: none;"">";
					strDibuja .= "</iframe>";
				  strDibuja .= "</div>";
				  strDibuja .= "<div style=""width: 250px; height: 80px; position: absolute; border-style: none;";
							  strDibuja .= "bottom: 21px; left: 25px; margin: 0px; padding: 0px; right: 25px;"">";
					strDibuja .= "<textarea id=""g-recaptcha-response"" name=""g-recaptcha-response""";
							  strDibuja .= "class=""g-recaptcha-response""";
							  strDibuja .= "style=""width: 250px; height: 80px; border: 1px solid #c1c1c1;";
									 strDibuja .= "margin: 0px; padding: 0px; resize: none;"" value="""">";
					strDibuja .= "</textarea>";
				  strDibuja .= "</div>";
				strDibuja .= "</div>";
			  strDibuja .= "</div>";
			strDibuja .= "</noscript>";
		
		}
		
        echo $strDibuja;

    }
    
    public Function Valida(){       
        
	$blnValida = false;

	$objServidor.Error=""; 

	if (is_null($this->RecaptchaKeyPrivate) || $this->RecaptchaKeyPrivate=="") $objServidor.Error = "No se encuentra la clave privada";
	if (($objServidor.Error == "") && (is_null($this->m_recaptcha_response_field) || ($this->m_recaptcha_response_field==""))) $objServidor.Error = "No se encuentra la respuesta del captcha";

	if ($objServidor.Error == "") $blnValida = $this->RecaptchaValido();
		
	return $blnValida;

     }
    
     // --------------------------------------
     // - Función que devuelve el js para el uso del captcha
     // --------------------------------------
     function DibujaScript(){
			
	$strDibujaScript = '<script src="' . vbRecaptchaApi . 'js?hl=' . Lenguaje . '"'></script>';

	echo $strDibujaScript;

     }

     // --------------------------------------
     // - Función que indica si hay un response del captcha
     // --------------------------------------
     public function ExisteRecaptcha(){
		
	if (!($this->m_recaptcha_response_field==null) && ($this->m_recaptcha_response_field!="")) {
	    return true;
	}else{
            return false;
	}
     }

     // --------------------------------------
     // - Función que valida el captcha
     // --------------------------------------
     function RecaptchaValido(){

		 
	$VarString = "secret=" . RecaptchaKeyPrivate;	
	$VarString .= "&response=" . m_recaptcha_response_field;
	$VarString .= "&remoteip=" . $_SERVER("REMOTE_ADDR");
	
        if (window.XMLHttpRequest){  // code for IE7+, Firefox, Chrome, Opera, Safari
             $objXmlHttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
             $objXmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        $objXmlHttp.open("POST",vbRecaptchaSiteverify,false);
        $objXmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        $objXmlHttp.send($VarString);
		
	$ResponseString = $objXmlHttp.responseText;
		
	$objJson = json_decode($ResponseString);

	$ResponseString = strtolower($objJson->success);

	unset($objXmlHttp); 

	if ($ResponseString == "true") {
	    // They answered correctly
	    return true;
	}else{
	    // They answered incorrectly
	    return false;
	}

     }
	   
}

?>