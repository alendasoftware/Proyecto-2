<?Php
//Incluci�n de librer�as
require ('AppCode/principal.inc.php');
//MetaContent
$MetaContent = "<title>" . vbPageTitle . "</title>";
$MetaContent .= "<meta name=\"author\" content=\"" . vbPageAuthor. "\">";
$MetaContent .= "<meta name=\"description\" content=\"" . vbPageDescription . "\">";
$MetaContent .= "<meta name=\"keywords\" content=\"" . vbPageKeyWords . "\">";

//SectionContent
$SectionContent = "";
$SectionContent .= $objSections->SectionSlider_v2($objTraductor);
//$SectionContent .= $objSections->SectionRecentsWorks($objTraductor);
$SectionContent .= $objSections->SectionCrucerosMin($objParametros, $objTraductor);
$SectionContent .= $objSections->SectionPrincipalHome($objParametros, $objTraductor);
//$SectionContent .= $objSections->SectionPartner();
//$SectionContent .= $objSections->SectionComment();

//ScriptContent
$ScriptContent = "";

//Incluci�n de plantilla
require ('site.master_v2.php');
?>