<footer id="footer" class="midnight-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img width="176" height="35" itemprop="logo" src="<?=$objParametros->Directorio?>/images/logoCompleto.png" alt="expocruceros">
                <i>Es un lugar donde encontrar información útil de cruceros y puertos</i>
            </div>
            <div class="col-md-8">
                <ul class="pull-right">
                    <?php
                    $Enlaces = "<li><a href=\"" . $objUrlAmigable->Amigable(null) . "\">" . $objTraductor->Traducir("Inicio") . "</a></li>";
                    $Enlaces .= "<li><a href=\"" . $objUrlAmigable->Amigable("quienes_somos.html?cod=10&nom=quienes_somos") . "\">Acerca de Expo Cruceros</a></li>";
                    $Enlaces .= "<li><a href=\"" . $objUrlAmigable->Amigable("opiniones.php?cod=12&nom=Opinar") . "\">Escribe una opinión</a></li>";
                    $Enlaces .= "<li><a href=\"" . $objUrlAmigable->Amigable("faqs.php?cod=5") . "\">Preguntas Frecuentes</a></li>";

                    $Enlaces .= "<li><a href=\"" . $objUrlAmigable->Amigable("contactar.php?cod=11") . "\">" . $objTraductor->Traducir("Contactar") . "</a></li>";
                    
                    $Enlaces .= "<li><a target=\"_blank\" href=\"http://www.facebook.com/pages/expocruceros\" title=\"Facebook\"><i class=\"fa fa-facebook\"></i></a>&nbsp;</li>";
                    $Enlaces .= "<li><a target=\"_blank\" href=\"http://www.twitter.com/expocruceros\" title=\"Twitter\"><i class=\"fa fa-twitter\"></i></a>&nbsp;</li>";

                    echo $Enlaces;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container copyrightFooter">
        <div class="row">
            <div class="col-md-12">
                <?php
                $Enlaces = "<a class=\"oferplay\" href=\"http://www.oferplay.com\" target=\"_blank\" />Desarrollado por Oferplay </a>&copy; " . date('Y') . " <a id=\" ". vbPageAuthor ."\" target=\"_blank\" href=\"http://s590808717.mialojamiento.es\" title=\"" . vbPageAuthor . "\">Expo Cruceros Todos los derechos reservados</a>.";
                $Enlaces .= "&nbsp;<a data-toggle=\"modal\" data-target=\"#pageAvisoLegal\" style=\"cursor:pointer\">" . $objTraductor->Traducir("AvisoLegal") . "</a> y <a data-toggle=\"modal\" data-target=\"#pagePoliticaCalidad\" style=\"cursor:pointer\">" . $objTraductor->Traducir("ProteccionDatos") . "</a> de Expo Cruceros.";
                echo $Enlaces;
                ?>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<?php
$ModalLogin = "<div class=\"modal fade in\" id=\"loginForm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
$ModalLogin .= "<div class=\"modal-dialog\">";
$ModalLogin .= "<div class=\"modal-content\">";
$ModalLogin .= "<div class=\"modal-header\">";
$ModalLogin .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">" . $objTraductor->Traducir("Cerrar") . "</span></button>";
$ModalLogin .= "<h4 class=\"modal-title\" id=\"myModalLabel\">" . $objTraductor->Traducir("IniciarSesion") . "</h4>";
$ModalLogin .= "</div>";
$ModalLogin .= "<div class=\"modal-body\">";
$ModalLogin .= "<form id=\"form-login\" class=\"form-inline\" method=\"post\" action=\"" . $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=validaHome\">";
$ModalLogin .= "<input name=\"usu_email\" class=\"input-small\" type=\"text\" placeholder=\"Email\" required=\"required\">&nbsp;&nbsp;";
$ModalLogin .= "<input name=\"usu_clave\" class=\"input-small\" type=\"password\" placeholder=\"" . $objTraductor->Traducir("Clave") . "\" required=\"required\">&nbsp;&nbsp;";
$ModalLogin .= "<button class=\"btn btn-primary\" type=\"submit\">" . $objTraductor->Traducir("Entrar") . "</button>";
$ModalLogin .= "</form>";
$ModalLogin .= "<a href=\"" . $objUrlAmigable->Amigable("recuperar.php?cod=" . vbPaginaCodigoInicio) . "\" title=\"" . $objTraductor->Traducir("RecupereClave") . "\">" . $objTraductor->Traducir("OlvidoClave") . "</a>";
$ModalLogin .= "</div>";
$ModalLogin .= "<div class=\"modal-footer\">";
$ModalLogin .= "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">" . $objTraductor->Traducir("Cerrar") . "</button>";
$ModalLogin .= "<!--<button type=\"button\" class=\"btn btn-primary\">Save changes</button>-->";
$ModalLogin .= "</div>";
$ModalLogin .= "</div>";
$ModalLogin .= "</div>";
$ModalLogin .= "</div>";

