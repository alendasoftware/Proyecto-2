<!DOCTYPE html>
<html lang="es"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
</head>
<body>
<?Php
//Inclución de librerías
require ('AppCode/principal.inc.php');

$intCodigo = 1;

function ScanDirectory($Directory, $objBasedato, &$intCodigo){

  $MyDirectory = opendir($Directory) or die('Error');
	while($Entry = @readdir($MyDirectory)) {
		if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {                         
			ScanDirectory($Directory.'/'.$Entry, $objBasedato, $intCodigo);                        
		}
		else {
			if($Entry != '.' && $Entry != '..' && (strpos($Entry , '_p.jpg') === false) && (strpos($Entry , '.html') === false))  
			{		
				$a=explode("/",$Directory);  
				
				if (sizeof($a)>3) {	
					$intBuque = $a[3];
					$strTipo = $a[4];
					$intTipo = 0;
					$strGrupo = "";
					if ($strTipo =="imagenes") {
						$intTipo = vbArchivoTipoImagen;
						$strGrupo = vbGrupoImagen;
					}
					if ($strTipo =="slider") {
						$intTipo = vbArchivoTipoImagen;
						if ($Entry=='header.jpg') {
							$strGrupo = vbGrupoImagenSlider;
						}else{
							$strGrupo = vbGrupoImagenSliderCubierta;	
						}
							
					}
					if ($intTipo>0)
					{
						insertaArchivo($intCodigo, utf8_encode($Entry), $intTipo, $strGrupo, $objBasedato);					
						$insertaArchivoBuque = insertaArchivoBuque($intCodigo, $intBuque, $objBasedato);	
						$intCodigo++;	
						//echo 'Insertado:' . $Entry . '<hr>';
					}
				}
			}	
        }
	}
  closedir($MyDirectory);
}

function insertaArchivo($intCodigo, $Entry, $intTipo, $strGrupo, $objBasedato){

	$Consulta = "INSERT INTO archivos (arc_codigo, arc_nombre, arc_tipo, arc_observaciones, arc_grupo) VALUES (" . $intCodigo . ", '".$Entry."', ". $intTipo .", null, '".$strGrupo."');";	
	echo $Consulta .'<br>';	
	//return $objBasedato->InsertaDatos($Consulta);    
}

function insertaArchivoBuque($intArchivo, $intBuque, $objBasedato){

	$Consulta = "INSERT INTO buques_archivos (bua_archivo, bua_buque, bua_grupo, bua_orden) VALUES (".$intArchivo.", ". $intBuque .", null, 1);";
	echo $Consulta .'<br>';
	//return $objBasedato->InsertaDatos($Consulta);    
}

ScanDirectory("subidas/buques/", $objBasedato, $intCodigo);

?>
</body>
</html>