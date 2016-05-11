<?php

Class phpParametros{
    
    //Propiedades Públicas 
    public $Error;
    public $Proyecto;
    public $ProyectoNombre;
    public $ProyectoPara;
    public $Desarrollo;
    public $Url;
    public $UrlSubidas;
    public $Directorio;
    public $DirectorioRaiz;
    public $CorreoAdmin;
    public $Despedida;
    public $ProteccionDatos;
    public $ProteccionDatosEn;
    
    //Propiedades Privadas
    private $_Servidor;

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    public function __construct(){
        
        $this->_Servidor = new phpServidor();

        $this->Error = "";
        $this->Proyecto = "Expocruceros";
        $this->ProyectoPara = "Expocruceros";
        $this->ProyectoNombre = "Bienvenido a expocruceros";
        $this->Desarrollo = false;
        $this->CorreoAdmin = 'info@expocruceros.com';   

        $Port = $_SERVER['SERVER_PORT'];

        $this->Url = "http://";
        $this->Url .= $this->_Servidor->ServidorActual;

        if ($this->_Servidor->Entorno() == vbServidorEntornoDesarrollo)
        {
            $this->Desarrollo = true;
            $this->Url .= ":" . $Port;
            $this->Directorio = $this->Url . "/expocruceros";
            $this->DirectorioRaiz = "/expocruceros";
        }
        else
        {            
            $this->Directorio = $this->Url . "";
            $this->DirectorioRaiz = "";
        }

        $this->UrlSubidas = $this->Directorio . "/subidas";

        $this->Despedida = "<hr/><p>C/Prueba 5<br/>";
        $this->Despedida .= "E-29004 M&aacute;laga (Espa&ntilde;a)<br/>";
        $this->Despedida .= "Tlf: +34 952 00 00 00<br/>";
        $this->Despedida .= "Fax: +34 952 00 00 00<br/><br/>";
        $this->Despedida .= "E-mail: <a target=\"_blank\" href=\"mailto:info@expocruceros.com\">info@expocruceros.com</a></p>";

        $this->ProteccionDatos = "<p style=\"font-size:0.8em;\">Este correo electr&oacute;nico y la informaci&oacute;n contenida en el mismo es de car&aacute;cter confidencial y est&aacute; sometida al secreto profesional, dirigi&eacute;ndose exclusivamente al destinatario mencionado en el encabezamiento, cuyos datos forman parte de un fichero responsabilidad de EXPOCRUCEROS y cuya finalidad es contactar con el titular de los datos a trav&eacute;s del correo electr&oacute;nico. En el caso de que el destinatario de este correo fuera un Proveedor, un Distribuidor o un cliente, le informamos que cuenta con m&aacute;s informaci&oacute;n relativa a protecci&oacute;n de datos en el aviso legal existente en www.expocruceros.com. De cualquier forma, le informamos que cuenta con los derechos de acceso, rectificaci&oacute;n y cancelaci&oacute;n, que podr&aacute; ejercitar en la direcci&oacute;n arriba indicada o mediante el env&iacute;o de un e-mail a <a target=\"_blank\" href=\"mailto:info@expocruceros.com\">info@expocruceros.com</a>. Si el receptor de la comunicaci&oacute;n no fuera el destinatario, le informamos que cualquier divulgaci&oacute;n, copia, distribuci&oacute;n o utilizaci&oacute;n no autorizada de la informaci&oacute;n contenida en la misma est&aacute; prohibida por la legislaci&oacute;n vigente.En el supuesto de que Usted no desee recibir informaci&oacute;n acerca de las novedades ofertadas por EXPOCRUCEROS, comun&iacute;quenoslo enviando su negativa a la direcci&oacute;n de correo electr&oacute;nico <a target=\"_blank\" href=\"mailto:info@expocruceros.com\">info@expocruceros.com</a></p>";
        $this->ProteccionDatos .= "<p style=\"font-size:0.8em;\">Si no desea recibir mas informaci&oacute;n ,<a target=\"_blank\" href=\"mailto:info@expocruceros.com?subject=Baja+publicidad&body=Desear&iacute;a+no+recibir+m&aacute;s+informaci&oacute;n+acerca+de+su+empresa.\">pinche aqu&iacute;</a></p>";

        $this->ProteccionDatosEn = "<p style=\"font-size:0.8em;\">This email and the information contained herein is confidential and is subject to professional secrecy, exclusively addressing the recipient mentioned in the header, whose data are part of a file for TEST and whose purpose is to contact the owner of the data via email. In the event that the recipient of this mail out a supplier, a distributor or a customer, we inform you with more information on data protection in the existing legal notice www.expocruceros.com. Anyway, we inform you that you have the rights of access, rectification and cancellation, which may exercise at the above address or by sending an e-mail address <a target=\"_blank\" href=\"mailto:info@expocruceros.com\">info@expocruceros.com</a>. If the recipient of the communication is not the intended recipient, please note that any disclosure, copying, distribution or unauthorized use of the information contained therein is prohibited by the law vigente.En the assumption that you do not want to receive information about the innovations offered by Test tell his refusal to send email <a target=\"_blank\" href=\"mailto:info@expocruceros.com\">info@expocruceros.com</a></p>";
        $this->ProteccionDatosEn .= "<p style=\"font-size:0.8em;\">If you do not wish to receive more information ,<a target=\"_blank\" href=\"mailto:info@expocruceros.com?subject=Baja+publicidad&body=Desear&iacute;a+no+recibir+m&aacute;s+informaci&oacute;n+acerca+de+su+empresa.\">click here</a></p>";
    }

    function __destruct() {
        
        //Hay que destruir los objetos
        unset($this->_Servidor); 
    }

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    
    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public Function DevuelveCadena(){
    
        $strValor = "";
   
        $strValor .= "Error:" . $this->Error . ";";
        $strValor .= "Proyecto:" . $this->Proyecto . ";";
        $strValor .= "ProyectoNombre:" . $this->ProyectoNombre . ";";
        $strValor .= "ProyectoPara:" . $this->ProyectoPara . ";";
        $strValor .= "Desarrollo:" . $this->Desarrollo . ";";
        $strValor .= "Url:" . $this->Url . ";";
        $strValor .= "UrlSubidas:" . $this->UrlSubidas . ";";
        $strValor .= "Directorio:" . $this->Directorio . ";";
        $strValor .= "DirectorioRaiz:" . $this->DirectorioRaiz . ";";
        $strValor .= "CorreoAdmin:" . $this->CorreoAdmin . ";";
        $strValor .= "Despedida:" . $this->Despedida . ";";
        $strValor .= "ProteccionDatos:" . $this->ProteccionDatos . ";";
        $strValor .= "ProteccionDatosEn:" . $this->ProteccionDatosEn . ";";
        
        return $strValor;

     }  
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
}
?>