<?php
require_once("../../startup.php");

use App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use App\Bitm\SEID119441\Utility\Utility;

$obj = new PhoneBooks;
if (isset($_POST['limit'])) {
    $obj->setLimit($_POST['limit']);
}
$limit = $obj->getLimit();
$search = isset($_GET['search']) ? $_GET['search'] : "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    echo $_GET['search'];
    $results = $obj->index($_GET['search']);
} else {
    $results = $obj->index();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phone Book | Home</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                            $files = ["index", "create"];
                            $getid = 0;
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
                            <form action="<?php $_SERVER['PHP_SELF']; ?>">
                                <input id="search" class="srhBox" type="type" name="search" placeholder="Search" value="<?= $search; ?>">
                                <button class="srhBtn" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">	
                        <h1 class="text-animation">Phone Book List</h1>
                        <div class="message"><?= Utility::message(); ?></div>
                        <div class="listArea">
                            <div class="tableInfo">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-3 col-md-2">
                                        <form class="ajax" action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
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
                                    <div class="col-xs-6 col-sm-3 col-md-2">
                                        <div class="trashed">
                                            <a href="trashed.php">All Trash</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-8">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-9">
                                                <p class="textRight">Download list as:</p>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-3">
                                                <ul class="download">
                                                    <li>
                                                        <a href="pdf.php">
                                                            <img alt src="../../../resource/images/pdf.png">
                                                        </a>
                                                    </li>
                                                    <li>|</li>
                                                    <li>
                                                        <a href="excel.php">
                                                            <img alt src="../../../resource/images/excel.png">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
									<?php
									$slNo = 1;
									if (is_array($results) && !empty($results)) {
										foreach ($results as $result) {
											?>
                                            <tr>
                                                <td><?= $slNo; ?></td>
                                                <td>
                                                    <a href="single.php?id=<?= $result->id; ?>"><?= $result->name; ?></a>
                                                </td>
                                                <td>
                                                    <a href="tel:<?= $result->contact; ?>"><?= $result->contact; ?></a>
                                                </td>
                                                <td>
                                                    <a href="single.php?id=<?= $result->id; ?>" class="list-btn" title="View this?">
                                                        <img src="../../../resource/images/view.png">
                                                    </a>
                                                    <a href="trash.php?id=<?= $result->id; ?>" class="list-btn" title="Move to Trash?">
                                                        <img src="../../../resource/images/trash.png">
                                                    </a>
													<!--
                                                    <a href="share.php?id=<?= $result->id; ?>" class="list-btn" title="Share Your Friend?">
                                                        <img src="../../../resource/images/share.png">
                                                    </a>
													-->
                                                </td>
                                            </tr>

                                            <?php
                                            $slNo++;
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
                        </div>
						<!--
                        <div class="listBox">
                            <ul class="listLink">
                                <li><a href="p1.php">1</a>&nbsp;&nbsp;&gt; </li>
                                <li><a href="p2.php">2</a>&nbsp;&nbsp;&gt; </li>
                                <li><a href="p3.php">3</a></li>
                                <li><a class="next" href="p4.php"></a></li>
                            </ul>
                        </div>
						-->
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
        <!-- Script -->

        <script type="text/javascript" src="../../../resource/js/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function () {
                $('form.ajax select').on('change', function () {
                    var that = $(this).parent('form.ajax');
                    that.submit();
                });

                $(".message").delay(3200).fadeOut(300);
            });
        </script>

        <script>
            $(function () {
                var availableTags = [
					<?php
					$output = array();
					if (is_array($results)) {
						foreach ($results as $result) {
							$output[] = $result->name;
						}
						echo $outputs = "'" . implode("','", $output) . "'";
					} else {
						echo "Not Found";
					}
					?>
                ];
                $("#search").autocomplete({
                    source: availableTags
                });
            });
        </script>
    </body>
</html>