<?php
Class phpServidor{

    public $Traza;     
    public $Error;
    public $LongitudMaximaURL;

    private $m_intTiempoTraza;
    private $m_intEntorno;                        // Entorno de ejecución de la app
    private $m_strError;                          // Descripción de un error en la app
    private $m_blnControlURL;
    public $ServidorActual;						

    public function Entorno(){

        return $this->m_intEntorno;
        
    }

    public function ControlURL(){

        return $this->m_blnControlURL;
        
    }

    public function __construct(){
	        
        $this->Error = null;  
        $this->Traza = false;
	    $this->m_intTiempoTraza = Time();
        $this->m_blnControlURL = false;

        $this->ServidorActual=strtolower($_SERVER['SERVER_NAME']);
	
	    if ($this->ServidorActual==vbServidorTest) {
            $this->m_intEntorno=vbServidorEntornoTest;            
        }else{
            if (strpos($this->ServidorActual,".")>0) {
		      $this->m_intEntorno=vbServidorEntornoProduccion;
            }else{
		      $this->m_intEntorno=vbServidorEntornoDesarrollo;
            }
        }
        
        
	   $this->LongitudMaximaURL = vbErrorLongitudMaximaURL;
	
    }
    
    function __destruct() {
		
        //Hay que destruir los objetos

    }

    /*public sub ChequeaURL
        dim strServidor
        
        strServidor=lcase(Request.ServerVariables("SERVER_NAME"))

        if request.servervariables("QUERY_STRING") <> ""  then  
            
            dim objExpresion, strUrl, arrComandosPeligrosos, strComandoPeligroso, objComando
            
            arrComandosPeligrosos = split("CAST(%20)*\(,DECLARE(%20)+,VARCHAR(%20)*\(,EXEC(%20)*\(,DROP(%20),SELECT(%20),UPDATE(%20),INSERT(%20),DELETE(%20),TRUNCATE(%20),ALTER(%20),SET(%20),SCRIPT",",")  

            strUrl = request.servervariables("QUERY_STRING")  
            
            if Len(strUrl)>LongitudMaximaURL then
                ' Si la longitud de argumentos supera los 300, se produce error
                err.raise vbObjectError + vbErrorSQLInyeccion, "", "La longitud de argumentos supera el máximo permitido: " & strUrl  
            else
                ' Busca si tiene palabras peligrosas
                set objExpresion = new regexp  
                objExpresion.IgnoreCase = true  
                for each strComandoPeligroso in arrComandosPeligrosos  
                    objExpresion.pattern = strComandoPeligroso  
                    if objExpresion.test(strUrl) then  
                        set objComando = objExpresion.execute(strUrl)  
                        err.raise vbObjectError + vbErrorSQLInyeccion, "", "Los parámetros (" + objComando(0) + ") de la URL no son correctos: " & strUrl  
                    end if   
                next  
                set objExpresion = nothing  
            end if
        end if  
    end sub
    */

    public function DibujaTraza($strEtiqueta, $strValor){
	   $timeActual = (Time()-($this->m_intTiempoTraza));
	
	   echo "<p><font style='color: yellow; font-size: 12px;background-color: black'>[" . $timeActual . "] " . $strEtiqueta . ":<font color='white'> " . $strValor . "</font></font></p>";
	     
    }
}
?>