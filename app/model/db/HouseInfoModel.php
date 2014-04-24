<?php

namespace HFB\app\model\db;

use HFB\app\model\db\CommonModel;
use \Hexagon\system\db\DBAgent;
use \Hexagon\system\db\DBAgentStatement;
use HFB\app\exception\APIException;

class HouseinfoModel extends CommonModel {

	public function __construct() {
		$this->db = self::_getDBAgent('default');
		$this->table = "`houseInfo`";
	}

}