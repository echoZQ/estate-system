<?php

namespace HFB\app\exception;

use \Exception;
use \Hexagon\system\exception\ExceptionHandler;

class JSONExceptionHandler extends ExceptionHandler {
    
    public function handleException(Exception $ex) {
        return self::_genJSONResult(['code' => -1, 'msg' => $ex->getMessage()]);     
    }
    
}