<?php
// ##############################################################################
// # ARCHIVO:       sections.inc.php - Versión 1.0
// # DESCRIPCION:   
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
    
class phpSections{

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    function SectionUnderConstruction($objTraductor){
      
      $Section = "";

        $Section .= "<section id=\"error\" class=\"container text-center\">";
          $Section .= "<h1>Página no disponible</h1>";
          $Section .= "<p>La página que ha solicitado aún no está disponible, podrá consultarla en breve.</p>";
          $Section .= "<a class=\"btn btn-primary\" href=\"/expocruceros/index.php\">VUELVA A LA PÁGINA DE INCIO</a>";
        $Section .= "</section><!--/#error-->";

        return $Section;
    } 
    
    function SectionError($objTraductor){
      
      $Section = "";

        $Section .= "<section id=\"error\" class=\"container text-center\">";
          $Section .= "<h1>Página no disponible</h1>";
          $Section .= "<p class=\"text-danger\"><i class=\"fa fa-2x fa-exclamation-triangle\"></i>&nbsp;La página que has solicitado no existe.</p>";
          $Section .= "<a class=\"btn btn-primary\" href=\"/expocruceros/index.php\">VUELVA A LA PÁGINA DE INCIO</a>";
        $Section .= "</section><!--/#error-->";

        return $Section;
    } 
    
    function SectionAboutUs($objTraductor){
        
        $Section = "";

        $Section .= "<section id=\"about-us\">";
            $Section .= "<div class=\"container\">";
                $Section .= "<div class=\"center wow fadeInDown\">";
                    $Section .= "<h2>¿Quiénes somos?</h2>";
                    $Section .= "<p class=\"lead textoCentrado\">";
                        $Section .= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in laoreet nunc. Sed fringilla orci elit, ut vulputate dui luctus vulputate. Proin ac congue orci. Phasellus tincidunt, tellus nec ultricies tristique, nunc felis lacinia risus, id euismod velit magna eget leo. Morbi dignissim risus et velit maximus, et sollicitudin augue porta. Etiam sed molestie est, ut imperdiet ante. Nulla id tempor eros. Etiam vitae tincidunt lectus, sit amet laoreet quam. Nulla cursus elit orci, porta faucibus velit eleifend vel. Phasellus vulputate massa a metus semper, sit amet rutrum risus cursus. Proin et luctus nulla. Duis egestas tincidunt augue, ac imperdiet felis condimentum id. Sed sed massa ac nisi consectetur imperdiet.";
                        $Section .= "<br/><br/>";
                        $Section .= "Curabitur at nunc non ipsum blandit pellentesque ut non dui. Nunc eu neque venenatis, ullamcorper lectus vitae, consectetur mauris. Ut varius nisi purus, et pellentesque velit aliquam ac. Pellentesque tincidunt arcu elit, tristique ornare orci rutrum quis. Ut sapien nunc, sodales nec nulla non, ullamcorper maximus nulla. Donec finibus aliquam congue. Suspendisse potenti. Nulla ac velit tellus.";
                        $Section .= "<br/><br/>";
                        $Section .= "Fusce lacinia et libero sit amet auctor. Morbi consequat elementum augue at scelerisque. Donec ornare erat erat, sit amet auctor arcu fringilla id. Nullam nisl justo, suscipit eu faucibus aliquam, commodo sed diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lobortis porttitor dolor, et posuere nunc dapibus eu. Pellentesque gravida, lorem et dapibus tincidunt, massa nisl consectetur sem, a maximus leo justo nec odio. Donec maximus sem sit amet tincidunt vehicula. Mauris eu lectus eget lorem laoreet commodo quis volutpat velit. Integer vitae euismod mauris. Ut sit amet vestibulum nisl, vel vehicula dolor.";
                        $Section .= "<br/><br/>";
                        $Section .= "Proin ac pretium felis. Nulla turpis odio, finibus pulvinar augue nec, porttitor molestie lectus. Integer eleifend urna diam, sed tempor est molestie non. Nam lacinia metus quis sem malesuada feugiat. Duis ac posuere lorem. Phasellus ex velit, malesuada iaculis ante in, porta consequat quam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi scelerisque justo tincidunt enim mattis, eu semper sapien gravida. In nisl nisi, faucibus at lacus non, condimentum posuere augue. Phasellus feugiat nibh sed fringilla condimentum. Fusce malesuada augue et orci volutpat ornare. Nullam vitae sollicitudin sapien. Ut eros odio, porttitor sit amet nulla sed, malesuada ultricies nisl. Mauris tempus, mauris sit amet ultrices iaculis, justo risus finibus eros, in varius odio lacus nec lacus.";
                        $Section .= "<br/><br/>";
                        $Section .= "Maecenas quam nunc, interdum sit amet ultrices ut, feugiat ac massa. Nunc et vulputate dui, feugiat dignissim odio. Sed nec eros ipsum. Praesent nisl nisl, fringilla sit amet ex sit amet, dignissim egestas nulla. Nulla facilisi. Nulla egestas sodales ante, hendrerit imperdiet quam varius non. Sed vulputate bibendum nunc at pellentesque. Pellentesque convallis maximus nunc quis euismod. In convallis ipsum erat, accumsan pulvinar dui rutrum nec.";
                    $Section .= "</p>";
                $Section .= "</div>";      
            $Section .= "</div><!--/.container-->";
        $Section .= "</section><!--/about-us-->";

        return $Section;
    }

    function SectionFaqs($objFaq, $objTraductor){
        
        $i=1;

        $Section = "";

        $Section .= "<section id=\"faqs\" class=\"container\">";
          
          $Section .= "<div class=\"center\">";
              $Section .= "<h2>Respondemos a tus dudas</h2>";
              $Section .= "<p class=\"lead\">Si no encuestras lo que buscas. Ponte en contacto con nosotros y te ayudaremos</p>";
          $Section .= "</div>";

          $Section .= "<div class=\"row\">";
            $Section .= "<div class=\"col-sm-12 wow fadeInDown animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
              $Section .= "<div class=\"accordion\">";
             
              if ($objFaq->Datos->NumeroElementos() > 0)
              {
                  while (!$objFaq->Datos->Eof())
                  {
                      $objFaq->Lee();

                      $Section .= "<div class=\"panel panel-default\">";
                        $Section .= "<div class=\"panel-heading";
                        if ($i==1) $Section .= " active";
                        $Section .= "\">";
                          $Section .= "<h3 class=\"panel-title\">";
                            $Section .= "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion" . $i . "\" href=\"#collapseTwo" . $i . "\">";
                              $Section .= $i . ": " . $objFaq->Nombre;
                              $Section .= "<i class=\"fa fa-angle-right pull-right\"></i>";
                            $Section .= "</a>";
                          $Section .= "</h3>";
                        $Section .= "</div>";
                        $Section .= "<div id=\"collapseTwo" . $i . "\" class=\"panel-collapse";
                        if ($i==1) {
                          $Section .= " in";
                        }else{
                          $Section .= " collapse";  
                        }                         
                        $Section .= "\">";
                          $Section .= "<div class=\"panel-body\">";
                            $Section .= $objFaq->Descripcion;
                          $Section .= "</div>";
                        $Section .= "</div>";
                      $Section .= "</div>";
                      
                      $i++;

                      $objFaq->ReiniciaObjetos();
                      $objFaq->Datos->Siguiente();
                  }
              }

               

          $Section .= "</div>";
          $Section .= "</div>";
          $Section .= "</div><!--/.blog-->";

        $Section .= "</section>";

        return $Section;
    }

    function SectionSlider($objTraductor){

        $Section = "";

        //ItemSlider
        $SelectorSlider = "";
        $ItemSlider = "";

        $objBanner = new phpBanner();
        $objBanner->Consulta();
        if ($objBanner->Datos->NumeroElementos() > 0)
        {
            while (!$objBanner->Datos->Eof())
            {
                $objBanner->Lee();
                $SelectorSlider .= $objBanner->DibujaSelectorSlider();
                $ItemSlider .= $objBanner->DibujaSlider($objTraductor->Traducir("LeerMas"));

                $objBanner->Datos->Siguiente();
                $objBanner->ReiniciaObjetos();
            }
        }
        unset($objBanner);

        $Section .= "<!--/#main-slider-->";
        $Section .= "<section id=\"main-slider\" class=\"no-margin\">";

            $Section .= "<div class=\"carousel slide\">";
                $Section .= "<ol class=\"carousel-indicators\">";
                    $Section .= $SelectorSlider;
                $Section .= "</ol>";
                $Section .= "<div class=\"carousel-inner\">";
                    $Section .= $ItemSlider;
                $Section .= "</div><!--/.carousel-inner-->";
            $Section .= "</div><!--/.carousel-->";
            $Section .= "<a class=\"prev hidden-xs\" href=\"#main-slider\" data-slide=\"prev\">";
                $Section .= "<i class=\"fa fa-chevron-left\"></i>";
            $Section .= "</a>";
            $Section .= "<a class=\"next hidden-xs\" href=\"#main-slider\" data-slide=\"next\">";
                $Section .= "<i class=\"fa fa-chevron-right\"></i>";
            $Section .= "</a>";

        $Section .= "</section><!--/#main-slider-->";

        return $Section;
    }

