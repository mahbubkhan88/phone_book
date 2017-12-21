<?php
require_once("../../startup.php");

use \App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use \App\Bitm\SEID119441\Utility\Utility;

if (isset($_GET['id'])) {
    $obj = new PhoneBooks;
    $result = $obj->show($_GET['id']);
} else {
    Utility::redirect('index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phone Book | Edit Your Number</title>
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
                            $files = ["index", "create", "edit"];
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
                        <h1 class="text-animation"> Edit Your Number </h1>
                        <div class="message"><?= Utility::message(); ?></div>
                        <div class="formArea">
                            <figure><img alt="" src="<?= $result->pictur; ?>"></figure>
                            <form class="form-horizontal" method="post" action="update.php?id=<?= $result->id; ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Name :</label>
                                    <div class="col-sm-6">
                                        <input 
                                            class="form-control"
                                            type="text" 
                                            name="name"
                                            placeholder="Name"
                                            value="<?= $result->name; ?>"
                                            >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Email :</label>
                                    <div class="col-sm-6">
                                        <input 
                                            class="form-control"
                                            type="email" 
                                            name="email"
                                            placeholder="Email"
                                            value="<?= $result->email; ?>"
                                            >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Contact :</label>
                                    <div class="col-sm-6">
                                        <input 
                                            class="form-control"
                                            type="text" 
                                            name="contact"
                                            placeholder="Contact"
                                            value="<?= $result->contact; ?>"
                                            >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Age :</label>
                                    <div class="col-sm-2">
                                        <input 
                                            class="form-control"
                                            type="text" 
                                            name="age"
                                            placeholder="Age"
                                            value="<?= $result->age; ?>"
                                            >
                                    </div>
                                    <label class="col-sm-2 control-label">Your Gender :</label>
                                    <div class="col-sm-2">
                                        <input id="male"
                                               type="radio" 
                                               name="gender"
<?php if ($result->gender == "male") {
    echo"checked";
} ?>
                                               value="male"
                                               >
                                        <label for="male">Male</label>
                                        <input id="female"
                                               type="radio" 
                                               name="gender"
<?php if ($result->gender == "female") {
    echo"checked";
} ?>
                                               value="female"
                                               >
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Address :</label>
                                    <div class="col-sm-6">
                                        <input 
                                            class="form-control"
                                            type="text" 
                                            name="address"
                                            placeholder="Address"
                                            value="<?= $result->address; ?>"
                                            >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Photo :</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="pictur">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="footerArea">
                    <div class="footer">
                        <p>Copyright &copy; 2016 Phone Book Management System <a href="" target="_blank"></a></p>
                    </div>
                </div>		
            </footer>
        </div>
        <!-- Script -->
        <script type="text/javascript" src="../../../resource/js/jquery-1.11.1.min.js"></script>
        <script>
            $(function () {
                $(".message").delay(3200).fadeOut(300);
            });
        </script>
    </body>
</html>

