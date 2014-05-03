<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\AdminModel;

class AdminController extends Controller {
	
	public function index() {
		
	}
	
	public function login() {
		
	}
	
	public function doLogin() {
		$account = $_POST['account'];
		$password = $_POST['password'];
	
		$check = $this->checkLogin($account, $password);
	
		$adminModel = new AdminModel();
		$map['username'] = $account;
		$res = $adminModel->getByMap($map);
	
		if(false != $res) {
			if($res['password'] == md5($password)) {
				$_SESSION['username'] = $account;
				return self::_genJSONResult(['code' => 0, 'msg' => '登陆成功!', 'redirect' => '/admin/index']);
			}else {
				return  self::_genJSONResult(['code' => -1, 'msg' => '密码错误!', 'redirect' => '/admin/login']);
			}
		}else {
			return self::_genJSONResult(['code' => -1, 'msg' => '该用户不存在!', 'redirect' => '/admin/login']);
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