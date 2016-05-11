<?Php

//Inclución de librerías
require ('AppCode/principal.inc.php');

$MetaContent = "<title>" . vbPageAuthor. "- " . $objTraductor->Traducir("Contactar") . "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$SectionContent .= $objSections->SectionContactpage($objParametros, $objTraductor);

//ScriptContent
$objFormulario->Id = "main-contact-form";
$objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
$ScriptContent = $objFormulario->DibujaScript();

//Inclución de plantilla
require ('site.master_v2.php');

?>