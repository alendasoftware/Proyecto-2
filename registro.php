<?Php

//Incluci�n de librer�as
require ('AppCode/principal.inc.php');

$MetaContent = "<title>" . vbPageAuthor . " - " . $objTraductor->Traducir("Registro") . "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$SectionContent .= $objSections->SectionRegister($objParametros, $objTraductor);

//ScriptContent
$ScriptContent = "";

//Incluci�n de plantilla
require ('site.master_v2.php');

?>