echo $ModalLogin;

$ModalElimina = "";
 if ($objUsuario->Conectado())
{
    $ModalElimina .= "<div class=\"modal fade in\" id=\"ModalElimina\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalEliminaLabel\" aria-hidden=\"true\">";
    $ModalElimina .= "<div class=\"modal-dialog\">";
    $ModalElimina .= "<div class=\"modal-content\">";
    $ModalElimina .= "<div class=\"modal-header\">";
    $ModalElimina .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">" . $objTraductor->Traducir("Cerrar") . "</span></button>";
    $ModalElimina .= "<h4 class=\"modal-title\" id=\"ModalEliminaLabel\">" . $objTraductor->Traducir("BajaCuenta") . "</h4>";
    $ModalElimina .= "</div>";
    $ModalElimina .= "<div class=\"modal-body\">";
    $ModalElimina .= "<form id=\"form-elimina\" class=\"form-inline\" method=\"post\" action=\"" . $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=elimina\">";
    $ModalElimina .= "<p>" . $objTraductor->Traducir("BajaCuentaTexto") . " <a href=\"mailto:" . $objParametros->CorreoAdmin . "\">" . $objParametros->CorreoAdmin . "</a></p>";
    $ModalElimina .= "<button class=\"btn btn-primary\" type=\"submit\">" . $objTraductor->Traducir("Eliminar") . "</button>";
    $ModalElimina .= "</form>";
    $ModalElimina .= "</div>";
    $ModalElimina .= "<div class=\"modal-footer\">";
    $ModalElimina .= "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">" . $objTraductor->Traducir("Cerrar") . "</button>";
    $ModalElimina .= "<!--<button type=\"button\" class=\"btn btn-primary\">Save changes</button>-->";
    $ModalElimina .= "</div>";
    $ModalElimina .= "</div>";
    $ModalElimina .= "</div>";
    $ModalElimina .= "</div>";
}

echo $ModalElimina;

$pageContent = new phpHtmlReader();
$pageContent->page = $objTraductor->getIdioma() . "/AvisoLegal.html";
echo $pageContent->Html();

$pageContent->page = $objTraductor->getIdioma() . "/ProteccionDatos.html";
echo $pageContent->Html();

$pageContent->page = $objTraductor->getIdioma() . "/PoliticaCookie.html";
echo $pageContent->Html();

$pageContent->page = $objTraductor->getIdioma() . "/MensajeSistema.html";
echo $pageContent->Html();

$PageIncludeJs = "<script src=\"" . $objParametros->Directorio . "/js/jquery.js\"></script>";
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/bootstrap.min.js\"></script>";
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/jquery.prettyPhoto.js\"></script>";
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/jquery.isotope.min.js\"></script>";
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/jquery.raty.js\"></script>";        
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/main.js\"></script>";
$PageIncludeJs .= "<script src=\"" . $objParametros->Directorio . "/js/wow.min.js\"></script>";

echo $PageIncludeJs;
?>