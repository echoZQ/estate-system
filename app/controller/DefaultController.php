<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\HouseinfoModel;
use HFB\app\model\db\UserModel;

class DefaultController extends Controller {

    public function index($page = 1) {
    		static $pageSize = 5;
    		static $orderBy = "id desc";
	    	$houseInfoModel = new HouseinfoModel();
	    	
	    	$map['isSelled'] = "0";
	   
	    	$res = $houseInfoModel->getListByMap($map);
	    	$count = count($res);
	    	$pages = ceil($count / $pageSize);
	    	
	    	if($page > $pages || $page < 0 || !is_numeric($page)) {
	    		return self::_alertRedirect("参数出错!");
	    	}
	    	
	    	if(0 != $count) {
	    		if($page > 1) { 
	    			$prevPageUrl = "/default/index?page=".($page-1);
	    			$prevPage = "<a href='".$prevPageUrl."'>上一页</a>";
	    		}else {
	    			$prevPage = "";
	    		}
	    	}
	    	if($count > 1) {
	    		if($page < $pages) {
	    			$nextPageUrl = "/default/index?page=".($page+1);
	    			$nextPage = "<a href='".$nextPageUrl."'>下一页</a>";
	    		}else {
	    			$nextPage = "";
	    		}
	    	}
	    	
	    	$houseList = $houseInfoModel->getListByMap($map, $page, $pageSize, $orderBy);
	    	
	    	//最近成交记录
	    	$data['isSelled'] = "1";
	    	$array = array();
	    	
	    $sellInfo =	$houseInfoModel->getListByMap($data);
	    
	    foreach ($sellInfo as $sell) {
			$data2['id'] = $sell['sellerId'];

	    		$userModel = new UserModel();
	    		$res = $userModel->getByMap($data2);
	    	
	    		array_push($array,$res['username']);
	    }
	    	
	    	self::_bindValue("houseInfo", $houseList);
	    	self::_bindValue("prevPage", $prevPage);
	    	self::_bindValue("nextPage", $nextPage);
	    	self::_bindValue("pagesNum", $pages);
	    	self::_bindValue("currentPage", $page);
	    	self::_bindValue("sellInfo", $sellInfo);
	    	self::_bindValue("seller", $array);
    }
    
    public function publish() {
    		if(!isset($_SESSION['username'])) {
    			return self::_alertRedirect("请先登录!","/login/index");
    		}
    }
    
    public function doPublish() {
	    	if(!isset($_SESSION['username'])) {
	    		return self::_alertRedirect("请先登录!","/login/index");
	    	}
	    	
    		$map['username'] = $_SESSION['username'];
    		
    		$userModel = new UserModel();
    		$res = $userModel->getByMap($map);
    		$uid = $res['id'];
    		
    		$housetype = $_POST['housetype'];
    		$housename = $_POST['housename'];
    		$houseprice = $_POST['houseprice'];
    		$shi = $_POST['shi'];
    		$ting = $_POST['ting'];
    		$wei = $_POST['wei'];
    		$housearea = $_POST['housearea'];
    		$housefloor = $_POST['housefloor'];
    		$housefloor1 = $_POST['housefloor1'];
    		$houseface = $_POST['houseface'];
    		$houseaddress = $_POST['houseaddress'];
    		$buildtime = $_POST['buildtime'];
    		$ownername = $_POST['ownername'];
    		$ownermobile = $_POST['ownermobile'];
    		$publishtime = date("Y-m-d");
    		
    		$data['sellerId'] = $uid;
    		$data['type'] = $housetype;
    		$data['estateName'] = $housename;
    		$data['sellPrice'] = $houseprice."万";
    		$data['houseHold'] = $shi."室".$ting."厅".$wei."卫";
    		$data['houseArea'] = $housearea."平米";
    		$data['houseFloor'] = $housefloor."/".$housefloor1;
    		$data['houseFaceTo'] = $houseface;
    		$data['address'] = $houseaddress;
    		$data['buildTime'] = $buildtime;
    		$data['publishTime'] = $publishtime;
    		$data['ownerName'] = $ownername;
    		$data['ownerMobile'] = $ownermobile;
    		
    		$check = $this->checkPublish($data);
    		
    		$houseinfoModel = new HouseinfoModel();
    		
    		$res = $houseinfoModel->add($data);
    		
    		if($res) {
    			return self::_genJSONResult(['code' => 0, "msg" => "房源信息发布成功,审核通过后即可发布，如需补充信息，请去管理房源页!", 'redirect' => "/manager/index"]);
    		}else {
    			return self::_genJSONResult(['code' => -1, "msg" => "房源信息发布失败!", 'redirect' => "/default/publish"]);
    		}
    		
    }
    
    private function checkPublish($data) {
    		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
    		
    		if("" == $data['type']) {
    			throw new Exception("发布类型不能为空!");
    		}
    		if("" == $data['estateName']) {
    			throw new Exception("小区名称不能为空!");
    		}
    		if("" == $data['sellPrice']) {
    			throw new Exception("期望售价不能为空!");
    		}
    		if("" == $data['houseHold']) {
    			throw new Exception("户型不能为空!");
    		}
    		if("" == $data['houseArea']) {
    			throw new Exception("面积不能为空!");
    		}
    		if("" == $data['houseFloor']) {
    			throw new Exception("楼层不能为空!");
    		}
    		if("" == $data['houseFaceTo']) {
    			throw new Exception("朝向不能为空!");
    		}
    		if("" == $data['address']) {
    			throw new Exception("小区地址不能为空!");
    		}
    		if("" == $data['ownerName']) {
    			throw new Exception("小区地址不能为空!");
    		}
    		if("" == $data['ownerMobile']) {
    			throw new Exception("小区地址不能为空!");
    		}
    		return TRUE;
    }
    
    public function houseDetail() {
    		$id = $_GET['id'];
    		
    		$map['id'] = $id;
    		$houseInfoModel = new HouseinfoModel();
    		
    		$res = $houseInfoModel->getByMap($map);
    		$data['id'] = $res['sellerId'];
    		
    		$userModel = new UserModel();
    		$users = $userModel->getByMap($data);
    		
    		self::_bindValue("houseInfo", $res);
    		self::_bindValue("publisher", $users['username']);
    }
    
    public function sellerHouses() {
    		$seller = $_GET['seller'];
    		$map['id'] = $_GET['sellerId'];
    		$map['checkPass'] = "1";
    		
    		$orderBy = 'id desc';
        		
    		$houseInfoModel = new HouseinfoModel();
    		
    		$houseInfo = $houseInfoModel->getListByMap($map,"","",$orderBy);
    		
    		self::_bindValue("houseInfo", $houseInfo);
    		self::_bindValue("seller", $seller);
    }

}