    function SectionSlider_v2($objTraductor){

        $Section = "";

        //ItemSlider
        $SelectorSlider = "";
        $ItemSlider = "";

        $objBanner = new phpBanner();
        $objBanner->Consulta();
        if ($objBanner->Datos->NumeroElementos() > 0)
        {
            while (!$objBanner->Datos->Eof())
            {
                $objBanner->Lee();
                $SelectorSlider .= $objBanner->DibujaSelectorSlider();
                $ItemSlider .= $objBanner->DibujaSlider($objTraductor->Traducir("LeerMas"));

                $objBanner->Datos->Siguiente();
                $objBanner->ReiniciaObjetos();
            }
        }
        unset($objBanner);

        $objEmpresa = new phpEmpresa();
        $Section .= "<!--/#main-search-->";
        
        $Section .= "<!--NUEVO ***-->";
   
            $Section .= "<div id=\"capaBuscadorSlider\">";
                $Section .= "<div class=\"row text-center\"><h2>Encuentre su crucero y opine</h2></div>";
                $Section .= "<div class=\"row\">";
                    $Section .= "<div class=\"col-xs-12 col-md-5\">";
                        $Section .= "<h3>". vbPageTitle . "</h3>";
                    $Section .= "</div>";
                    $Section .= "<div class=\"col-xs-12 col-md-7\">";
                        $Section .= "<div class=\"row\">";
                            $Section .= "<form id=\"form-main-search\" name=\"main-search\" method=\"post\" action=\"" . $objEmpresa->UrlAmigableBuscador() . "\" /><div class=\"col-xs-12 col-md-8\"><input class=\"form-control\" type=\"text\" placeholder=\"Busque su crucero\" name=\"formText\"></div><div class=\"col-xs-12 col-md-4 text-center\"><button class=\"buttonNaranja btn btn-default\" type=\"submmit\">Encontrar cruceros</button></div>";
                            $Section .= "</form>";
                        $Section .= "</div>";
                    $Section .= "</div>";
                $Section .= "</div>";
            $Section .= "</div>";
        
        $Section .= "<!--NUEVO ***-->";
        
        unset($objEmpresa);

        $Section .= "<!--/#main-slider-->";
        $Section .= "<section id=\"main-slider\" class=\"no-margin\">";
            $Section .= "<div class=\"carousel slide\">";
                $Section .= "<ol class=\"carousel-indicators\">";
                    $Section .= $SelectorSlider;
                $Section .= "</ol>";
                $Section .= "<div class=\"carousel-inner\">";
                    $Section .= $ItemSlider;
                $Section .= "</div><!--/.carousel-inner-->";
            $Section .= "</div><!--/.carousel-->";
            $Section .= "<a class=\"prev hidden-xs\" href=\"#main-slider\" data-slide=\"prev\">";
                $Section .= "<i class=\"fa fa-chevron-left\"></i>";
            $Section .= "</a>";
            $Section .= "<a class=\"next hidden-xs\" href=\"#main-slider\" data-slide=\"next\">";
                $Section .= "<i class=\"fa fa-chevron-right\"></i>";
            $Section .= "</a>";
        $Section .= "</section><!--/#main-slider-->";

        return $Section;
    }

    function SectionRecentsWorks($objTraductor){
        
        $Section = "";

        //RecentsWorks
        //ProductoTipo objProductoTipo = new ProductoTipo();
        //objProductoTipo.Consulta();

        $EmpresaListaEtiquetas = "";
        $EmpresaLista = "";

        $objEmpresa = new phpEmpresa();
        $strEtiqueta = $objTraductor->Traducir("Ver");
        //if (objProductoTipo.Datos.NumeroElementos() > 0)
        //{
            //while (!objProductoTipo.Datos.Eof())
            //{
                //objProductoTipo.Lee();
                //ProductoListaEtiquetas.Text += objProductoTipo.DibujaProductoHome();

                $objEmpresa->Consulta();

                if ($objEmpresa->Datos->NumeroElementos() > 0)
                {                    
                    while (!$objEmpresa->Datos->Eof())
                    {
                        $objEmpresa->Lee();

                        $EmpresaLista .= $objEmpresa->DibujaHome("", $strEtiqueta);

                        $objEmpresa->ReiniciaObjetos();
                        $objEmpresa->Datos->Siguiente();
                    }
                }

                //objProductoTipo.Datos.Siguiente();
                //objProductoTipo.ReiniciaObjetos();
            //}
        //}

        //objProductoTipo.Dispose();
        unset($objEmpresa);

        $Section .= "<!--/#RecentWorks-->";
        $Section .= "<section id=\"portfolio\">";
            $Section .= "<div class=\"container\">";
                
                $Section .= "<div class=\"center\">";
                    $Section .= "<h2>";
                        $Section .= $objTraductor->Traducir("NuestrosProductos");
                    $Section .= "</h2>";
                    $Section .= "<p class=\"lead\">";
                        $Section .= $objTraductor->Traducir("NuestrosProductosTexto");                
                    $Section .= "</p>";
                $Section .= "</div>";
            
                /*$Section .= "<ul class=\"portfolio-filter text-center\">";
                    $Section .= "<li><a class=\"btn btn-default active\" href=\"#\" data-filter=\"*\">";
                            $Section .= $objTraductor->Traducir("Todos");
                        $Section .= "</a>";
                    $Section .= "</li>";
                    $Section .= "<!--Etiquetas-->";
                    $Section .= $EmpresaListaEtiquetas;
                $Section .= "</ul><!--/#portfolio-filter-->";*/

                $Section .= "<div class=\"row\">";
                    $Section .= "<div class=\"portfolio-items\">";
                        $Section .= "<!--Empresas-->";
                        $Section .= $EmpresaLista;              
                    $Section .= "</div>";
                $Section .= "</div>";
               
            $Section .= "</div>";
        $Section .= "</section><!--/#RecentWorks-->";

        return $Section;
    }    

    function SectionCrucerosMin($objParametros, $objTraductor){
        
        $Section = "";

        $Section = "<section id=\"sliderCrucerosMin\">";
        /*
        $Section .= "<div class=\"container\"><div class=\"row\"><div class=\"col-md-12 col-xs-12\">";        
                $Section .= "<div class=\"carousel slide\" id=\"myCarouselPrincipal\">";                
                    $Section .= "<div class=\"carousel-inner\">";
                        $Section .= "<div class=\"item active\">";
                                $Section .= "<ul class=\"thumbnails\">";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>";
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>";    
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>";
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>    ";
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>    ";
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                $Section .= "</ul>";
                          $Section .= "</div><!-- /Slide1 -->      ";
                          $Section .= "<div class=\"item\">";
                                $Section .= "<ul class=\"thumbnails\">";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>             ";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                $Section .= "</ul>";
                          $Section .= "</div><!-- /Slide1 -->   ";
                          $Section .= "<div class=\"item\">";
                                $Section .= "<ul class=\"thumbnails\">";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>             ";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";
                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                    $Section .= "<li class=\"col-md-2\">";
                                        $Section .= "<div class=\"thumbnail\">";
                                            $Section .= "<a href=\"#\"><img src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/aura_spa.jpg\" alt=\"\"></a>";
                                        $Section .= "</div>";
                                        $Section .= "<div class=\"caption\">";
                                            $Section .= "<h4>Usuario 1</h4>   "; 
                                            $Section .= "<p>MSC Alegría. 4 fotos</p>";
                                        $Section .= "</div>";
                                    $Section .= "</li>";

                                $Section .= "</ul>";
                          $Section .= "</div><!-- /Slide1 -->                  ";
                    $Section .= "</div>";               
                    $Section .= "<div class=\"control-box\">";                            
                        $Section .= "<a data-slide=\"prev\" href=\"#myCarouselPrincipal\" class=\"carousel-control left\">‹</a>";
                        $Section .= "<a data-slide=\"next\" href=\"#myCarouselPrincipal\" class=\"carousel-control right\">›</a>";
                    $Section .= "</div><!-- /.control-box -->";
                
                $Section .= "</div><!-- /#myCarousel -->";            
            $Section .= "</div></div></div>";            
            */
        $Section .= "</section>";
        return $Section;
    }   

