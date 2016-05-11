<?php
$HtmlUser = "";
if ($objUsuario->Conectado()){

    $objUsuario->setCodigo($objCookieUsuario->Lee());

    $HtmlUser .= "<div id=\"user\" class=\"row wow fadeInDown\">";
        $HtmlUser .= "<div class=\"icon-user\" style=\"text-align:left;float:left;margin-right:10px;\">";
        
        $HtmlUser .= "<a href=\"" . $objParametros->Directorio . "/usuario.php?uS=" . session_id() . "\" title=\"Mi perfil\">";

        if (($objUsuario->Avatar!=null)&&($objUsuario->Avatar!="")) {
            $HtmlUser .= "<img class=\"img-circle avatar-cabecera\" src=\"". $objParametros->Directorio . "/subidas/usuarios/" . $objUsuario->Avatar . "\" alt=\"" . $objUsuario->AvatarNombre . "\">";
        }else{
            $HtmlUser .= "<i class=\"fa fa-user\"></i>";
        }
        
        //$HtmlUser .= "&nbsp;MI PERFIL (" . $objUsuario->AvatarNombre .")";
        $HtmlUser .= "MI PERFIL";

        $HtmlUser .= "</a></div>";
        
    	$HtmlUser .= "<div style=\"text-align:right;float:left;\">";
        $HtmlUser .= "<span></span><a href=\"" . $objUrlAmigable->Amigable("opiniones.php?cod=12&id=" . $objUsuario->getCodigo() . "&nom=Opinar") . "\" title=\"Mis opiniones\"><i class=\"fa fa-comment\"></i>&nbsp;MIS OPINIONES</a>";
        $HtmlUser .= "</div>";

        $HtmlUser .= "<div class=\"visible-xs\" style=\"text-align:right;float:right;\">";
        $HtmlUser .= "<span></span><a href=\"" . $objParametros->Directorio . "/controlUsuario.php?uA=desconecta&uS=" . session_id() . "\" title=\"DESCONECTAR\"><i class=\"fa fa-sign-out\"></i>&nbsp;DESCONECTAR</a>";
        $HtmlUser .= "</div>";

        //$HtmlUser .= "<div class=\"col-md-3 col-xs-12\" style=\"text-align:right;\">";
        //$HtmlUser .= "<span></span><a href=\"" . $objParametros->Directorio . "/controlUsuario.php?uA=desconecta&uS=" . session_id() . "\" title=\"Cerrar sesión\"><i class=\"fa fa-sign-out\"></i>&nbsp;DESCONECTAR</a>";
        //$HtmlUser .= "</div>";
    
    $HtmlUser .= "</div>";
   	//echo $HtmlUser;
}
?>