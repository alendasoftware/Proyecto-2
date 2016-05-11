<!DOCTYPE html>
<?php
$LangContent = "<html lang=\"" . $objTraductor->getIdioma() . "\">";
echo $LangContent;
?>
<head>
    <?php
    //ZONA Meta
    echo $MetaContent;
    echo $objMenu->DibujaHead();
    ?>   
</head>
<body class="homepage">
    <header id="header">
    <?php
    echo $CookieMensaje;
    include ('plantilla/section_user.inc');
    include ('plantilla/nav_v2.inc');
    ?>        
    </header><!--/header-->
    <?php
    //ZONA Cuerpo
    echo $SectionContent;
    include ('plantilla/section_bottom.inc');
    include ('plantilla/footer.inc');
    
    echo $ScriptMensaje;

    //ZONA Script
    echo $ScriptContent;
    ?>    
</body>
</html>