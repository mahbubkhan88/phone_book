<?php

require_once("../../startup.php");

use App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use App\Bitm\SEID119441\Utility\Utility;

$obj = new PhoneBooks;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $obj->setRecover($_GET['id']);
} elseif (isset($_POST['mark']) && !empty($_POST['mark'])) {
    //Utility::dumpDie($_POST['mark']);
    $obj->setRecover($_POST['mark']);
} else {
    Utility::redirect('index.php');
}
?>
