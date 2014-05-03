<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\UserModel;

class RegisterController extends Controller {

    public function index() {
    	
    }

    public function doRegister() {
	    	$account = $_POST['account'];
	    	$password = $_POST['password'];
	    	//$isRead = $_POST['checkRead'];
	    	
	    $check = $this->checkRegister($account, $password);
    		
	    if($check) {
	    		$userModel = new UserModel();
	    		
	    		$data['username'] = $account;
	    		$data['password'] = md5($password);
	    		$data['registerTime'] = date("Y-m-d H:i:s");
	    		
	    		$res = $userModel->add($data);
	    		if($res) {
	    			return self::_genJSONResult(['code' => 0,'msg' => "注册成功!", 'redirect' => '/login/index']);
	    		}else {
	    			return self::_genJSONResult(['code' => -1,'msg' => "注册失败!", 'redirect' => '/register/index']);
	    		}
	    }else {
	    		return self::_genJSONResult(['code' => -1, 'msg' => "注册失败!", 'redirect' => '/register/index']);
	    }
    }
    
    private function checkRegister($account, $password) {
    		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
    	
    		if("" == $account) {
    			throw new Exception("账号不能为空!");
    		}else {
    			$userModel = new UserModel();
    			$map['username'] = $account;
    			$res = $userModel->getByMap($map);
    			if($res) {
    				throw new Exception("该账号已被注册!");
    			}
    		}
    		if("" == $password) {
    			throw new Exception("密码不能为空!");
    		}
//     		if($isRead != "on"){
//     			throw new Exception("请先阅读服务条款");
//     		}
    		
    		return TRUE;
    }

}