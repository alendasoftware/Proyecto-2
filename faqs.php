<?Php

//Incluci�n de librer�as
require ('AppCode/principal.inc.php');

$MetaContent = "<title>" . vbPageAuthor. "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$objFaq = new phpFaq();
$objFaq->Consulta();
$SectionContent .= $objSections->SectionFaqs($objFaq, $objTraductor);

unset($objFaq);

//ScriptContent
$ScriptContent = "";

//Incluci�n de plantilla
require ('site.master_v2.php');

?>