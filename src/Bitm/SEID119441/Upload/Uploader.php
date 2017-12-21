<?php

namespace App\Bitm\SEID119441\Upload;

use App\Bitm\SEID119441\Utility\Utility;

class Uploader {

    public static function upload($file = false) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileType = $file['type'];
        $fileDir = "Upload/";
        $fileUniqName = self::uniqueFile($fileName);
        $filePath = $fileDir . $fileUniqName;
        $isUploaded = move_uploaded_file($fileTmpName, $filePath);
        if ($isUploaded) {
            return $filePath;
        } else {
            Utility::message("File Upload Failed");
        }
    }

    private static function uniqueFile($file = false) {
        $file_parts = explode('.', $file);
        $ext = array_pop($file_parts);
        $fileName = implode(".", $file_parts);
        return $fileName . "_" . time() . "." . $ext;
    }

}

?>