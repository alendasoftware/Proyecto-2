<?php
$strClaseUsuario = "";
if ($objUsuario->Conectado()) $strClaseUsuario = " user-bar";
echo "<div class=\"top-bar" . $strClaseUsuario . "\">"
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <?php
                if ($objUsuario->Conectado()){
                    echo $HtmlUser;        
                }
                ?>      
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="social <?php if ($objUsuario->Conectado()){ echo "hidden-xs";}?>">
                    <ul class="list-inline cabeceraUsuarios">
                        <?php  
                        $LoginHeader = "";
                        if (!$objUsuario->Conectado()){
                           
                            $LoginHeader .= "<li><a title=\"Únete\" href=\"" . $objUrlAmigable->Amigable("registro.php") . "\">UNIRSE</a></li>";    
                            $LoginHeader .= "<li>";
                            $LoginHeader .= "<a itle=\"INICIAR SESIÓN\" data-toggle=\"modal\" data-target=\"#loginForm\">";
                            $LoginHeader .= "INICIAR SESIÓN</a>";
                            $LoginHeader .= "</li>";   
                        }else{
                          $LoginHeader .= "<li>";
                            $LoginHeader .= "<a title=\"DESCONECTAR\" href=\"" . $objParametros->Directorio . "/controlUsuario.php?uA=desconecta&uS=" . session_id() . "\">";
                            $LoginHeader .= "<i class=\"fa fa-sign-out\"></i>&nbsp;DESCONECTAR</a>";
                            $LoginHeader .= "</li>";     
                        }
                        $LoginHeader .= "<li><a target=\"_blank\" href=\"http://www.facebook.com/pages/expocruceros\" title=\"Facebook\"><i class=\"fa fa-facebook\"></i></a>&nbsp;</li>";
                        $LoginHeader .= "<li><a target=\"_blank\" href=\"http://www.twitter.com/expocruceros\" title=\"Twitter\"><i class=\"fa fa-twitter\"></i></a>&nbsp;</li>";
                        echo $LoginHeader;
                        ?>

                        <li>
                            <?php
                            echo $objMenu->DibujaBanderas();                           
                            ?>
                        </li>
                    </ul>        
                </div>
            </div>
        </div>
    </div><!--/.container-->
</div><!--/.top-bar-->

<nav class="navbar navbar-inverse" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            $LogoHeader = "<a class=\"navbar-brand\" href=\"" . $objUrlAmigable->Amigable(null) . "\"><img alt=\"" . vbPageAuthor . "\" src=\"" . $objParametros->Directorio . "/images/logo.png\" /></a>";
            echo $LogoHeader;                   
            ?>
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <!--Menu-->
                <?php
                $objMenu->Consulta($objMenu->PaginaInicio, false);
                echo $objMenu->DibujaMenu();
                ?>  
            </ul>
        </div>
    </div><!--/.container-->
</nav><!--/nav-->