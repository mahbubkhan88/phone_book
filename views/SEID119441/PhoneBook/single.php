<?php
require_once("../../startup.php");

use \App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use \App\Bitm\SEID119441\Utility\Utility;

if (isset($_GET['id'])) {
    $obj = new PhoneBooks;
    $result = $obj->show($_GET['id']);
} else {
    //echo "There No data Found.";
    Utility::redirect('index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phone Book | Your Profile</title>
        <link rel="stylesheet" href="../../../resource/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../resource/css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container bg">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="../../../" class="back">&larr; Back</a>
                        <hr>
                        <ul class="nav">
                            <?php
                            $files = ["index", "create", "single"];
                            $getid = 2;
                            foreach ($files as $key => $file) {
                                if ($file == "index") {
                                    $name = "Home";
                                } elseif ($file == "create") {
                                    $name = "Add New";
                                } else {
                                    $name = ucfirst($file);
                                }
                                $output = "<li><a class='";
                                if ($key == $getid) {
                                    $output .= "active";
                                }
                                $output .= "' href='{$file}.php'>{$name}</a></li>";
                                echo $output;
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                        <hr>
                        <h1 class="text-animation"> Your Profile Info  !!!</h1>
                        <div class="message"><?= Utility::message(); ?></div>
                        <div class="edit">
                            <a title="Edit this?" href="edit.php?id=<?= $result->id; ?>">
                                <img alt="" src="../../../resource/images/edit.png">
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="storeArea">
                            <div class="viewArea">
                                <div class="view">
                                    <figure><img alt="" src="<?= $result->pictur; ?>"></figure>
                                </div>

                                <div class="view">
                                    <label>Name :</label>
                                    <p><?= $result->name; ?></p>
                                </div>

                                <div class="view">
                                    <label>Your Email :</label>
                                    <p><?= $result->email; ?></p>
                                </div>
                                <div class="view">
                                    <label>Your Contact :</label>
                                    <p><?= $result->contact; ?></p>
                                </div>
                                <div class="view">
                                    <label>Your Age :</label>
                                    <p><?= $result->age; ?></p>
                                </div>
                                <div class="view">
                                    <label>Your Gender :</label>
                                    <p><?= ucfirst($result->gender); ?></p>
                                </div>
                                <div class="view">
                                    <label>Your Address :</label>
                                    <p><?= $result->address; ?></p>
                                </div>
                            </div>

                            <ul class="viewLink">
                                <?php
                                $files = ["index", "edit", "trash"];
                                foreach ($files as $key => $file) {
                                    if ($file == "index") {
                                        $name = "List";
                                        echo "<li><a href='{$file}.php'>{$name}</a></li>";
                                    } else {
                                        $name = ucfirst($file);
                                        echo "<li><a href='{$file}.php?id={$result->id}'>{$name}</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="footerArea">
                    <div class="footer">
                        <p>Copyright &copy; 2016 Phone Book Management System<a href="" target="_blank"></a></p>
                    </div>
                </div>		
            </footer>
        </div>
    </body>
</html>