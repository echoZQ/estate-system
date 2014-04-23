<?php

namespace HFB\app\task;

use Hexagon\task\Task;

class TestTask extends Task {

    /**
     * run
     * php cli.php test/hello'
     * to run this task
     */
    public function hello() {
        echo "hello world";
    }
}