    function SectionContactpage($objParametros, $objTraductor){
        
        $Section = "";

        $Section = "<section id=\"contact-info\">";
            $Section .= "<div class=\"center\">";                
                $Section .= "<h2>";
                    $Section .= $objTraductor->Traducir("Contactar");            
                $Section .= "</h2>";
                $Section .= "<p class=\"lead\">";
                    $Section .= $objTraductor->Traducir("ContactarTexto");            
                $Section .= "</p>";
            $Section .= "</div>";
            /*
            $Section .= "<div class=\"gmap-area\">";
                $Section .= "<div class=\"container\">";
                    $Section .= "<div class=\"row\">";
                        $Section .= "<div class=\"col-sm-5 text-center\">";
                            $Section .= "<div class=\"gmap\">";
                                $Section .= "<iframe frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d51166.21513722868!2d-4.543167690588381!3d36.72524029570964!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f7958f414311%3A0x54c723841b07335a!2sCalle+Sta.+Mar%C3%ADa%2C+2%2C+29015+M%C3%A1laga!5e0!3m2!1ses!2ses!4v1442859023463\"></iframe>";
                            $Section .= "</div>";
                        $Section .= "</div>";
                        $Section .= "<div class=\"col-sm-7 map-content\">";
                            $Section .= "<ul class=\"row\">";
                                $Section .= "<li class=\"col-sm-12\">";
                                    $Section .= "<address>";
                                        $Section .= $objTraductor->Traducir("ContactarDireccion");                                
                                    $Section .= "</address>";
                                $Section .= "</li>";                                
                            $Section .= "</ul>";
                        $Section .= "</div>";
                    $Section .= "</div>";
                $Section .= "</div>";
            $Section .= "</div>";
            */
            $Section .= "<div class=\"container\">";
                
              $objFormulario = new phpFormulario();
              $objElementoFormulario = new phpElementoformulario();

              $objFormulario->Id = "main-contact-form";
              $objFormulario->Nombre = "contact-form";
              $objFormulario->Metodo = "post";
              $objFormulario->Accion = $objParametros->Directorio . "/control.php?Accion=contact-form";
              $objFormulario->Titulo = $objTraductor->Traducir("DejanosMensaje");
              $objFormulario->Subtitulo = $objTraductor->Traducir("Responderemos");
              $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
              $objFormulario->TextoSubmit= $objTraductor->Traducir("EnviarMensaje");

              //$objFormulario->EnvioAjax = false;
              $Section .= $objFormulario->AbreDibujo();
              
              //formularioContacto.Text = $objFormulario->DevuelveCadena();

              $Section .= "<div class=\"col-sm-5 col-sm-offset-1\">";

              $objElementoFormulario->Id = "name";
              $objElementoFormulario->Nombre = $objTraductor->Traducir("Nombre");
              $objElementoFormulario->Valor = "";
              $objElementoFormulario->Requerido = true;
              $Section .= $objElementoFormulario->AbreDibujo();

              $objElementoFormulario->Reinicia();
              $objElementoFormulario->Id = "email";
              $objElementoFormulario->Nombre = "Email";
              $objElementoFormulario->Valor = "";
              $objElementoFormulario->Requerido = true;
              $objElementoFormulario->setTipo(vbTipoEmail);
              $Section .= $objElementoFormulario->AbreDibujo();

              $objElementoFormulario->Reinicia();
              $objElementoFormulario->Id = "telefono";
              $objElementoFormulario->Nombre = $objTraductor->Traducir("Telefono");
              $objElementoFormulario->Valor = "";
              $objElementoFormulario->setTipo(vbTipoNumber);
              $Section .= $objElementoFormulario->AbreDibujo();

              //$objElementoFormulario->Reinicia();
              //$objElementoFormulario->Id = "empresa";
              //$objElementoFormulario->Nombre = $objTraductor->Traducir("Empresa");
              //$objElementoFormulario->Valor = "";
              //$Section .= $objElementoFormulario->AbreDibujo();

              $Section .= "</div>";

              $Section .= "<div class=\"col-sm-5\">";

              $objElementoFormulario->Reinicia();
              $objElementoFormulario->Id = "subject";
              $objElementoFormulario->Nombre = $objTraductor->Traducir("Asunto");
              $objElementoFormulario->Valor = "";
              $objElementoFormulario->Requerido = true;
              $Section .= $objElementoFormulario->AbreDibujo();

              $objElementoFormulario->Reinicia();
              $objElementoFormulario->Id = "message";
              $objElementoFormulario->Nombre = $objTraductor->Traducir("Mensaje");
              $objElementoFormulario->Valor = "";
              $objElementoFormulario->Requerido = true;
              $objElementoFormulario->setTipo(vbTipoTextArea);
              $Section .= $objElementoFormulario->AbreDibujo();

              $Section .="</div>";

              $Section .= $objFormulario->CierraDibujo($objTraductor);

            $Section .= "</div><!--/.container-->";
         $Section .= "</section>  <!--/gmap_area -->";
       
        return $Section;       
    }

    function SectionBlog($objBuque, $strForm, $strTag, $strTags, $strVideos, $strImagenes, $Nav, $objParametros, $objTraductor, $objUsuario)
    {
        $Section = "";
        $Section .= "<section id=\"blog\" class=\"container\">";
            /*
            $Section .= "<div class=\"center\">";
                $Section .= "<h2>";
                $Section .= $objBuque->Nombre;
                $Section .= "</h2>";      
            $Section .= "</div>";
            */
            $Section .= "<div id=\"cabeceraFichaBuque\" class=\"row\">";
                $Section .= "<div class=\"col-md-6 col-xs-12\">";
                    $Section .= "<h2>" . $objBuque->Nombre . "</h2>";
                $Section .= "</div>";
                $Section .= "<div class=\"col-md-3 col-xs-12\">";
                    $Section .= "<img src=\"" . $objParametros->Directorio . "/subidas/empresas/" . $objBuque->Empresa()->Logo .  "\" alt=\"" . $objBuque->Empresa()->Nombre . "\">"; 
                $Section .= "</div>";
                $Section .= "<div class=\"col-md-3 col-xs-12\">";
                    $Section .= "<p>" . $objBuque->Empresa()->Descripcion . "</p>";
                $Section .= "</div>";
            $Section .= "</div>";

            $Section .= "<div class=\"blog\">";
                $Section .= "<div class=\"row\">";
                    
                    $Section .= $objBuque->DibujaFicha($Nav,$objTraductor, $objUsuario);

                    $Section .= "<aside class=\"col-md-4\">";
                        if (!is_null($strForm) && ($strForm!=""))
                        {
                            $Section .= "<div class=\"widget search\">";
                                $Section .= $strForm;                            
                            $Section .= "</div><!--/.search-->";
                        }
                        $Section .= "<!--Imagenes-->";
                        $Section .= $strImagenes;   

                        $objParticipacion = new phpParticipacion;
                        $objParticipacion->ConsultaBuque(0, $objBuque->getCodigo()); 
                          
                        $Section .= " <div class=\"widget tags cajaLogoEmpresa\">";
                            $Section .= "<div class=\"entry-meta\">";
                                $Section .= "<span id=\"publish_date\">Puntuación Global</span>";
                                $Section .= "<div class=\"\">";
                                    $Section .= $objParticipacion->DibujaPuntuacion(false);
                                $Section .= "</div>";    
                             $Section .= "</div>";
                        $Section .= "</div>";
                        
                        $Section .= "<!--Videos-->";   
                        $Section .= $strVideos; 

                        $NumeroElementos = $objParticipacion->Datos->NumeroElementos();                        
                        
                        //SectionOpinion
                        if ($Nav!=3){
                            if ($NumeroElementos > 0){
                                $Section .= "<div class=\"widget tags\">";
                                $Section .= "<a class=\"btn btn-primary pull-right\" href=\"" . $objBuque->UrlAmigableOpiniones() . "\">Ver todas</a>";
                                $Section .= "<h3><i class=\"fa fa-2x fa-comments\">&nbsp;</i>";
                                if ($NumeroElementos == 1){
                                    $Section .= $NumeroElementos . " Opini&oacute;n"; 
                                }else{
                                    $Section .= $NumeroElementos . " Opiniones";  
                                }
                                $Section .= "</h3>";

                                    $objParticipacion->ConsultaBuque(5, $objBuque->getCodigo()); 
                                    while (!$objParticipacion->Datos->Eof())
                                    {
                                        $objParticipacion->Lee();  
                                        $Section .= $objParticipacion->DibujaOpinionDerecha();
                                        $objParticipacion->Datos->Siguiente();        
                                        $objParticipacion->ReiniciaObjetos();     
                                    }   
                                    $Section .= "<div class=\"row text-center\"><hr/>";
                                    $Section .= "<a class=\"btn btn-primary\" href=\"" . $objBuque->UrlAmigableOpiniones() . "\">Ver todas</a>";
                                    $Section .= "</div>";
                                $Section .= "</div>";
                                $Section .= "<!--/.tags-->";      
                            }                              
                        }   
                        unset($objParticipacion); 

                    $Section .= "</aside>";     

                $Section .= "</div><!--/.row-->";

                $Section .= "</div><!--/.blog-->";

        $Section .= "</section><!--/#blog-->";

        $Section .= "<div class=\"container\">";
            $Section .= " <div class=\"widget tags\">";
                $Section .= "<h3><i class=\"fa fa-2x fa-anchor\">&nbsp;</i>";
                $Section .= $strTag;  
                $Section .= "</h3>";
                $Section .= "<ul class=\"tag-cloud\">";
                $Section .= $strTags;                      
                $Section .= "</ul>";
            $Section .= "</div>";
            $Section .= "<!--/.tags-->";
        $Section .= "</div><!--/.container-->";

        return $Section; 
    }

