<?php

namespace Lib;

class LogAcessLib
{
    function writeToLog($message) {
        $logFile = 'app.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;
    
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
}