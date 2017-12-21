<?php

require_once("../../startup.php");

use App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use App\Bitm\SEID119441\Utility\Utility;

if (isset($_GET['id'])) {
    $obj = new PhoneBooks;
    $obj->trash($_GET['id']);
} else {
    Utility::redirect('index.php');
}
?>