    function SectionFeature($strTitulo, $strDescripcion, $strLista)
    {
        $Section = "";
        $Section .= "<section id=\"feature\" class=\"transparent-bg\">";
            
            $Section .= "<div class=\"container\">";
                
                $Section .= "<div class=\"center wow fadeInDown\">";
                    $Section .= "<h2>" . $strTitulo . "</h2>";
                    $Section .= "<p class=\"lead\">" . $strDescripcion . "</p>";
                $Section .= "</div>";

                $Section .= "<div class=\"row\">";
                    $Section .= "<div class=\"features\">";
                        $Section .= $strLista;
                    $Section .= "</div><!--/.features-->";
                $Section .= "</div><!--/.row-->";

                /*
                <!-- about us slider -->
                <div id="services-slider">
                    <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                        
                        <!-- Indicators -->
                        <ol class="carousel-indicators visible-xs">                     
                            <asp:Literal id="PageCarouselImagenes" runat="server"></asp:Literal>  
                        </ol>

                        <div class="carousel-inner">                        
                            <asp:Literal id="PageSliderImagenes" runat="server"></asp:Literal>                  
                        </div>
                        
                        <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
                            <i class="fa fa-angle-left"></i> 
                        </a>
                        
                        <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
                            <i class="fa fa-angle-right"></i> 
                        </a>
                    </div> <!--/#carousel-slider-->
                </div><!--/#about-slider-->
                */ 

                //<asp:Literal id="formularioContacto" runat="server"></asp:Literal>   
                        
            $Section .= "</div><!--/.container-->";

        $Section .= "</section><!--/#feature-->"; 

        return $Section; 
    }

    function SectionService($strTitulo, $strDescripcion, $strImagen, $strLista, $strWeb)
    {
        $Section = "";
        
        if (!is_null($strTitulo) && ($strTitulo!="")){
            $Section .= "<section id=\"servicesTitle\" class=\"service-item\">";
                $Section .= "<div class=\"center wow fadeInDown animated animated\" style=\"visibility: visible; animation-name: fadeInDown;\"\>";
                    $Section .= "<div class=\"row\">";
                        $Section .= "<div class=\"col-sm-6 col-md-4 center\">";
                            if (!is_null($strImagen) && ($strImagen!="")) $Section .= "<img src=\"" . $strImagen . "\">";
                        $Section .= "</div>";
                        $Section .= "<div class=\"col-sm-6 col-md-8\">";
                            $Section .= "<h2>" . $strTitulo . "</h2>";
                            if (($strWeb!=null) && ($strWeb!="")) $Section .= "<a target=\"_blank\" class=\"enlaceNavieraExterno\" href=\"http://" . $strWeb . "\">" . $strWeb . "<i class=\"fa fa-eye\"></i></a>";
                            $Section .= "<p class=\"lead\">" . $strDescripcion . "</p>";
                        $Section .= "</div>";
                    $Section .= "</div>";
                $Section .= "</div>";          
            $Section .= "</section>";
        }
        
        $Section .= "<section id=\"services\" class=\"service-item\">";
            $Section .= "<div class=\"container\">";
                $Section .= "<div class=\"row\">";
                    $Section .= $strLista;
                $Section .= "</div>";
            $Section .= "</div>";
        $Section .= "</section>";  

        return $Section;     
    }


    function SectionPrincipalHome($objParametros, $objTraductor)
    {
        $Section = "";

        $Section .= "<div class=\"container\" id=\"containerPrincipalHome\">";
            $Section .= "<div class=\"row\">";
                
                //IZQUIERDA
                $Section .= "<div class=\"col-sm-9 col-xs-12\">";
                    $Section .= $this->SectionPrincipalHomeComment($objParametros, $objTraductor);
                    $Section .= $this->SectionComment();
                    //$Section .= $this->SectionDestiny();
                $Section .= "</div>";

                //DERECHA
                $Section .= "<div class=\"col-sm-3 col-xs-12\" id=\"columnaDerecha\">";
                    $Section .= $this->SectionPrincipalHomeBanner($objParametros, $objTraductor);
                $Section .= "</div>";

            $Section .= "</div><!--row-->";
        $Section .= "</div><!--container-->";

        return $Section;  
    }

    function SectionPrincipalHomeComment($objParametros, $objTraductor)
    {
        $i=1;
        $objUsuario = new phpUsuario();
        $objUrlAmigable = new phpUrlAmigable();
        $objParticipacion = new phpParticipacion();
        $objParticipacion->Consulta(5);

        $Section = "";
        $Section .= "<section id=\"usuariosOpiniones\">";
            $Section .= "<div class=\"container\">";
                $Section .= "<div class=\"row\">";

                $Section .= "<div class=\"col-xs-12 col-sm-4 wow fadeInDown animated animated animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
                    $Section .= "<div class=\"row\">";
                      $Section .= "<div class=\"col-md-12 cajaAccesoDirectoOpinion\">";
                          $Section .= "<h3>En EXPOCRUCEROS nos interesa su opinión.</h3>";
                          $Section .= "<p>Encuentre los cruceros en los que haya viajado y ayude a otros viajeros a encontrar su próximo destino.</p>";
                          if (!$objUsuario->Conectado()) $Section .= "<a href=\"" . $objUrlAmigable->Amigable("registro.php") . "\" title=\"ÚNETE\" class=\"botonAzul\">ÚNETE</a>";
                          if ($objUsuario->Conectado()) {
                            $Section .= "<a href=\"" . $objParametros->Directorio . "/usuario.php?uS=" . session_id() . "\" title=\"ACCEDA A SU PERFIL\" class=\"\"><i class=\"fa fa-user\"></i>&nbsp;ACCEDA A SU PERFIL</a>";
                          }else{
                            $Section .= "<a href=\"" . $objParametros->Directorio . "/login.php?uS=" . session_id() . "\" title=\"iniciar sesión\" class=\"\">iniciar sesión</a>";
                          }
                      $Section .= "</div>";
                  $Section .= "</div>";
                $Section .= "</div>";

                $Section .= "<div class=\"col-xs-12 col-sm-7 col-sm-offset-1 wow fadeInDown animated animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
                $Section .= "<div class=\"testimonial\">";
                $Section .= "<h2><i class=\"fa fa-2x fa-comments\"></i>&nbsp;Las últimas opiniones de nuestros usuarios</h2>";
                
                if ($objParticipacion->Datos->NumeroElementos() > 0){
                    while (!$objParticipacion->Datos->Eof())
                    {
                        $objParticipacion->Lee();  
                        $Section .= $objParticipacion->DibujaOpinionHome();
                        $objParticipacion->Datos->Siguiente();        
                        $objParticipacion->ReiniciaObjetos();     
                    }
                }
                $Section .= "</div><!--col-xs-12-->";
                
                $Section .= "</div><!--row-->";
            $Section .= "</div><!--container-->";
        $Section .= "</section>";  

        unset($objUsuario);
        unset($objUrlAmigable);
        unset($objParticipacion);

        return $Section; 
    }

    function SectionPrincipalHomeBanner($objParametros, $objTraductor)
    {
        $Section = "";

        $Section .= "<ul class=\"banners\">";
            $Section .= "<li><a href=\"\" title=\"\"><img src=\"" . $objParametros->Directorio . "/images/banner1.jpg\" alt=\"\"/></a></li>";
            $Section .= "<li> <a href=\"\" title=\"\"><img src=\"" . $objParametros->Directorio . "/images/banner2.jpg\" alt=\"\"/></a></li>";
            $Section .= "<li> <a href=\"\" title=\"\"><img src=\"" . $objParametros->Directorio . "/images/bannerFacebook.png\" alt=\"\"/></a></li>";
            $Section .= "<li> <a href=\"\" title=\"\"><img src=\"" . $objParametros->Directorio . "/images/bannerTwitter.png\" alt=\"\"/></a></li>";
        $Section .= "</ul>";
                
        return $Section; 
    }
    
