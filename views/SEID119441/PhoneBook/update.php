<?php

require_once("../../startup.php");

use \App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use \App\Bitm\SEID119441\Utility\Utility;
use \App\Bitm\SEID119441\Upload\Uploader;

if (isset($_POST) && !empty($_POST) && !empty($_GET)) {
    if (!empty($_FILES['pictur']['name'])) {
        $filePath = Uploader::upload($_FILES['pictur']);
        if (!is_null($filePath)) {
            $_POST['pictur'] = $filePath;
        }
    }
    //Utility::dumpDie();
    $obj = new PhoneBooks;
    $obj->edit($_POST, $_GET['id']);
} else {
    Utility::redirect("index.php");
}
?>