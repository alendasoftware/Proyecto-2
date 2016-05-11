<?Php
//Inclución de librerías
require ('AppCode/principal.inc.php');
//MetaContent
$MetaContent = "<title>" . vbPageTitle . "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$SectionContent .= $objSections->SectionSlider($objTraductor);
$SectionContent .= $objSections->SectionRecentsWorks($objTraductor);
$SectionContent .= $objSections->SectionPartner();
$SectionContent .= $objSections->SectionComment();

//ScriptContent
$ScriptContent = "";

//Inclución de plantilla
require ('site.master.php');

?>