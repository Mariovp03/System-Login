<?php

namespace Lib;

class LogAcessLib
{
    public function writeLogPageAcessed($ip, $page)
    {

        $caminhoArquivoLog = "Logs/Log.log";

        $arquivo = fopen($caminhoArquivoLog, "a");

        if ($arquivo) {
            $mensagemCompleta = "A página $page foi acessada através do ip $ip" . PHP_EOL;

            fwrite($arquivo, $mensagemCompleta);

            return fclose($arquivo);
        } 
    }

    public function writeAlwaysPageAlter(){
        $acessedPage = $_SERVER['REDIRECT_QUERY_STRING'] ?? NULL;

        $ipUser = $_SERVER['REMOTE_ADDR'];

        if(!empty($acessedPage)){
            return $this->writeLogPageAcessed($ipUser, $acessedPage);
        }
        
        return $this->writeLogPageAcessed($ipUser, "Página inicial");
    }
}
