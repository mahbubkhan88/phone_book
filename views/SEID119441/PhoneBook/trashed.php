<?php
require_once("../../startup.php");

use App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use App\Bitm\SEID119441\Utility\Utility;

$obj = new PhoneBooks;
if (isset($_POST['limit'])) {
    $obj->setLimit($_POST['limit']);
}
$limit = $obj->getLimit();
$filter = isset($_POST['filter']) ? $_POST['filter'] : "";
$selected = isset($_POST['filterBy']) ? $_POST['filterBy'] : "";
if (isset($_POST['filter']) && !empty($_POST['filter']) && !empty($_POST['filterBy'])) {
    $results = $obj->trashed($_POST);
} else {
    $results = $obj->trashed();
}


//Utility::dumpDie($results);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phone Book | All Trash</title>
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
                            $files = ["index", "create", "Trashed"];
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
                        <div class="search">
                            <form id="filter" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                <label>Filter By:</label>
                                <select name="filterBy">
                                    <option>Select Action</option>
                                    <option <?php if ($selected == "name") {
										echo "selected";
									} ?> value="name">Name</option>
									<option <?php if ($selected == "email") {
										echo "selected";
									} ?> value="email">Email</option>
									<option <?php if ($selected == "contact") {
										echo "selected";
									} ?> value="contact">Contact</option>
									<option <?php if ($selected == "age") {
										echo "selected";
									} ?> value="age">Age</option>
                                </select>
                                <input class="srhBox" type="type" name="filter" placeholder="Filter" value="<?= $filter; ?>">
                                <button class="srhBtn" type="submit">Go</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h1>List of Trash Files</h1>
                        <div class="message"><?= Utility::message(); ?></div>
                        <div class="listArea">
                            <div class="tableInfo">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3 col-md-2">
                                        <form class="ajax" action="<?php //echo $_SERVER["PHP_SELF"];  ?>" method="post">
                                            <select class="items" name="limit">
                                                <option <?php if ($limit == 5) {
													echo "selected";
												} ?> value="5">5</option>
												<option <?php if ($limit == 10) {
													echo "selected";
												} ?> value="10">10</option>
												<option <?php if ($limit == 15) {
													echo "selected";
												} ?> value="15">15</option>
												<option <?php if ($limit == 20) {
													echo "selected";
												} ?> value="20">20</option>
                                            </select>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <form id="actionId" method="post" action="recover.php">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div id="action" class="action">
                                            <select name="action">
                                                <option>Select Action</option>
                                                <option value="recover">Recover</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <input type="submit" name="action" value="Apply">
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th><input id="allmark" type="checkbox"></th>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        $slno = 1;
                                        if (is_array($results) && !empty($results)) {
                                            foreach ($results as $result) {
                                                ?>
                                                <tr>
                                                    <td><input class="mark" name="mark[]" type="checkbox" value="<?= $result->id; ?>"></td>
                                                    <td><?= $slno; ?></td>
                                                    <td><?= $result->name; ?></td>
                                                    <td><?= $result->contact; ?></td>
                                                    <td>
                                                        <a href="recover.php?id=<?= $result->id; ?>" class="list-btn" title="Move to List?">
                                                            <img src="../../../resource/images/recover.png">
                                                        </a>
                                                        <a href="delete.php?id=<?= $result->id; ?>" class="list-btn delete" title="Delete this?">
                                                            <img src="../../../resource/images/delete.png">
                                                        </a>
                                                    </td>
                                                </tr>
												<?php
												$slno++;
											}
										} else {
											echo "<tr><td></td>
										<td>No data in store</td>
										<td>No data in store</td>
										<td>No data in store</td>
										<td>No data in store</td>
										</tr>";
										}
										?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
						<!--
                        <div class="listBox">
                            <ul class="listLink">
                                <li><a href="p1.html">1</a>&nbsp;&nbsp;&gt; </li>
                                <li><a href="p2.html">2</a>&nbsp;&nbsp;&gt; </li>
                                <li><a href="p3.html">3</a></li>
                                <li><a class="next" href="p3.html"></a></li>
                            </ul>
                        </div>
						-->
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="footerArea">
                    <div class="footer">
                        <p>Copyright @ 2016 Phone Book Management System <a href="" target="_blank"></a></p>
                    </div>
                </div>		
            </footer>
        </div>
        <!-- Script -->
        <script type="text/javascript" src="../../../resource/js/jquery-1.11.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $('form.ajax select').on('change', function () {
                    var that = $(this).parent('form.ajax');
                    that.submit();
                });
                $('.delete').click(function (e) {
                    var confirms = confirm("Are You Sure To Delete this?");
                    if (!confirms) {
                        e.preventDefault();
                    }
                });
                $('#allmark').bind('click', function () {
                    var check = $(this).is(':checked');
                    if (check) {
                        $('.mark').each(function () {
                            this.checked = true;
                        });
                    } else {
                        $('.mark').each(function () {
                            this.checked = false;
                        });
                    }
                });
                $('#action select').bind("change", function () {
                    var action = $(this).val();
                    if (action == "recover") {
                        $('#actionId').attr("action", "recover.php");
                    } else {
                        $('#actionId').attr("action", "delete.php");
                    }
                });
                $(".message").delay(3200).fadeOut(300);
            });
        </script>
    </body>
</html>