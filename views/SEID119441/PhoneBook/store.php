<?php

require_once("../../startup.php");

use \App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use \App\Bitm\SEID119441\Utility\Utility;
use \App\Bitm\SEID119441\Upload\Uploader;

if (isset($_POST) && !empty($_POST)) {
    if (isset($_FILES['pictur']['name'])) {
        $filePath = Uploader::upload($_FILES['pictur']);
        if (!is_null($filePath)) {
            $_POST['pictur'] = $filePath;
        }
    }
    //Utility::dumpDie($_POST);
    $obj = new PhoneBooks;
    $obj->store($_POST);
} else {
    Utility::redirect("index.php");
}
?>