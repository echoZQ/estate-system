<?php

namespace HFB\app\controller;

use \Hexagon\controller\Controller;

class DefaultController extends Controller {

    public function index() {
    		
    }
    
    public function publish() {
    		if(!isset($_SESSION['username'])) {
    			return self::_alertRedirect("请先登录!","/login/index");
    		}
    }

}