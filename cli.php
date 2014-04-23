<?php

namespace HFB;

require('fk/Framework.php');

use Hexagon\Framework;

const HEXAGON_APP_IN_MAINTENANCE = FALSE;

$hexagon = Framework::getInstance();

if (count($argv) > 1) {
    if (HEXAGON_CLI_MODE) {
        $hexagon->initApp(__NAMESPACE__, __DIR__)->run($argv[1], FALSE);
    } else {
        die;
    }
}