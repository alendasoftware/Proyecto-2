<?Php
//Inclución de librerías
require ('AppCode/principal.inc.php');

$objEmpresa= new phpEmpresa();

$Codigo = $objUrlAmigable->Id();

$FormText = $objFormulario->ControlBuscador("expocruceros_empresa", 'formText');
$textoForm = "<form role=\"form\" action=\"" . $objEmpresa->UrlAmigableListado($objTraductor) . "\" target=\"_top\" method=\"post\">";
$textoForm .= "<input id='formText' name='formText' type='text' class='form-control search_box' autocomplete='off' placeholder='" . $objTraductor->Traducir("Buscar") . "' value='" . $FormText . "'/>";
$textoForm .= "</form>";

if ($Codigo > 0)
{
 	$objEmpresa->setCodigo($Codigo);

 	//MetaContent
    $MetaContent = "<title>" . vbPageAuthor. " - " . $objTraductor->Traducir("Productos") . " - " . $objEmpresa->Nombre . "</title>";
    $MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
    $MetaContent .= "<meta name=\"description\" content=\"" . $objEmpresa->Descripcion . "\">";
    $MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

    $objBuque= new phpBuque();
    $objBuque->Consulta($objEmpresa->getCodigo());
    $Lista = "";
    if ($objBuque->Datos->NumeroElementos() > 0)
    {
        while (!$objBuque->Datos->Eof())
        {
            $objBuque->Lee();

            $Lista .= $objBuque->DibujaListaImagen();

            $objBuque->ReiniciaObjetos();
            $objBuque->Datos->Siguiente();
        }
    }
    unset($objBuque);

    //SectionContent
    $SectionContent = $objSections->SectionService($objEmpresa->Nombre, $objEmpresa->Descripcion, $objParametros->UrlSubidas . "/empresas/". $objEmpresa->Logo, $Lista, $objEmpresa->Web);

}else{
	$FormText = $objFormulario->RecogeParametro("formText");

    //MetaContent
	$MetaContent = "<title>" . vbPageTitle . "</title>";
	$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
	$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
	$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

	$objBuque= new phpBuque();
    $objBuque->ConsultaBuscador($FormText);
    $Lista = "";
    if ($objBuque->Datos->NumeroElementos() > 0)
    {
        while (!$objBuque->Datos->Eof())
        {
            $objBuque->Lee();

            $Lista .= $objBuque->DibujaListaImagen();

            $objBuque->ReiniciaObjetos();
            $objBuque->Datos->Siguiente();
        }
    }else{

        $Lista .= "<div class=\"container\"><div class=\"row\"><div class=\"col-md-12 text-center\"><h3>No hemos encontrado lo que busca. Acceda a nuestra zona de cruceros y podrás encontrar todos nuestros barcos-</h3></div></div></div>";
    }
    unset($objBuque);

    //SectionContent
    $SectionContent = $objSections->SectionService($objEmpresa->Nombre, $objEmpresa->Descripcion, $objParametros->UrlSubidas . "/empresas/". $objEmpresa->Logo, $Lista, $objEmpresa->Web);
}

unset($objEmpresa);

//ScriptContent
$ScriptContent = "";

//Inclución de plantilla
require ('site.master_v2.php');

?>