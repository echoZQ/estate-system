<?php

namespace HFB\app\model\db;

use \Hexagon\model\DatabaseModel;
use \Hexagon\system\db\DBAgent;
use \Hexagon\system\db\DBAgentStatement;

class CommonModel extends DatabaseModel {

    /**
     *
     * @var DBAgent
     */
    public $db;

    public $table;

    public function getListByMap($map = array(), $page = NULL, $size = 10,$orderBy = NULL) {
        $where = " where 1";
        foreach ($map as $key => $value) {
            $where .= " and `$key` = ?";
        }
        
        $sql = 'select * from ' . $this->table . $where;
        
        if($orderBy !=NULL){
            $sql .= " order by  ".$orderBy;
        }
        
        if ($page != NULL) {
            $sql .= " limit ?, ?";
        }
        
        $st = $this->db->prepare($sql);
        
        foreach ($map as  $value) {
            $st->addStatementArg($value);
        }
        
        if ($page != NULL) {
            $st->addStatementArg(($page - 1) * $size, DBAgentStatement::PARAM_INT);
            $st->addStatementArg($size, DBAgentStatement::PARAM_INT);
        }
       
        return $this->db->query($st);
    }

    public function getCountByMap($map = array()) {
        $where = " where 1";
        foreach ($map as $key => $value) {
            $where .= " and `$key` = ? ";
        }
        $sql = 'select count(*) as c from ' . $this->table . $where;
        $st = $this->db->prepare($sql);
        
        foreach ($map as  $value) {
            $st->addStatementArg($value);
        }
        
        return $this->db->queryOne($st)['c'];
    }

    public function getByMap($map = array()) {
        $where = " where 1";
        foreach ($map as $key => $value) {
            $where .= " and `$key` = ? ";
        }
        
        $sql = 'select * from ' . $this->table . $where;
        $st = $this->db->prepare($sql);
        
        foreach ($map as  $value) {
            $st->addStatementArg($value);
        }
        return $this->db->queryOne($st);
    }

    public function getCount() {
        $sql = 'select count(*) as c from ' . $this->table;
        
        $st = $this->db->prepare($sql);
        return $this->db->queryOne($st)['c'];
    }

    public function delete($map) {
        $where = " where 1";
        foreach ($map as $key => $value) {
            $where .= " and `$key` = ? ";
        }
        $sql = "delete from " . $this->table . $where;
        $st = $this->db->prepare($sql);
        
        foreach ($map as  $value) {
            $st->addStatementArg($value);
        }
        
        return $this->db->executeUpdate($st);
    }

    public function update($data, $map) {
        $set = " set ";
        $i = 0;
        foreach ($data as $key => $value) {
            if ($i == 0) {
                $set .= " `$key`= ?";
            } else {
                $set .= ",`$key`= ? ";
            }
            $i++;
        }
        $where = " where 1";
        foreach ($map as $key => $value) {
            $where .= " and `$key` = ? ";
        }
        
        $sql = "update " . $this->table . $set . $where;
        $st = $this->db->prepare($sql);
        
        foreach ($data as  $value) {
            $st->addStatementArg(htmlspecialchars($value));
        }
        
        foreach ($map as  $value) {
             $st->addStatementArg(htmlspecialchars($value));
        }
       

        $this->db->executeUpdate($st);
        
        return $this->getByMap($map);
    }

    public function add($data) {
        $i = 0;
        $fields = "";
        $values = "";
        foreach ($data as $key => $value) {
            if ($i == 0) {
                $fields .= "`$key`";
                $values .= "?";
            } else {
                $fields .= ",`" . $key . "`";
                $values .= ",?";
            }
            $i++;
        }
        
        $sql = "insert into " . $this->table . " (" . $fields . ")
        		values(" . $values . ")";
        
        try {
            $st = $this->db->prepare($sql);
            
            foreach ($data as  $value) {
                $st->addStatementArg(htmlspecialchars($value));
            }
            $num = $this->db->executeUpdate($st);
            
            if ($num > 0) {
                return $this->db->lastInsertId;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

}