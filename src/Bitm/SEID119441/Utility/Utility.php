<?php

namespace App\Bitm\SEID119441\Utility;

class Utility {

    public static function dump($var) {
        $output = "<pre>";
        $output .= var_dump($var);
        $output .= "</pre>";
        return $output;
    }

    public static function dumpDie($var) {
        $output = self::dump($var);
        $output .= die();
        return $output;
    }

    public static function redirect($url = "../../../../index.php") {
        header("Location:" . $url);
        exit();
    }

    private static function setMessage($message) {
        $_SESSION['message'] = $message;
    }

    private static function getMessage() {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $_SESSION['message'] = NULL;
            return $message;
        } else {
            $_SESSION['message'] = NULL;
        }
    }

    public static function message($message = NULL) {
        if (is_null($message)) {
            $output = self::getMessage();
            return $output;
        } else {
            self::setMessage($message);
        }
    }

    public static function changeFormat($date = false, $format = "d/m/Y") {
        $dates = str_replace("/", "-", $date);
        $dates = date_create($dates);
        $formats = date_format($dates, $format);
        return $formats;
    }

    public static function pagenation($date = false, $format = "d/m/Y") {
        
    }

}

?>