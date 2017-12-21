<?php

namespace App\Bitm\SEID119441\PhoneBook;

use App\Bitm\SEID119441\Utility\Utility;
use App\Bitm\SEID119441\Model\Model;

class PhoneBooks extends Model {

    public $table = "phonebook";
    public $id;
    public $name;

    public function __construct($data = false) {
        parent::__construct();
    }

    public function index($data = false) {
        $output = array();
        $query = $this->select($data);
        if ($query) {
            while ($row = mysql_fetch_object($query)) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }
    }

    public function indexAll() {
        $output = array();
        $query = $this->selectAll();
        if ($query) {
            while ($row = mysql_fetch_object($query)) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }
    }

    public function trashed($filter = array()) {
        if (is_array($filter) && count($filter) > 0) {
            return $this->setFilter($filter);
        } else {
            return $this->notFilter();
        }
    }

    public function setFilter($filter = array()) {
        $output = array();
        $query = $this->selectTrashed($filter);
        if ($query) {
            while ($row = mysql_fetch_object($query)) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }
    }

    public function notFilter() {
        $output = array();
        $result = $this->selectTrashed();
        if ($result) {
            while ($row = mysql_fetch_object($result)) {
                $output[] = $row;
            }
            return $output;
        } else {
            return false;
        }
    }

    public function show($id) {
        $limit = $this->getLimit();
        $data['id'] = $id;
        $query = $this->selectShow($id);
        $output = mysql_fetch_object($query);
        return $output;
    }

    /* ------ Data Storing -------- */

    public function store($data = array()) {
        $datas = array("phonebook" => $data);
        if ($this->insert($datas)) {
            $message = "<p class='success'>Data Insert Successfully.</p>";
            Utility::message($message);
        } else {
            $message = "<p class='errors'>Data Insert Failed.</p>";
            Utility::message($message);
        }
        Utility::redirect($_SERVER["HTTP_REFERER"]);
    }

    /* ------ Data Updating -------- */

    public function edit($data = false, $id = false) {
        if ($this->update($data, $id)) {
            $message = "<p class='success'>Data Update Successfully.</p>";
            Utility::message($message);
        } else {
            $message = "<p class='errors'>Data Update Failed.</p>";
            Utility::message($message);
        }
        Utility::redirect($_SERVER["HTTP_REFERER"]);
    }

    /* ------ Data Trash -------- */

    public function trash($id) {
        if ($this->softDelete($id)) {
            echo $message = "<p class='success'>Data trash Successfully.</p>";
            Utility::message($message);
        } else {
            echo $message = "<p class='errors'>Data trash Failed.</p>";
            Utility::message($message);
        }
        Utility::redirect('index.php');
    }

    /* ------ Data Delete -------- */

    public function setDelete($id) {
        if (is_array($id)) {
            if ($this->multipleDelete($id)) {
                $message = "<p class='success'>Data Delete Successfully.</p>";
                Utility::message($message);
            } else {
                $message = "<p class='errors'>Data Delete Failed.</p>";
                Utility::message($message);
            }
        } else {
            if ($this->delete($id)) {
                $message = "<p class='success'>Data Delete Successfully.</p>";
                Utility::message($message);
            } else {
                $message = "<p class='errors'>Data Delete Failed.</p>";
                Utility::message($message);
            }
        }
        Utility::redirect("trashed.php");
    }

    /* ------ Data Recover -------- */

    public function setRecover($id) {
        if (is_array($id)) {
            if ($this->multipleRecover($id)) {
                $message = "<p class='success'>Data Recover Successfully.</p>";
                Utility::message($message);
            } else {
                $message = "<p class='errors'>Data Recover Failed.</p>";
                Utility::message($message);
            }
        } else {
            if ($this->recover($id)) {
                $message = "<p class='success'>Data Recover Successfully.</p>";
                Utility::message($message);
            } else {
                $message = "<p class='errors'>Data Recover Failed.</p>";
                Utility::message($message);
            }
        }
        Utility::redirect("trashed.php");
    }

}

?>
