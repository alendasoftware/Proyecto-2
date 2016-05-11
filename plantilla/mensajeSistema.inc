<?php
$ScriptMensaje = "";

$blnError = false;
if ($objCookieSistema->Existe())
{
    $blnError = ($objCookieSistema->Lee() == "1");
    $objCookieSistema->Elimina();
}

if ($objCookieSistemaTexto->Existe()){

    $ScriptMensaje .= "<script>";
    if ($blnError)
    {
        $ScriptMensaje .= "$(\"#mensajeSistema .modal-body\").html(\"<p class='text-success'><i class='fa fa-check'>&nbsp;</i>" . $objCookieSistemaTexto->Lee() . "</p>\");";
    }
    else
    {
        $ScriptMensaje .= "$(\"#mensajeSistema .modal-body\").html(\"<p class='text-danger'><i class='fa fa-exclamation-triangle'>&nbsp;</i>" . $objCookieSistemaTexto->Lee() . "</p>\");";
    }
    $ScriptMensaje .= "$(\"#mensajeSistema\").modal(\"show\");";
    $ScriptMensaje .= "</script>";
    
    $objCookieSistemaTexto->Elimina();
}

?>