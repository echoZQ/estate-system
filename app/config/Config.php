<?php

namespace HFB\app\config;

use \PDO;
use \Hexagon\config\BaseConfig;
use \Hexagon\Context;

class Config extends BaseConfig {

    public $appName = 'estateSystem';
    public $appUrl = '';
    public $webBase = '/';
    
    public $remoteCSVHost = NULL;
    
    public $logs = [
        [
            'level' => HEXAGON_LOG_LEVEL_ALL,
            'match' => HEXAGON_LOG_MATCH_ALL,
            'appender' => '\Hexagon\system\log\FileLogAppender',
            'params' => ['filename' => 'log/all.log']
        ]
    ];
    
    public $charset = 'UTF-8';

    public $uriProtocol = HEXAGON_URI_PROTOCOL_REQUEST_URI;
    public $uriDefault = '/default/index';
    public $uriSuffix = '';
    
    public $errorHandler = NULL;
    
    public $csrfProtection = FALSE;
    
    public $encryptionKey = 'The answer to life, the universe and everything';
    
    public $cookieEncryption = TRUE;
    public $cookieLifetime = '1 hour';
    public $cookiePath = '/';
    public $cookieDomain = NULL;
    public $cookieSecure = TRUE;
    
    public $cipher = '\Hexagon\system\security\cipher\Base64Cipher';
    public $cipherIv = '50a2fabfdd276f573ff97ace8b11c5f4';
    
    public $database = [
        'default' => [
            'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=estate_system',
            'username' => 'root',
            'password' => '',
            'options' => [PDO::MYSQL_ATTR_INIT_COMMAND => 'set names "utf8"']
        ]
    ];

}