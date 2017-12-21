<?php

require_once("../../startup.php");
require_once '../../../vendor/dompdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use App\Bitm\SEID119441\PhoneBook\PhoneBooks;
use App\Bitm\SEID119441\Utility\Utility;

$obj = new PhoneBooks;
$results = $obj->indexAll();
$tr = "";
$slNo = 1;
foreach ($results as $result) {
    $tr .= "<tr>";
    $tr .= "<td> {$slNo}</td>";
    $tr .= "<td> {$result->name}</td>";
    $tr .= "<td> {$result->email}</td>";
    $tr .= "<td> {$result->contact}</td>";
    $tr .= "<td> {$result->age}</td>";
    $tr .= "<td> {$result->gender}</td>";
    $tr .= "<td><img src='{$result->pictur}'></td>";
    $tr .= "</tr>";
    $slNo++;
}
?>
<?php

$html = <<<RASHID


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
	
body{
	background:#fff;
	font-family:arial;
	color:#333;
	padding:0;
	margin:0
}
a.back{color:lime}
h1,h2,h3{text-align:center;padding:0 15px}
h4{padding:0 15px}
.wrapper{box-sizing:border-box;margin:0;padding:20px 15px;width:100%}
.container{
	margin:0 auto;
	padding-bottom:50px;
	max-width:1000px;
}
h3{font-size:20px}
.listArea{margin:0;padding:40px 0 0;widht:100%}
/*--- Table ----*/
table{border-collapse:collapse;width:100%}
tr>th,
tr>td{
	text-align:center;
	vertical-align:middle;
	border:1px solid #333;
	
}
td>img{width:60px}
#footer{
	background:rgba(51, 51, 51, 0.8);
    bottom:0;
    left:0;
    position:fixed;
    right:0;
    width:100%
}
.footerArea{
	box-sizing:border-box;
    margin:0 auto;
    max-width:1000px;
    padding:0 15px
}
.footer{text-align:right}
.footer>p{color:#3fc380;margin:10px 0}
.footer>p>a{font-family:Comic Sans MS;color:#fcff22}
.footer>p>a:hover{color:#bdfe09}
</style>
</head>
<body>
	<div class="wrapper">
		<div class="container">
					<h1>Phone Book List</h1>
					<div class="listArea">
						<table>
							<thead>
								<tr>
									<th>SL</th>
									<th>Name</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Age</th>
									<th>Gender</th>
									<th>Pictur</th>
								</tr>
							</thead>
							<tbody>
							{$tr}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div class="footerArea">
				<div class="footer">
					<p>Design & Developed by <a href="https://www.facebook.com/mdpomerul.islam" target="_blank">Md Pomerul Islam</a></p>
				</div>
			</div>		
		</footer>
	</div>
</body>
</html>

RASHID;
?>
<?php

$pdf = new Dompdf();
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'landscape');
$pdf->render();
$pdf->output();
$pdf->stream('contact_list_pdf');
?>