    function SectionPartner()
    {
        $Section = "";

        $Section .= "<section id=\"partner\">"; 
            $Section .= "<div class=\"container\">"; 
                $Section .= "<div class=\"center wow fadeInDown animated\" style=\"visibility: visible; animation-name: fadeInDown;\">"; 
                    $Section .= "<i class=\"fa fa-calendar\"></i>"; 
                    $Section .= "<h2>Tu próxima escala</h2>"; 
                    $Section .= "<p class=\"lead\">El próximo día 25 de Noviembre tienes una cita en el Muelle1.<br> Acompañanos a la mayor exposición de cruceros de la costa del sol. <br> Disfruta de las ofertas de las mejores empresas de cruceros del mundo.</p>"; 
                $Section .= "</div>    "; 
                $Section .= "<div class=\"partners\">"; 
                    $Section .= "<ul>"; 
                        $Section .= "<li> <a href=\"#\"><img class=\"img-responsive wow fadeInDown animated\" data-wow-duration=\"1000ms\" data-ow-delay=\"300ms\" src=\"images/logo_icono_blanco.png\" style=\"visibility: visible; animation-duration: 1000ms; animation-name: fadeInDown;\"></a></li>                    "; 
                    $Section .= "</ul>"; 
                $Section .= "</div>"; 
            $Section .= "</div><!--/.container-->"; 
        $Section .= "</section>"; 

        return $Section;     
    }

    function SectionDestiny()
    {
        $Section = "";

            $Section .= "<section id=\"partner\">";
            $Section .= "<div class=\"container\">";
            $Section .= "<div class=\"wow fadeInDown animated animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
            $Section .= "<div class=\"row\">";
            $Section .= "<div class=\"col-md-3 col-xs-12\">";
            $Section .= "<a title=\"\" href=\"\">";
            $Section .= "<img class=\"img-responsive\" alt=\"\" src=\"http://s590808717.mialojamiento.es/expocruceros/subidas/buques/26/imagenes/parque.jpg\">";
            $Section .= "</a>";
            $Section .= "</div>";
            $Section .= "<div class=\"col-md-9 col-xs-12\">";
            $Section .= "<h2>Destino Sugerido</h2>";
            $Section .= "<h3>";
            $Section .= "<a title=\"\" href=\"\">Norweigan Epic</a>";
            $Section .= ".";
            $Section .= "<span>Norgewian Cruise Line</span>";
            $Section .= "</h3>";
            $Section .= "<p class=\"lead\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ut odio porttitor, tincidunt tortor non, lacinia magna. Nullam viverra consectetur tortor quis varius. Vivamus lacus sem, mattis vel nulla at, auctor malesuada augue. Suspendisse dapibus libero luctus magna venenatis, feugiat condimentum magna dictum. Suspendisse mollis id enim in ullamcorper. Sed dolor nisl, cursus sed urna vitae, varius egestas dolor. Cras massa neque, elementum hendrerit felis et, accumsan tincidunt nisi. Proin varius, augue ut finibus mattis, mauris justo semper diam, id convallis ligula nibh et leo. Praesent interdum quam vitae ultrices cursus. </p>";
            $Section .= "<i>Basado en la opinión de 135 usuarios</i>";
            $Section .= "</div>";
            $Section .= "</div>";
            $Section .= "</div>";
            $Section .= "</section>";

        return $Section;     
    
    }

    function SectionComment()
    {
        $Section = "";
        $Section .= "<section id=\"content\">";
            $Section .= "<div class=\"container\">";
                $Section .= "<div class=\"row\">";
                    $Section .= "<div class=\"col-xs-12 col-sm-12 wow fadeInDown animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
                       
                    $Section .= "<h2 class=\"\">";
                    $Section .= "<i class=\"fa fa-2x fa-anchor\"></i>&nbsp;TOP 5";
                    $Section .= "<span> Los cruceros mejor valorados por nuestros usuarios</span>";
                    $Section .= "</h2>";

                        $objBuque = new phpBuque();
                        $objBuque->ConsultaValorados(5);

                        $Section .= "<div class=\"tab-wrap\">";
                            $Section .= "<div class=\"media\">";
                                
                                $Section .= "<div class=\"parrent pull-left\">";
                                    $Section .= "<ul class=\"nav nav-tabs nav-stacked\">";
                                        if ($objBuque->Datos->NumeroElementos() > 0)
                                        {
                                            $i=1;
                                            while (!$objBuque->Datos->Eof())
                                            {
                                                $objBuque->Lee();
                                                $strClase = "";
                                                if ($i==1) $strClase = "active";
                                                $Section .= "<li class=\"". $strClase . "\"><a href=\"#tab" . $i . "\" data-toggle=\"tab\" class=\"analistic-0" . $i . "\">" . $i . ". " . $objBuque->Nombre . "</a></li>";
                                                $objBuque->ReiniciaObjetos();
                                                $objBuque->Datos->Siguiente();
                                                $i++;
                                            }
                                        }
                                    $Section .= "</ul>";
                                $Section .= "</div>";

                                $Section .= "<div class=\"parrent media-body\">";
                                    $Section .= "<div class=\"tab-content\">";
                                        
                                        if ($objBuque->Datos->NumeroElementos() > 0)
                                        {
                                            $objBuque->Datos->Primero();
                                            $i=1;
                                            while (!$objBuque->Datos->Eof())
                                            {
                                                $objBuque->Lee();
                                                $objParticipacion = new phpParticipacion;
                                                $objParticipacion->ConsultaBuque(0, $objBuque->getCodigo()); 
                                                
                                                $strClase = "";
                                                if ($i==1) $strClase = " active in";    
                                                $Section .= "<div class=\"tab-pane fade". $strClase . "\" id=\"tab" . $i . "\">";
                                                    $Section .= "<div class=\"media\">";
                                                       
                                                        $Section .= "<div class=\"pull-left\">";
                                                           $Section .= $objParticipacion->DibujaPuntuacion(false);
                                                        $Section .= "</div>";
                                                       
                                                        $Section .= "<div class=\"media-body\">";
                                                             $Section .= "<h2><a alt=\"" . $objBuque->Nombre . "\" href=\"" . $objBuque->UrlAmigable() . "\">" . $objBuque->Nombre . "</a></h2>";
                                                             $Section .= "<p>" . $objBuque->DescripcionCortaRecortada . "</p>";
                                                             $Section .= $objBuque->DibujaBotonOpinar();
                                                        $Section .= "</div>";

                                                    $Section .= "</div>";
                                                $Section .= "</div>";

                                                $objBuque->ReiniciaObjetos();
                                                $objBuque->Datos->Siguiente();
                                                $i++;
                                                unset($objParticipacion); 
                                            }
                                        }
                                        
                                    $Section .= "</div> <!--/.tab-content-->"; 
                                $Section .= "</div> <!--/.media-body-->";
                            $Section .= "</div> <!--/.media-->";
                        $Section .= "</div><!--/.tab-wrap-->";
                    $Section .= "</div><!--/.col-sm-6-->";

                $Section .= "</div><!--/.row-->";
            $Section .= "</div><!--/.container-->";
        $Section .= "</section>";

           

        return $Section;     
    }

