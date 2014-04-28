<?php

namespace HFB\app\controller;

use \Exception;
use \Hexagon\controller\Controller;
use HFB\app\model\db\HouseinfoModel;
use HFB\app\model\db\UserModel;

class ManagerController extends Controller {
	
	public function _pre() {
		if(!isset($_SESSION['username'])) {
			return self::_alertRedirect("请先登录!","/login/index");
		}
	}
	
    public function index() {
    		$username = $_SESSION['username'];
    		$map['username'] = $username;
    		
    		$userModel = new UserModel();
    		
    		$res = $userModel->getByMap($map);
    		
    		$uid = $res['id'];
    		$data['sellerId'] = $uid;
    		
    		$houseInfoModel = new HouseinfoModel();
    		
    		$houseInfo = $houseInfoModel->getListByMap($data);
    		
    		return self::_bindValue("houseInfo", $houseInfo);
    		
    }
    
    public function delete($id) {
    		$map['id'] = $id;
    		$houseinfoModel = new HouseinfoModel();
    		$res = $houseinfoModel->delete($map);
    		
    		if($res) {
    			return self::_alertRedirect("删除成功!", "/manager/index");
    		}else {
    			return self::_alertRedirect("删除失败!");
    		}
    }
    
    public function update($id) {
    		$map['id'] = $id;
    		$houseinfoModel = new HouseinfoModel();
    		
    		$houseInfo = $houseinfoModel->getByMap($map);
    		
    		return self::_bindValue("houseInfo", $houseInfo);
    }
	
    public function doUpdate() {
    		$id = $_POST['id'];
    		$houseprice = $_POST['houseprice'];
    		$ownername = $_POST['ownername'];
    		$ownermobile = $_POST['ownermobile'];
    		
    		$data['sellPrice'] = $houseprice;
    		$data['ownerName'] = $ownername;
    		$data['ownerMobile'] = $ownermobile;
    		
    		$check = $this->checkUpdate($data);
    		
    		$map['id'] = $id;
    		$houseInfoModel = new HouseinfoModel();
    		$res = $houseInfoModel->update($data, $map);
    		
    		if($res) {
    			return self::_genJSONResult(['code' => "0", 'msg' => "更新成功!", 'redirect' => "/"]);
    		}else {
    			return self::_genJSONResult(['code' => "-1", 'msg' => "更新失败!", 'redirect' => "/"]);    		
    		}
    }

    	public function uploadFile() {
    		$id = $_GET['id'];
    		$map['id'] = $id;
    		
    		$file = $_FILES["file"]["name"];
    		$_FILES["file"]["name"] = $_SESSION['username'].$file;
	   	
    		if (file_exists("upload/" . $_FILES["file"]["name"]))
    		{
    			//plupload 服务器端回调在哪呢?
    			//return self::_alertRedirect($file . "此文件已存在");
    		} else {
    			move_uploaded_file($_FILES["file"]["tmp_name"],
    			"upload/" . $_FILES["file"]["name"]);
    			
    			$houseInfoModel = new HouseinfoModel();
    			
    			$res = $houseInfoModel->getByMap($map);
    			$img = $res['img'];
    			
    			if("" != $img) {
    				$imgArray = explode(";",$img);
    				if(count($imgArray) < 8) {
    					array_push($imgArray, "/upload/" . $_FILES["file"]["name"]);
    				}
    				$data['img'] = implode(";", $imgArray);
    			}else {
    				$data['img'] = "/upload/" . $_FILES["file"]["name"];
    			}
    
    			$res = $houseInfoModel->update($data, $map);
    		}
    	}
    	
    	private function checkUpdate($data) {
    		self::_setExceptionHandler('HFB\app\exception\JSONExceptionHandler');
    		
    		if("" == $data['sellPrice']) {
    			throw new Exception("期望售价不能为空!");
    		}
    		if("" == $data['ownerName']) {
    			throw new Exception("联系人不能为空!");
    		}
    		if("" == $data['ownerMobile']) {
    			throw new Exception("联系电话不能为空!");
    		}
    		
    		return TRUE;
    	}
}