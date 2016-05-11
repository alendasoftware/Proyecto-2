<section id="bottom">
    <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="widget">
                    <h3>
                        <?php
                        echo $objTraductor->Traducir("Productos");
                        ?>
                    </h3>
                    <ul>
                        <?php
                        $objEmpresa = new phpEmpresa();
                        $objEmpresa->Consulta();

                        if ($objEmpresa->Datos->NumeroElementos() > 0)
                        {
                            $EmpresasLista = "";
                            while (!$objEmpresa->Datos->Eof())
                            {
                                $objEmpresa->Lee();

                                $EmpresasLista .= "<li><a href=\"" . $objEmpresa->UrlAmigable() . "\" title=\"" . $objEmpresa->Nombre . "\">" . $objEmpresa->Nombre . "</a></li>";
                                
                                $objEmpresa->ReiniciaObjetos();
                                $objEmpresa->Datos->Siguiente();
                            }
                        }

                        unset($objEmpresa);

                        echo $EmpresasLista;
                        ?>    
                    </ul>
                </div>    
            </div><!--/.col-md-12-->
            
        </div>
    </div>
</section><!--/#bottom-->