    function SectionRegister($objParametros, $objTraductor)
    {
        $objCookie = new phpCookie();
        $objCookie->Nombre = vbCookieUser;

        //if ($objCookie->Existe()) Response.Redirect("usuario.php");   

        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();

        $objFormulario->Id = "register-form";
        $objFormulario->Nombre = "register-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=inserta";
        $objFormulario->Titulo = $objTraductor->Traducir("Registro"); 
        $objFormulario->Subtitulo = $objTraductor->Traducir("Registrarse");
        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit = $objTraductor->Traducir("CrearCuenta");

        $Section = "<div class=\"container\">";
        $Section .= $objFormulario->AbreDibujo();

        //formularioContacto.Text = $objFormulario->DevuelveCadena();
        $Section .= "<div class=\"col-sm-10 col-sm-offset-1\">";
            
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "email";
        $objElementoFormulario->Nombre = "Email";
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoEmail);
        $objElementoFormulario->Longitud = 100;
        $Section .= $objElementoFormulario->AbreDibujo();

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "password";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Clave");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoClave);
        $objElementoFormulario->Longitud = 20;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "passwordRepeat";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("RepetirClave");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoClave);
        $objElementoFormulario->Longitud = 20;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<hr/>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-3\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "nameavatar";
        $objElementoFormulario->Nombre = "Nombre con el que apareces";
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->Longitud = 50;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-9\">";
        
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "name";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Nombre");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();        
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "country";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Pais");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Longitud = 255;
        $objElementoFormulario->Requerido = true;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "city";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Localidad");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "poblation";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Poblacion");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-9\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "direction";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Direccion");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-3\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "postal";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("CodigoPostal");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 5;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "telephone";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Telefono");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 12;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "fax";
        $objElementoFormulario->Nombre = "Fax";
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 12;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";
        
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "message";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Comentario");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoTextArea);
        $Section .= $objElementoFormulario->AbreDibujo();

        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "legal";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("AutorizaEnvioInformacion");
        $objElementoFormulario->Valor = $objTraductor->Traducir("Si");
        $objElementoFormulario->Atributo = "checked=\"true\"";
        $objElementoFormulario->setTipo(vbTipoChequeo);
        $Section .= $objElementoFormulario->AbreDibujo();

        $Section .= "</div>";

        $Section .= $objFormulario->CierraDibujo($objTraductor);
        $Section .= "</div>";

        return $Section;     
    }

    function SectionRecuperar($objParametros, $objTraductor)
    {
        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();

        $objFormulario->Id = "recordar-form";
        $objFormulario->Nombre = "recordar-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=recupera";
        $objFormulario->Titulo = $objTraductor->Traducir("RecuperarClave");
        $objFormulario->Subtitulo = $objTraductor->Traducir("RecuperarClaveTexto");
        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit = $objTraductor->Traducir("RecuperarClave");
        $objFormulario->EnvioAjax = false;
        $objFormulario->PoliticaPrivacidad = false;

        $Section = "<div class=\"container\">";
        $Section .= $objFormulario->AbreDibujo();

        $Section .= "<div class=\"col-sm-10 col-sm-offset-1\">";
            
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_email";
        $objElementoFormulario->Nombre = "Email";
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoEmail);
        $Section .= $objElementoFormulario->AbreDibujo();

        $Section .= "</div>";

        $Section .= $objFormulario->CierraDibujo($objTraductor);
        
        $Section .= "</div>";

        return $Section;         
    }

    function SectionLogin($objParametros, $objTraductor, $objUrlAmigable)
    {
        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();

        $usu_email = "";
        $usu_clave = "";
        if (isset($_SESSION['usu_email'])) $usu_email = $_SESSION["usu_email"];
        if (isset($_SESSION['usu_clave'])) $usu_clave = $_SESSION["usu_clave"];
        
        $objFormulario->Id = "login-form";
        $objFormulario->Nombre = "login-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=valida";
        $objFormulario->Titulo = $objTraductor->Traducir("IniciarSesion"); 
        $objFormulario->Subtitulo = $objTraductor->Traducir("IntentandoAcceder") ."<p>" . $objTraductor->Traducir("SiNoEsUsuarioRegistrese") . "</p>";

        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit = $objTraductor->Traducir("Entrar");
        $objFormulario->EnvioAjax = false;
        $objFormulario->PoliticaPrivacidad = false;
        $objFormulario->ColForm = 4;
        $objFormulario->ColFormOffset = 4;
        
        $Section = "<div class=\"container\">";
        $Section .= $objFormulario->AbreDibujo();

        $Section .= "<div class=\"col-sm-10 col-sm-offset-1\">";
            
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_email";
        $objElementoFormulario->Nombre = "Email";
        $objElementoFormulario->Valor = $usu_email;
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoEmail);
        $Section .= $objElementoFormulario->AbreDibujo();

        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_clave";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Clave"); 
        $objElementoFormulario->Valor = $usu_clave;
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoClave);
        $Section .= $objElementoFormulario->AbreDibujo();

        $Section .= "<a href=\"" . $objUrlAmigable->Amigable("recuperar.php") . "\" title=\"" . $objTraductor->Traducir("RecupereClave") . "\">" . $objTraductor->Traducir("OlvidoClave") . "</a>";

        $Section .= "</div>";
 
        $Section .= $objFormulario->CierraDibujo($objTraductor);
        $Section .= "</div>";

        return $Section;  
    }

    function SectionRelogin($objParametros, $objTraductor)
    {
        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();

        $usu_relogin_us = "";
        if (isset($_GET['relogin-us'])){ 
            $usu_relogin_us = $_GET['relogin-us'];  
        }else{
            exit();
        }
        $objFormulario->Id = "relogin-form";
        $objFormulario->Nombre = "relogin-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=modificaPassword";
        $objFormulario->Titulo = $objTraductor->Traducir("CambieClave"); 
        $objFormulario->Subtitulo = $objTraductor->Traducir("CambieClaveTexto");
        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit = $objTraductor->Traducir("GuardarCambios");
        $objFormulario->EnvioAjax = false;
        $objFormulario->PoliticaPrivacidad = false;
        $objFormulario->ColForm = 4;
        $objFormulario->ColFormOffset = 4;
        
        $Section = "<div class=\"container\">";
        $Section .= $objFormulario->AbreDibujo();

        $Section .= "<div class=\"col-sm-10 col-sm-offset-1\">";
            
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_clave";
        $objElementoFormulario->Nombre = "Contraseña";
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoClave);
        $Section .= $objElementoFormulario->AbreDibujo();

        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_relogin_us";
        $objElementoFormulario->Nombre = "Relogin-uS";
        $objElementoFormulario->Valor = $usu_relogin_us;
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Visible = false;
        $Section .= $objElementoFormulario->AbreDibujo();

        $Section .= "</div>";

        $Section .= $objFormulario->CierraDibujo($objTraductor);
        $Section .= "</div>";

        return $Section;  
    }

    function SectionUser($objParametros, $objTraductor)
    {
        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();
        
        $objUsuario = new phpUsuario();
        $objCookie = new phpCookie();
        $objCookie->Nombre = vbCookieUser;

        if (!$objUsuario->Conectado()) exit();
        $objUsuario->setCodigo($objCookie->Lee());

        $objFormulario->Id = "user-form";
        $objFormulario->Nombre = "user-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=modifica";
        $objFormulario->Titulo = $objUsuario->Email;
        $objFormulario->Subtitulo = "";
        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit = $objTraductor->Traducir("GuardarCambios");
        $objFormulario->EnvioAjax = false;
        $objFormulario->PoliticaPrivacidad = false;
        $objFormulario->Archivos = true;
        
        $Section = "<div class=\"container\">";
        $Section .= $objFormulario->AbreDibujo();


        $Section .= "<div class=\"col-sm-10 col-sm-offset-1\">";
        
        $Section .= "<div class=\"row\">";
        $Section .= "<div class=\"text-center\">";
        $Section .= "<input style=\"display:none;\" id=\"file-upload\" name=\"uploadedfile\" type=\"file\" accept=\"image/*\" />";
        if (($objUsuario->Avatar!=null)&&($objUsuario->Avatar!="")) {
            $Section .= "<img id=\"blah\" class=\"img-circle\" src=\"". $objParametros->Directorio . "/subidas/usuarios/" . $objUsuario->Avatar . "\" alt=\"" . $objUsuario->Nombre . "\">";
        }else{
            $Section .= "<img id=\"blah\" class=\"img-circle\" src=\"". $objParametros->Directorio . "/images/testimonials1.png\" alt=\"" . $objUsuario->Nombre . "\">";
        }
        $Section .= "</div>";
        $Section .= "</div>";

        $Section .= "<hr/>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-3\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_avatar_nombre";
        $objElementoFormulario->Nombre = "Nombre con el que apareces";
        $objElementoFormulario->Valor = $objUsuario->AvatarNombre;
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 50;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-9\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_nombre";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Nombre");
        $objElementoFormulario->Valor = $objUsuario->Nombre;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_clave";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Clave");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoClave);
        $objElementoFormulario->Longitud = 20;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_clave_repetir";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("RepetirClave");
        $objElementoFormulario->Valor = "";
        $objElementoFormulario->setTipo(vbTipoClave);
        $objElementoFormulario->Longitud = 20;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<hr/>";

        $Section .= "<div class=\"row\">";
        
        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_pais";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Pais");
        $objElementoFormulario->Valor = $objUsuario->Pais;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 255;
        $objElementoFormulario->Requerido = true;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_localidad";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Localidad");
        $objElementoFormulario->Valor = $objUsuario->Localidad;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-4\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_poblacion";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Poblacion");
        $objElementoFormulario->Valor = $objUsuario->Poblacion;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "</div>";

        $Section .= "<div class=\"row\">";

        $Section .= "<div class=\"col-md-10\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_direccion";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Direccion");
        $objElementoFormulario->Valor = $objUsuario->Direccion;
        $objElementoFormulario->setTipo(vbTipoTexto);
        $objElementoFormulario->Longitud = 255;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";

        $Section .= "<div class=\"col-md-2\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_codigo_postal";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("CodigoPostal");
        $objElementoFormulario->Valor = $objUsuario->CodigoPostal;
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 5;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";
        
        $Section .= "</div>";

        $Section .= "<div class=\"row\">";
        
        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_telefono";
        $objElementoFormulario->Nombre = $objTraductor->Traducir("Telefono");
        $objElementoFormulario->Valor = $objUsuario->Telefono;
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 12;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";
        
        $Section .= "<div class=\"col-md-6\">";
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "usu_fax";
        $objElementoFormulario->Nombre = "Fax";
        $objElementoFormulario->Valor = $objUsuario->Fax;
        $objElementoFormulario->setTipo(vbTipoNumber);
        $objElementoFormulario->Longitud = 12;
        $Section .= $objElementoFormulario->AbreDibujo();
        $Section .= "</div>";
        
        $Section .= "</div>";

        $Section .= "<a data-target=\"#ModalElimina\" data-toggle=\"modal\" title=\"" . $objTraductor->Traducir("EliminarCuenta") . "\">" . $objTraductor->Traducir("EliminarCuenta") . "</a>";

        $Section .= "</div>";

        $Section .= $objFormulario->CierraDibujo($objTraductor);
        $Section .= "</div>";

        unset($objUsuario);
        unset($objCookie);

        return $Section;  
    }

    function SectionOpinion($objTraductor, $objParametros, $intBuque, $objUsuario){

        $objFormulario = new phpFormulario();
        $objElementoFormulario = new phpElementoformulario();

        $objPregunta = new phpPregunta();

        $objFormulario->Id = "opinion-comment-form";
        $objFormulario->Nombre = "comment-form";
        $objFormulario->Metodo = "post";
        $objFormulario->Accion = $objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=comment-form";        
        $objFormulario->Titulo = "Dejenos su opinión";
        $objFormulario->Subtitulo = "Queremos conocer que opinión tiene sobre este buque";
        $objFormulario->TextoEnvio = $objTraductor->Traducir("EnviandoMensaje");
        $objFormulario->TextoSubmit= $objTraductor->Traducir("EnviarMensaje");
        $objFormulario->PoliticaPrivacidad = false;
        $objFormulario->ColForm = 8;
        $objFormulario->ColFormOffset = 2;
        $objFormulario->Recaptcha = false;
        $objFormulario->Archivos = true;

        $Section = "<div class=\"row\">";
        
       if ($objUsuario->Conectado()){
            $Section .= $objFormulario->AbreDibujo();
            $Section .= "<div class=\"row\">";
            $objPregunta->Consulta();
            if ($objPregunta->Datos->NumeroElementos() > 0)
              {
                  while (!$objPregunta->Datos->Eof())
                  {
                      $objPregunta->Lee();

                      $Section .= "<div class=\"col-md-12\">";  
                      $Section .= "<div class=\"col-md-4 col-xs-12\">";  
                      $Section .= "<div id=\"pregunta_" . $objPregunta->getCodigo() . "\" class=\"raty\"></div>"; 
                      $Section .= "</div>";
                      //$Section .= "<script>$('#pregunta_" . $objPregunta->getCodigo() . " .raty').raty({ scoreName: '" . $objPregunta->getCodigo() . "' });</script>";
                      $Section .= "<div class=\"col-md-8 col-xs-12\" style=\"float:left;\">";  
                      $Section .= $objPregunta->Nombre;
                      $Section .= "</div>";
                      $Section .= "</div>";
                      $objPregunta->ReiniciaObjetos();
                      $objPregunta->Datos->Siguiente();
                  }
              }
            $Section .= "</div>";
            
            $Section .= "<hr/>";
            
            $Section .= "<div class=\"row\">";
            $Section .= "<div class=\"text-center\">";
            $Section .= "<div class=\"form-group\"><label>Suba fotos (pulse en los iconos con cámara)</label></div>";        
            $Section .= "<input style=\"display:none;\" id=\"file-upload\" name=\"uploadedfile\" type=\"file\" accept=\"image/*\" />";
            $Section .= "<input style=\"display:none;\" id=\"file-upload2\" name=\"uploadedfile2\" type=\"file\" accept=\"image/*\" />";
            $Section .= "<input style=\"display:none;\" id=\"file-upload3\" name=\"uploadedfile3\" type=\"file\" accept=\"image/*\" />";
            $Section .= "<img id=\"blah\" class=\"preview fotoOpinion\" style=\"max-width:100%;\" src=\"". $objParametros->Directorio . "/image/picture.png\" alt=\"Sube una foto\">";
            $Section .= "<img id=\"blah2\" class=\"preview fotoOpinion\" style=\"max-width:100%;\" src=\"". $objParametros->Directorio . "/image/picture.png\" alt=\"Sube una foto\">";
            $Section .= "<img id=\"blah3\" class=\"preview fotoOpinion\" style=\"max-width:100%;\" src=\"". $objParametros->Directorio . "/image/picture.png\" alt=\"Sube una foto\">";
            $Section .= "</div>";
            $Section .= "</div>";

            $Section .= "<hr/>";

            $Section .= "<div class=\"row\">";
            $Section .= "<div class=\"col-md-12\">";
            $objElementoFormulario->Reinicia();
            $objElementoFormulario->Id = "message";
            $objElementoFormulario->Nombre = $objTraductor->Traducir("Mensaje");
            $objElementoFormulario->Valor = "";
            $objElementoFormulario->Requerido = true;
            $objElementoFormulario->setTipo(vbTipoTextArea);
            $objElementoFormulario->Longitud = 350;
            $Section .= $objElementoFormulario->AbreDibujo();
            $Section .= "</div>";
            $Section .= "</div>";

            $objElementoFormulario->Reinicia();
            $objElementoFormulario->Id = "buque";
            $objElementoFormulario->Nombre = "Buque";
            $objElementoFormulario->Valor = $intBuque;
            $objElementoFormulario->Requerido = true;
            $objElementoFormulario->setTipo(vbTipoNumber);
            $objElementoFormulario->Visible = false;
            $Section .= $objElementoFormulario->AbreDibujo();
       
            $Section .= $objFormulario->CierraDibujo($objTraductor);
        }else{
            
            $Section .= "<div class=\"row\">";
            $Section .= "<div class=\"col-md-12 text-center\">";
            $Section .= "<p class=\"registreseOpinion\">Queremos conocer que opinión tienes sobre este buque </p>";
            $Section .= "<p><a href=\"" . $objParametros->Directorio . "/login.php\" class=\"botonNaranja\" title=\"\">registrese o inicie sesión en el sistema.</a></p>";
            $Section .= "</div>";
            $Section .= "</div>";
            
        }    
        $Section .= "</div>";

        unset($objFormulario);
        unset($objElementoFormulario);
        unset($objPregunta);

        return $Section;     
    }

    function SectionOpinar($objParametros, $objTraductor, $objUrlAmigable)
    {
        $Section = "";

        $objEmpresa = new phpEmpresa();
        
        $Section .= "<!--/#opinar-search-->";
        $Section .= "<div class=\"center fadeInDown animated capaBuscadorBarcos\" style=\"visibility: visible; animation-name: fadeInDown;\">";
        $Section .= "<div class=\"container\">";
        $Section .= "<div class=\"row\">";
        $Section .= "<div class=\"col-md-12\">";
        $Section .= "<div id=\"capaBuscadorBarcos\">";
               
            $Section .= "<div class=\"row\"><div class=\"col-xs-12 col-md-12\"><h1>Encuentre su crucero y opine</h1></div></div>";
            $Section .= "<div class=\"row\">";
                $Section .= "<div class=\"col-xs-12 col-md-8 col-md-offset-2\">";
                    $Section .= "<div class=\"row\">";
                        $Section .= "<form id=\"form-main-search\" name=\"main-search\" method=\"post\" action=\"" . $objEmpresa->UrlAmigableBuscador() . "\">";
                            $Section .= "<div class=\"col-xs-12 col-md-8\">";
                                $Section .= "<input class=\"form-control\" placeholder=\"Busque su crucero\" name=\"formText\" type=\"text\">";
                            $Section .= "</div>";
                            $Section .= "<div class=\"col-xs-12 col-md-4 text-center\">";
                                $Section .= "<button class=\"buttonNaranja btn btn-default\" type=\"submmit\">Encontrar cruceros</button>";
                            $Section .= "</div>";
                        $Section .= "</form>";
                    $Section .= "</div>";
                $Section .= "</div>";
            $Section .= "</div>";   

        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        unset($objEmpresa);

        $Section .= "<div class=\"container paginaOpiniones\">";
        $Section .= "<div class=\"row\">";
            
            $Section .= "<!--left-->";
            $Section .= "<div class=\"col-md-4\">";
            $objParticipacion = new phpParticipacion();
            $objParticipacion->Consulta(5);
            $Section .= "<h1><i class=\"fa fa-2x fa-comments\"></i>&nbsp;Las últimas opiniones de nuestros usuarios</h1>";
                        
            if ($objParticipacion->Datos->NumeroElementos() > 0){
                while (!$objParticipacion->Datos->Eof())
                {
                    $objParticipacion->Lee();  
                    $Section .= $objParticipacion->DibujaOpinionHome();
                    $objParticipacion->Datos->Siguiente();        
                    $objParticipacion->ReiniciaObjetos();     
                }
            }
            unset($objParticipacion);

            $objUsuarios = new phpUsuario();
            $objUsuarios->ConsultaParticipacion(12);
            
            $Section .= "<h1>Conozca a todos nuestros usuarios y sus opiniones</h1>";
            $Section .= "<div class=\"row\">";
            if ($objUsuarios->Datos->NumeroElementos() > 0){
                while (!$objUsuarios->Datos->Eof())
                {
                    $objUsuarios->Lee();  
                    $Section .= "<div class=\"col-md-3 col-xs-6 iconoUsuarioListado\">";
                        $Section .= "<a title=\"" . $objUsuarios->AvatarNombre . "\" href=\"" . $objUrlAmigable->Amigable("opiniones.php?cod=12&id=" . $objUsuarios->getCodigo() . "&nom=Opinar") . "\">";
                            if (($objUsuarios->Avatar!=null)&&($objUsuarios->Avatar!="")) {
                                $Section .= "<img class=\"img-responsive img-circle\" width=\"75px\" data-pin-nopin=\"true\" src=\" " . $objParametros->UrlSubidas . "/usuarios/" . $objUsuarios->Avatar . "\" alt=\"eddy\">";
                            }else{
                                $Section .= "<img class=\"img-circle\" alt=\"" . $objUsuarios->AvatarNombre . "\" src=\"". $objParametros->Directorio . "/images/testimonials1.png\">";
                            }
                        $Section .= "</a>";
                    $Section .= "</div>";
                    $objUsuarios->Datos->Siguiente();        
                    $objUsuarios->ReiniciaObjetos();     
                }
            }
            unset($objUsuarios);
                
            $Section .= "</div>";
                
            $Section .= "</div>";

            $Section .= "<!--center-->";
            $Section .= "<div class=\"col-md-4\">";
            $Section .= "<h1><i class=\"fa fa-2x fa-anchor\"></i>&nbsp;Los barcos mejor valorados</h1>";
            $objBuque = new phpBuque();
            $objBuque->ConsultaValorados(5);
            if ($objBuque->Datos->NumeroElementos() > 0)
            {
                $objBuque->Datos->Primero();
                $i=1;
                while (!$objBuque->Datos->Eof())
                {
                    $objBuque->Lee();
                    $objParticipacion = new phpParticipacion;
                    $objParticipacion->ConsultaBuque(0, $objBuque->getCodigo()); 
                    
                    $Section .= "<div style=\"visibility: visible; animation-name: fadeInDown;\" class=\"media services-wrap wow fadeInDown animated animated barcosValorados animated\">";
                        $Section .= "<div><a title=\"" . $objBuque->Nombre . "\" href=\"" . $objBuque->UrlAmigable() . "\">";
                        
                        if ($objBuque->Slider()->Datos->NumeroElementos() > 0)
                        {
                            $objBuque->Slider()->Lee();
                            $Section .= "<img width=\"100%\" src=\"" . $objParametros->Directorio . "/subidas/buques/" . $objBuque->getCodigo() . "/slider/". $objBuque->Slider()->Nombre ."\" class=\"img-responsive\">";
                        }
                        $Section .= "</a></div>";
                        $Section .= "<div class=\"media-body\">";
                            $Section .= "<div class=\"row\">";
                                $Section .= "<div class=\"col-md-4\">";
                                    $Section .= $objParticipacion->DibujaPuntuacion(true);                                    
                                $Section .= "</div>";
                                $Section .= "<div class=\"col-md-8\">";
                                    $Section .= "<h3 class=\"media-heading\"><a title=\"" . $objBuque->Nombre . "\" href=\"" . $objBuque->UrlAmigable() . "\">" . $objBuque->Nombre . "</a></h3>";
                                    //$Section .= "<p>" . $objBuque->DescripcionCorta . "</p>";
                                    if ($objParticipacion->Datos->NumeroElementos() == 1) {
                                        $Section .= "<em>" . $objParticipacion->Datos->NumeroElementos() ." opini&oacute;n</em>";                            
                                    }
                                    else{
                                        $Section .= "<em>" . $objParticipacion->Datos->NumeroElementos() ." opiniones</em>";                            
                                    }
                                    $Section .= "<div class=\"row col-sm-10 col-sm-offset-2\">";
                                        $Section .= $objBuque->DibujaBotonOpinar();
                                    $Section .= "</div>";
                                $Section .= "</div>";
                            $Section .= "</div>";
                        $Section .= "</div>";
                    $Section .= "</div>";

                    $objBuque->ReiniciaObjetos();
                    $objBuque->Datos->Siguiente();
                    $i++;
                    unset($objParticipacion); 
                }
            } 
            unset($objBuque); 
            $Section .= "</div>";
            
            $Section .= "<!--right-->";
            $Section .= "<div class=\"col-md-4\">";
                $Section .= "<h1><i class=\"fa fa-2x fa-picture-o\"></i>&nbsp;Imágenes de nuestros usuarios</h1>";
                $Section .= "<div class=\"widget blog_gallery\">";
                    $Section .= "<ul class=\"sidebar-gallery\">";

                    $objArchivos = new phpArchivo;
                    $objArchivos->ConsultaParticipacion(null, vbArchivoTipoImagen, null);
                    if ($objArchivos->Datos->NumeroElementos() > 0)
                    {
                        while (!$objArchivos->Datos->Eof())
                        {
                            $objArchivos->Lee();
                            
                            $Section .= $objArchivos->DibujaImagen("usuarios/");

                            $objArchivos->ReiniciaObjetos();
                            $objArchivos->Datos->Siguiente();                    
                        }
                    } 
                    unset($objArchivos);
                    
                    $Section .= "</ul>";
                $Section .= "</div>";
            $Section .= "</div>";

        $Section .= "</div>";
        $Section .= "</div>";

        return $Section;     
    }

    function SectionOpinionesUsuario($objParametros, $objTraductor, $Codigo)
    {
        $Section = "";

        $objEmpresa = new phpEmpresa();
        
        $Section .= "<!--/#opinar-search-->";
        $Section .= "<div class=\"center fadeInDown animated capaBuscadorBarcos\" style=\"visibility: visible; animation-name: fadeInDown;\">";
        $Section .= "<div class=\"container\">";
        $Section .= "<div class=\"row\">";
        $Section .= "<div class=\"col-md-12\">";
        $Section .= "<div id=\"capaBuscadorBarcos\">";
               
            $Section .= "<div class=\"row\"><div class=\"col-xs-12 col-md-12\"><h1>Encuentre su crucero y opine</h1></div></div>";
            $Section .= "<div class=\"row\">";
                $Section .= "<div class=\"col-xs-12 col-md-8 col-md-offset-2\">";
                    $Section .= "<div class=\"row\">";
                        $Section .= "<form id=\"form-main-search\" name=\"main-search\" method=\"post\" action=\"" . $objEmpresa->UrlAmigableBuscador() . "\">";
                            $Section .= "<div class=\"col-xs-12 col-md-8\">";
                                $Section .= "<input class=\"form-control\" placeholder=\"Busque su crucero\" name=\"formText\" type=\"text\">";
                            $Section .= "</div>";
                            $Section .= "<div class=\"col-xs-12 col-md-4 text-center\">";
                                $Section .= "<button class=\"buttonNaranja btn btn-default\" type=\"submmit\">Encontrar cruceros</button>";
                            $Section .= "</div>";
                        $Section .= "</form>";
                    $Section .= "</div>";
                $Section .= "</div>";
            $Section .= "</div>";   

        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        $Section .= "</div>";
        unset($objEmpresa);

        $Section .= "<div class=\"container paginaOpiniones\">";
        $Section .= "<div class=\"row\">";
            
            $Section .= "<!--left-->";
            $Section .= "<div class=\"col-md-12\">";
            $objParticipacion = new phpParticipacion();
            $objParticipacion->ConsultaUsuario(0, $Codigo);
            $Section .= "<h1><i class=\"fa fa-2x fa-comments\"></i>&nbsp;Opiniones de nuestro usuario</h1>";
                        
            if ($objParticipacion->Datos->NumeroElementos() > 0){
                while (!$objParticipacion->Datos->Eof())
                {
                    $objParticipacion->Lee();  
                    $Section .= $objParticipacion->DibujaOpinion(true);
                    $objParticipacion->Datos->Siguiente();        
                    $objParticipacion->ReiniciaObjetos();     
                }
            }else{
                $Section .= "<h3>No se han encontrado opiniones.</h3>";  
            }
            unset($objParticipacion);
            $Section .= "</div>";

        $Section .= "</div>";
        $Section .= "</div>";

        return $Section;     
    }
}
?>