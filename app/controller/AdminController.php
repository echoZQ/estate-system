<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\AdminModel;
use HFB\app\model\db\HouseinfoModel;
use HFB\app\model\db\UserModel;

class AdminController extends Controller {
	
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
		$_SESSION['link'] = "houseInfo";
		
		static $pageSize = 4;
		static $orderby = "id desc";
		$data['isSelled'] = "0";
		
		if(!isset($_SESSION['admin'])) {
			return self::_alertRedirect("请先登录!", "/admin/login");
		}
	
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
		$map['id'] = $_GET['id'];
		
		$houseInfoModel = new HouseinfoModel();
		$res = $houseInfoModel->delete($map);
		
		if($res) {
			return self::_alertRedirect("删除成功!");
		}else {
			return self::_alertRedirect("删除失败!");
		}
	}
	
	public function checkHouseInfo() {
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
		$_SESSION['link'] = "sellRecord";
		static $pageSize = 4;
		static $orderby = "id desc";
		$data['isSelled'] = "1";
		
		if(!isset($_SESSION['admin'])) {
			return self::_alertRedirect("请先登录!", "/admin/login");
		}
		
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
}