<?php

namespace App\Resources;

class Logger
{
    public static function log($param){
        if(is_array($param) || is_object($param)){
            file_put_contents('/home/admin2/web/service_auth.local/public_html/storage/my_logs/log.txt', print_r($param, true) . PHP_EOL, FILE_APPEND);
        }
        if(is_string($param) || is_numeric($param)){
            file_put_contents('/home/admin2/web/service_auth.local/public_html/storage/my_logs/log.txt', $param . PHP_EOL, FILE_APPEND);
        }
        if(is_bool($param)){
            $mark = '';
            if($param === false)
                $mark = 0;
            if($param === true)
                $mark = 1;
            file_put_contents('/home/admin2/web/service_auth.local/public_html/storage/my_logs/log.txt', $mark . PHP_EOL, FILE_APPEND);
        }
        if(is_null($param)){
            file_put_contents('/home/admin2/web/service_auth.local/public_html/storage/my_logs/log.txt', NULL . PHP_EOL, FILE_APPEND);
        }
    }
}