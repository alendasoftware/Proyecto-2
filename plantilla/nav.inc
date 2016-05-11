<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-4">
                <div class="top-number">
                    <p>
                        <?php
                        echo $objMenu->DibujaBanderas();                           
                        ?>
                    </p>
                 </div>
            </div>
            <div class="col-sm-6 col-xs-8">                    
                <div class="social">
                    <ul class="social-share">                            
                        <?php
                        $ListaSocial = "<li><a target=\"_blank\" href=\"http://www.facebook.com/pages/expocruceros\" title=\"Facebook\"><i class=\"fa fa-facebook\"></i></a>&nbsp;</li>";
                        $ListaSocial .= "<li><a target=\"_blank\" href=\"http://www.twitter.com/expocruceros\" title=\"Twitter\"><i class=\"fa fa-twitter\"></i></a>&nbsp;</li>";
                        $ListaSocial .= "<li><a target=\"_blank\" href=\"http://www.youtube.com\" title=\"Youtube\"><i class=\"fa fa-youtube\"></i></a>&nbsp;</li>";
                        $ListaSocial .= "<li><a class=\"fa-cabecera\" href=\"" . $objUrlAmigable->Amigable("noticias.php") . "\" title=\"" . $objTraductor->Traducir("Noticias") . "\"><i class=\"fa fa-inbox\"></i></a>&nbsp;</li>";                              
                        echo $ListaSocial;
                        ?>
                    </ul>
                    <div class="search">
                        <?php
                        $GeneralForm = "<form role=\"form\" action=\"" . $objUrlAmigable->Amigable("mapa-web.php") . "\" method=\"post\">";
                        $GeneralForm .= "<input type=\"text\" class=\"search-form\" autocomplete=\"off\" placeholder=\"" . $objTraductor->Traducir("Buscar") . "\">";
                        $GeneralForm .= "<i class=\"fa fa-search\"></i>";
                        $GeneralForm .= "</form>";
                        echo $GeneralForm;
                        ?>                                
                    </div>
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
                
                <?php
                $objCookie->Nombre = vbCookieUser;

                if (!$objCookie->Existe()) {
                    $LoginHeader = "<li class=\"login\">";
                    $LoginHeader .= "<a data-toggle=\"modal\" data-target=\"#loginForm\">";
                    $LoginHeader .= "<i class=\"fa fa-lock\"></i>";
                    $LoginHeader .= "</a>";
                    $LoginHeader .= "</li>";   
                    echo $LoginHeader;
                }
                ?>
                                                                                
            </ul>
        </div>
    </div><!--/.container-->
</nav><!--/nav-->