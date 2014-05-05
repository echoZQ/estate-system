<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\AdminModel;
use HFB\app\model\db\HouseinfoModel;
use HFB\app\model\db\UserModel;

class AdminController extends Controller {
	
	public function redirect() {
		if(!isset($_SESSION['admin'])) {
			return self::_alertRedirect("请先登录!", "/admin/login");
		}
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
				$_SESSION['admin'] = $account;
				return self::_genJSONResult(['code' => 0, 'msg' => '登陆成功!', 'redirect' => '/admin/houseInfo']);
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
	
	public function houseInfo($page = 1) {
		$this->redirect();
	
		$_SESSION['link'] = "houseInfo";
		
		static $pageSize = 8;
		static $orderby = "id desc";
		$data['isSelled'] = "0";
		
		$houseInfoModel = new HouseinfoModel();
		$houses = $houseInfoModel->getListByMap($data);
		
		$count = count($houses);
		$pages = ceil($count / $pageSize);
		
		$housesInfo = $houseInfoModel->getListByMap($data, $page, $pageSize, $orderby);
		$countHouseInfo = count($housesInfo);
		
		$publishers = array();
		
		for($i=0; $i<$countHouseInfo; $i++) {
			$map['id'] = $housesInfo[$i]['sellerId'];
		
			$userModel = new UserModel();
			$res = $userModel->getByMap($map);
		
			$username = $res['username'];
		
			array_push($publishers, $username);
		}
		
		self::_bindValue("username", $_SESSION['admin']);
		self::_bindValue("houses", $housesInfo);
		self::_bindValue("publishers", $publishers);
		self::_bindValue("pages", $pages);
	}
	
	public function deleteHouseInfo() {
		$power = "房源管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$map['id'] = $_GET['id'];
			
			$houseInfoModel = new HouseinfoModel();
			$res = $houseInfoModel->delete($map);
			
			if($res) {
				return self::_alertRedirect("删除成功!");
			}else {
				return self::_alertRedirect("删除失败!");
			}
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	public function checkHouseInfo() {
		$power = "房源管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$check = $_GET['check'];
			$map['id'] = $_GET['id'];
			
			if("true" == $check) {
				$data['checkPass'] = "1";
			}else {
				$data['checkPass'] = "2";
			}
			$houseInfoModel = new HouseinfoModel();
			
			$res = $houseInfoModel->update($data, $map);
			
			if($res) {
				return self::_alertRedirect("审核成功!");
			}else {
				return self::_alertRedirect("审核失败!");
			}
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
		
	}
	
	public function houseDetail() {
		$map['id'] = $_GET['id'];
		$publisher = $_GET['publisher'];
		$isCheck = $_GET['isCheck'];
		
		$houseInfoModel = new HouseinfoModel();
		$res = $houseInfoModel->getByMap($map);
		
		self::_bindValue("house", $res);
		self::_bindValue("publisher", $publisher);
		self::_bindValue("isCheck", $isCheck);
	}
	
	public function sellRecord($page = 1) {
		$this->redirect();
		
		$_SESSION['link'] = "sellRecord";
		static $pageSize = 8;
		static $orderby = "id desc";
		$data['isSelled'] = "1";
		
		$houseInfoModel = new HouseinfoModel();
		$houses = $houseInfoModel->getListByMap($data);
		
		$count = count($houses);
		$pages = ceil($count / $pageSize);
		
		$housesInfo = $houseInfoModel->getListByMap($data, $page, $pageSize, $orderby);
		$countHouseInfo = count($housesInfo);
		
		$publishers = array();
		
		for($i=0; $i<$countHouseInfo; $i++) {
			$map['id'] = $housesInfo[$i]['sellerId'];
		
			$userModel = new UserModel();
			$res = $userModel->getByMap($map);
		
			$username = $res['username'];
		
			array_push($publishers, $username);
		}
		
		self::_bindValue("username", $_SESSION['admin']);
		self::_bindValue("houses", $housesInfo);
		self::_bindValue("publishers", $publishers);
		self::_bindValue("pages", $pages);
	}
	
	public function userInfo($page = 1) {
		$this->redirect();
		
		$_SESSION['link'] = "userInfo";
		
		static $pageSize = 8;
		static $orderby = "id desc";
		$data = array();
		
		if(!isset($_SESSION['admin'])) {
			return self::_alertRedirect("请先登录!", "/admin/login");
		}
		
		$userModel = new UserModel();
		$users = $userModel->getListByMap($data);
		
		$count = count($users);
		$pages = ceil($count / $pageSize);
		
		$usersInfo = $userModel->getListByMap($data, $page, $pageSize, $orderby);
		$countUserInfo = count($usersInfo);
		
		$publishers = array();

		self::_bindValue("username", $_SESSION['admin']);
		self::_bindValue("users", $usersInfo);
		self::_bindValue("pages", $pages);
	}
	
	public function deleteUserInfo() {
		$power = "用户管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$map['id'] = $_GET['id'];
			
			$userModel = new UserModel();
			$res = $userModel->delete($map);
			
			if($res) {
				return self::_alertRedirect("删除成功!");
			}else {
				return self::_alertRedirect("删除失败!");
			}
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	public function addAdmin() {
		$power = "管理员管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$this->redirect();
		
			$_SESSION['link'] = "adminInfo";
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	public function doAddAdmin() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		
		if(isset($_REQUEST['power'])) {
			$power = "";
			foreach($_POST['power'] as $checkbox) {
				$power .= $checkbox.";";
			}
		}else {
			$power = "";
		}
		
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['email'] = $email;
		$data['mobile'] = $mobile;
		$data['power'] = $power;
		
		$check = $this->checkAddAdmin($data, $password);
		
		if($check) {
			$adminModel = new AdminModel();
			$res = $adminModel->add($data);
			
			if($res) {
				return self::_genJSONResult(['code' => 0, 'msg' => '添加成功!', 'redirect' => '/admin/adminList']);
			}else {
				return self::_genJSONResult(['code' => -1, 'msg' => '添加失败!']);
			}
		}
		
	}
	
	public function adminList($page = 1) {
		$this->redirect();
		
		$_SESSION['link'] = "adminInfo";
		
		static $pageSize = 8;
		static $orderby = "id desc";
		$data = array();
		
		$adminModel = new AdminModel();
		$admins = $adminModel->getListByMap($data);
		
		$count = count($admins);
		$pages = ceil($count / $pageSize);
		
		$adminsInfo = $adminModel->getListByMap($data, $page, $pageSize, $orderby);
		$countAdminInfo = count($adminsInfo);
		
		self::_bindValue("username", $_SESSION['admin']);
		self::_bindValue("admins", $adminsInfo);
		self::_bindValue("pages", $pages);
	}
	
	private function checkAddAdmin($data, $password) {
		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
		
		if("" == $data['username']) {
			throw new Exception("用户名不能为空!");
		}else {
			$adminModel = new AdminModel();
			$map['username'] = $data['username'];
			$res = $adminModel->getByMap($map);
			
			if($res) {
				throw new Exception("该用户名已被注册!");
			}
		}
		if("" == $password) {
			throw new Exception("密码不能为空!");
		}
		if("" == $data['mobile']) {
			throw new Exception("手机号不能为空!");
		}
		if("" == $data['email']) {
			throw new Exception("邮箱不能为空!");
		}else {
			$adminModel = new AdminModel();
			$data2['email'] = $data['email'];
			$res = $adminModel->getByMap($data2);
			 
			if($res) {
				throw new Exception("该邮箱已被注册!");
			}
		}
		
		return TRUE;
	}
	
	public function deleteAdminInfo() {
		$power = "管理员管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$map['id'] = $_GET['id'];
			
			$adminModel = new AdminModel();
			$res = $adminModel->delete($map);
			
			if($res) {
				return self::_alertRedirect("删除成功!");
			}else {
				return self::_alertRedirect("删除失败!");
			}
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	public function updateAdmin() {
		$power = "管理员管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$map['id'] = $_GET['id'];
			
			$adminModel = new AdminModel();
			$res = $adminModel->getByMap($map);
			
			return self::_bindValue("admin", $res);
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	public function doUpdateAdmin() {
		$power = "管理员管理权限";
		$check = $this->checkPower($power);
		
		if($check) {
			$map['id'] = $_GET['id'];
			if(isset($_REQUEST['power'])) {
				$power = "";
				foreach($_POST['power'] as $checkbox) {
					$power .= $checkbox.";";
				}
			}else {
				$power = "";
			}
			
			$data['email'] = $_POST['email'];
			$data['mobile'] = $_POST['mobile'];
			$data['power'] = $power;
			
			$check = $this->checkUpdateAdmin($data);
			
			$adminModel = new AdminModel();
			$res = $adminModel->update($data, $map);
				
			if($res) {
				return self::_genJSONResult(['code' => 0, 'msg' => '更新成功!', 'redirect' => '/admin/adminList']);
			}else {
				return self::_genJSONResult(['code' => -1, 'msg' => '更新失败!']);
			}
		}else {
			return self::_alertRedirect("您没有".$power."!");
		}
	}
	
	private function checkUpdateAdmin($data) {
		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
	
		if("" == $data['mobile']) {
			throw new Exception("手机号不能为空!");
		}
		if("" == $data['email']) {
			throw new Exception("邮箱不能为空!");
		}else {
			$adminModel = new AdminModel();
			$data['email'] = $data['email'];
			$res = $adminModel->getByMap($data);
	
			if($res) {
				throw new Exception("该邮箱已被注册!");
			}
		}
	
		return TRUE;
	}
	
	private function checkPower($power) {
		$flag = false;
		$map['username'] = $_SESSION['admin'];
		
		$adminModel = new AdminModel();
		$res = $adminModel->getByMap($map);
		$powers = explode(";", $res['power']);
		
		foreach ($powers as $_power) {
			if($power == $_power) {
				$flag = true;
			}
		}
		return $flag;
	}
	
	public function loginOut() {
		$_SESSION['admin'] = null;
		
		return self::_alertRedirect("欢迎下次登录!", "/admin/login");
	} 
}