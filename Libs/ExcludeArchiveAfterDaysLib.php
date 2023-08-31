<?php

namespace Lib;

class ExcludeArchiveAfterDaysLib
{
    public function excludeArchiveInDays($folderPath, $days)
    {

        $files = scandir($folderPath);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
        
            $filePath = $folderPath . '/' . $file;
        
            if (is_file($filePath) && $this->isOlderThanXDays($filePath, $days)) {
                unlink($filePath);
            }
        }
    }

    private function isOlderThanXDays($filePath, $days) {
        $fileCreateTime = date("d-m-Y", filectime($filePath));
        $resultTimeSumFileCreateAndDateOptionDeveloper = date('d-m-Y', strtotime("+{$days} days",strtotime($fileCreateTime)));
        return date('d-m-Y') == $resultTimeSumFileCreateAndDateOptionDeveloper ? true : false;
    }

}
