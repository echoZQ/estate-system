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
	    	$email = $_POST['email'];
	    	$mobile = $_POST['mobile'];
	    	$qq = $_POST['qq'];
	    	
	    $check = $this->checkRegister($account, $password, $email, $mobile);
    		
	    if($check) {
	    		$userModel = new UserModel();
	    		
	    		$data['username'] = $account;
	    		$data['password'] = md5($password);
	    		$data['email'] = $email;
	    		$data['mobile'] = $mobile;
	    		$data['qq'] = $qq;
	    		$data['registerTime'] = date("Y-m-d");
	    		
	    		$res = $userModel->add($data);
	    		if($res) {
	    			$_SESSION['username'] = $account;
	    			return self::_genJSONResult(['code' => 0,'msg' => "注册成功!", 'redirect' => '/default/index']);
	    		}else {
	    			return self::_genJSONResult(['code' => -1,'msg' => "注册失败!", 'redirect' => '/register/index']);
	    		}
	    }else {
	    		return self::_genJSONResult(['code' => -1, 'msg' => "注册失败!", 'redirect' => '/register/index']);
	    }
    }
    
    private function checkRegister($account, $password, $email, $mobile) {
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
    		if("" == $email) {
    			throw new Exception("邮箱不能为空!");
    		}else {
    			$userModel = new UserModel();
    			$data['email'] = $email;
    			$res = $userModel->getByMap($data);
    			
    			if($res) {
    				throw new Exception("该邮箱已被注册!");
    			}
    		}
    		
    		if("" == $mobile) {
    			throw new Exception("联系电话不能为空!");
    		}

    		return TRUE;
    }

}