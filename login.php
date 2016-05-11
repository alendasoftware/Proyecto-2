<?Php

//Inclución de librerías
require ('AppCode/principal.inc.php');

$MetaContent = "<title>" . vbPageAuthor . " - " . $objTraductor->Traducir("IniciarSesion") . "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$SectionContent .= $objSections->SectionLogin($objParametros, $objTraductor, $objUrlAmigable);

//ScriptContent
$ScriptContent = "";

//Inclución de plantilla
require ('site.master_v2.php');

?>