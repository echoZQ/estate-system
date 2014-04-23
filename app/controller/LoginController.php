<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\UserModel;

class LoginController extends Controller {

    public function index() {
    	
    }
    
    public function doLogin() {
    		$account = $_POST['account'];
    		$password = $_POST['password'];
    		//$remember = $_POST['remember'];

    		$check = $this->checkLogin($account, $password);
    		
    		$userModel = new UserModel();
    		$map['username'] = $account;
    		$res = $userModel->getByMap($map);
    		
    		if(false != $res) {
    			if($res['password'] == md5($password)) {
    				$_SESSION['username'] = $account;
    				return self::_genJSONResult(['code' => 0, 'msg' => '登陆成功!', 'redirect' => '/default/index']);
//     				if($remember == "true") {
//     					$this->response->setCookie('username', $account, "30days");
//     				}
    			}else {
    				return  self::_genJSONResult(['code' => -1, 'msg' => '密码错误!', 'redirect' => '/login/index']);
    			}
    		}else {
    			return self::_genJSONResult(['code' => -1, 'msg' => '该用户不存在!', 'redirect' => '/login/index']);
    		}
    }
    
    private function checkLogin($account, $password) {
    		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
    		
    		if("" == $account) {
    			throw new Exception("账号不能为空!");
    		}
    		if("" == $password) {
    			throw new Exception("密码不能为空!");
    		}
    		
    		return TRUE;
    }
     
}