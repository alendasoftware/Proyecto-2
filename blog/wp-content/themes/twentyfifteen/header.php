<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="author" content="Expo Cruceros">
<meta name="description" content="Expo Cruceros es un lugar donde encontrar información útil de cruceros y puertos."><meta name="keywords" content="cruceros,navieras,buques,crucero,naviera,buque,vacaciones,detino,sol,mar">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/animate.min.css" rel="stylesheet">
<link href="../css/prettyPhoto.css" rel="stylesheet">
<link href="../css/main.css" rel="stylesheet">
<link href="../css/responsive.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="../js/html5shiv.js"></script>
<script src="../js/respond.min.js"></script>
<![endif]-->
<script src="https://www.google.com/recaptcha/api.js?hl=es"></script>

<link rel="shortcut icon" href="../images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">

<link rel=”stylesheet” type=”text/css” media=”all” href=”<?php bloginfo( ‘stylesheet_url’ ); ?>” />

<?php wp_head(); ?>
</head> 

<body class="homepage">
    <header id="header">
    <div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                      
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="social">
                    <ul class="list-inline cabeceraUsuarios">
                        <li><a title="Únete" href="../registro.php">UNIRSE</a></li><li><a itle="INICIAR SESIÓN" data-toggle="modal" data-target="#loginForm">INICIAR SESIÓN</a></li>                        <li>
                            <a href="..index.php?lang=es" title="Versión en Español"><img alt="Español" src="../images/banderaEsp.jpg"></a>&nbsp;                        </li>
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
            <a class="navbar-brand" href=""><img alt="Expo Cruceros" src="../images/logo.png" /></a>
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <!--Menu-->
                <li class="active"><a href="../index.php" title="Inicio">Inicio</a></li>
		<li><a href="../cruceros.php?cod=2&nom=Cruceros" title="Cruceros">Cruceros</a></li>
		<li><a href="../ofertas.php?cod=6&nom=Lo mejor del mes" title="Lo mejor del mes">Lo mejor del mes</a></li>  
            </ul>
        </div>
    </div><!--/.container-->
</nav><!--/nav-->        
</header>

