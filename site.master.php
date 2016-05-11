<!DOCTYPE html>
<?php
session_id();

//session_name(vbServidorTest);

session_start();

include ('plantilla/section_cookie.inc');
include ('plantilla/mensajeSistema.inc');

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
    echo $objCookie->DibujaAviso($objTraductor);
    include ('plantilla/nav.inc');
    ?>        
    </header><!--/header-->
    <?php
    include ('plantilla/section_user.inc');
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