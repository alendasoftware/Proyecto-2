<?Php
//Inclución de librerías
require ('AppCode/principal.inc.php');

$objBuque = new phpBuque();

$Codigo = $objUrlAmigable->Id();
$Nav = $objUrlAmigable->Nav();
if (is_null($Nav) || ($Nav=="")) $Nav = "0";
//$FormText = $objFormulario->ControlBuscador("expocruceros_empresa", 'formText');
//$textoForm = "<form role=\"form\" action=\"" . $objEmpresa->UrlAmigableListado($objTraductor) . "\" target=\"_top\" method=\"post\">";
//$textoForm .= "<input id='formText' name='formText' type='text' class='form-control search_box' autocomplete='off' placeholder='" . $objTraductor->Traducir("Buscar") . "' value='" . $FormText . "'/>";
//$textoForm .= "</form>";

if ($Codigo > 0)
{
 	$objBuque->setCodigo($Codigo);

 	//MetaContent
    $MetaContent = "<title>" . vbPageAuthor. " - " . $objTraductor->Traducir("Productos") . " - " . $objBuque->Nombre . "</title>";
    $MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
    $MetaContent .= "<meta name=\"description\" content=\"" . $objBuque->DescripcionCorta . "\">";
    $MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

    //Etiquetas
    $etiquetas = "";
    $objBuques = new phpBuque();
    $objBuques->Consulta($objBuque->Empresa()->getCodigo());
    if ($objBuques->Datos->NumeroElementos() > 0)
    {
        $etiquetas = $objBuques->DibujaEtiquetaTodos(-1, $objBuque->Empresa()->getCodigo(), $objTraductor);
        while (!$objBuques->Datos->Eof())
        {
            $objBuques->Lee();

            $etiquetas .=  $objBuques->DibujaEtiqueta($objBuque->getCodigo());

            $objBuques->Datos->Siguiente();
            $objBuques->ReiniciaObjetos();
        }
    }
    
	
	//Imagenes
	$imagenes="";
    if ($objBuque->Imagen()->Datos->NumeroElementos() > 0)
    {
        $imagenes .= $objBuque->Imagen()->DibujaAbreImagen($objTraductor->Traducir("Imagenes"));
        while (!$objBuque->Imagen()->Datos->Eof())
        {
            $objBuque->Imagen()->Lee();

            $imagenes .= $objBuque->Imagen()->DibujaImagen("buques/" . $objBuque->getCodigo() ."/imagenes/");

            $objBuque->Imagen()->Datos->Siguiente();            
        }
        $imagenes .= $objBuque->Imagen()->DibujaCierraImagen();
    }

    //SectionContent
    $SectionContent = $objSections->SectionBlog($objBuque, null, "Buques", $etiquetas, $imagenes, null, $Nav, $objParametros, $objTraductor, $objUsuario);
    
    $objFormulario->Id = "opinion-comment-form";
    $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
    $ScriptContent = $objFormulario->DibujaScript();
    //$ScriptContent = "";
    
    unset($objBuques);

}else{
	//MetaContent
	$MetaContent = "<title>" . vbPageTitle . "</title>";
	$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
	$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
	$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

	//SectionContent
	$SectionContent = $objSections->SectionBlog(null, null, "Buques", null, null, null, null, null, null);
    
    //ScriptContent
    $ScriptContent = "";
}

unset($objEmpresa);

//Inclución de plantilla
require ('site.master_v2.php');

?>