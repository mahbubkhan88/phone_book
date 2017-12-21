<?php

namespace App\Bitm\SEID119441\Model;

use \App\Bitm\SEID119441\Utility\Utility;

abstract class Model {

    public $table;
    public $times;

    public function __construct($data = false) {
        $conn = mysql_connect('localhost', 'root', '');
        $link = mysql_select_db('phonebook');
    }

    public function insert($data = array()) {
        $arrayCol = array_keys($data[$this->table]);
        $strCol = implode(",", $arrayCol);
        $arrayVal = array_values($data[$this->table]);
        $strVal = "'" . implode("','", $arrayVal) . "'";
        $sql = "INSERT INTO {$this->table}({$strCol})VALUES({$strVal})";
        $query = mysql_query($sql);
        if ($query) {
            return $data[$this->table]['id'] = mysql_insert_id();
        } else {
            return false;
        }
    }

    public function select($data = false) {
        $search = "";
        if (!empty($data)) {
            $search = " AND name LIKE '%{$data}%' ";
            $search .= " OR email LIKE '%{$data}%' ";
            $search .= " OR contact LIKE '%{$data}%' ";
            $search .= " OR age LIKE '%{$data}%' ";
            $search .= " OR gender LIKE '%{$data}%' ";
        }
        $sql = "SELECT * FROM {$this->table} WHERE trashed IS NULL {$search} LIMIT {$this->getLimit()}";
        $query = mysql_query($sql);
        return $query;
    }

    public function selectAll() {
        $sql = "SELECT * FROM {$this->table} WHERE trashed IS NULL";
        $query = mysql_query($sql);
        return $query;
    }

    public function selectShow($id = false) {
        $sql = "SELECT * FROM {$this->table} WHERE trashed IS NULL AND id={$id} LIMIT {$this->getLimit()}";
        $query = mysql_query($sql);
        return $query;
    }

    public function findChild($user = false, $id = false) {
        $ids = "";
        if (!empty($id)) {
            $ids = "AND id={$id} ";
        }
        $sql = "SELECT * FROM {$this->table} WHERE trashed IS NULL AND userId={$user} {$ids}";
        return mysql_query($sql);
    }

    public function selectTrashed($data = false) {
        $filter = "";
        if (is_array($data) && !empty($data)) {
            $data = array_values($data);
            list($columm, $value) = $data;
            $filter = " AND {$columm} LIKE '%{$value}%' ";
        }
        $sql = "SELECT * FROM {$this->table} WHERE trashed IS NOT NULL {$filter} LIMIT {$this->getLimit()}";
        $query = mysql_query($sql);
        return $query;
    }

    public function update($data = false, $id = false) {
        $isData = array();
        foreach ($data as $key => $value) {
            $isData[] = "{$key}='{$value}'";
        }
        $arrayVal = array_values($isData);
        $datas = implode(',', $arrayVal);
        $sql = "UPDATE {$this->table} SET {$datas} WHERE id={$id}";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function softDelete($id) {
        $this->times = time();
        $sql = "UPDATE {$this->table} SET trashed = {$this->times} WHERE id={$id}";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function recover($id) {
        $sql = "UPDATE {$this->table} SET trashed = NULL WHERE id={$id}";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function multipleRecover($data) {
        $ids = implode(',', $data);
        $sql = "UPDATE {$this->table} SET trashed = NULL WHERE id IN({$ids})";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id={$id}";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function multipleDelete($data) {
        $ids = implode(',', $data);
        $sql = "DELETE FROM {$this->table} WHERE id IN({$ids})";
        $query = mysql_query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function setLimit($limit = false) {
        $sql = "UPDATE items SET phonebook={$limit} WHERE id=1";
        $query = mysql_query($sql);
    }

    public function getLimit() {
        $sql = "SELECT phonebook FROM items WHERE id=1";
        $query = mysql_query($sql);
        $result = mysql_fetch_assoc($query);
        $output = $result['phonebook'];
        return $output;
    }

    public function setUnique($data = false) {
        $key = key($data);
        $val = $data[$key];
        $sql = "SELECT * FROM {$this->table} WHERE {$key}='{$val}'";
        $query = mysql_query($sql);
        return mysql_fetch_row($query);
    }

    public function setLogin($datas = array()) {
        $data = $datas['data'];
        $pass = $datas['haspassword'];
        $sql = "SELECT * FROM {$this->table} WHERE (uName='{$data}' OR email='{$data}') AND haspassword='{$pass}'";
        $query = mysql_query($sql);
        return mysql_fetch_object($query);
    }

    public function setUser($id = false) {
        $sql = "SELECT * FROM {$this->table} WHERE id={$id}";
        $query = mysql_query($sql);
        return mysql_fetch_row($query);
    }

}

?>