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

$Codigo = $objUrlAmigable->Id();

if ($Codigo > 0)
{
	$SectionContent .= $objSections->SectionOpinionesUsuario($objParametros, $objTraductor, $Codigo);
}else{
	$SectionContent .= $objSections->SectionOpinar($objParametros, $objTraductor, $objUrlAmigable);	
}

//ScriptContent
$ScriptContent = "";

//Inclución de plantilla
require ('site.master_v2.php');
?>