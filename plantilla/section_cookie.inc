<?php
$CookieMensaje = "";

$objCookie = new phpCookie();
$objCookie->Nombre = "Expocruceros";

if (!$objCookie->Existe())
{
    $objCookie->Valor = "Política de cookies";
    $objCookie->Agrega();
    $CookieMensaje = $objCookie->DibujaAviso($objTraductor);
}

$objCookieSistema = new phpCookie();  
$objCookieSistema->Session = true;      
$objCookieSistema->Nombre = "sistema";

$objCookieSistemaTexto = new phpCookie();
$objCookieSistema->Session = true;
$objCookieSistemaTexto->Nombre = "sistema_texto";

$objCookieUsuario = new phpCookie();
$objCookieUsuario->Nombre = vbCookieUser;

?>