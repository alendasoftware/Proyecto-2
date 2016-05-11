<?Php

//Inclución de librerías
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

//Inclución de plantilla
require ('site.master_v2.php');

?>