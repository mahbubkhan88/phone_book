<!DOCTYPE html>
<html>
    <head><meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BITM | Final Project</title>
        <link rel="stylesheet" href="resource/css/bootstrap.min.css">
        <link rel="stylesheet" href="resource/css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container bg">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <img style="margin-left: 20px;" src="resource/images/bu%20logo.jpg" alt="BU Logo">
                        <h3 style="margin-top: -120px;">Bangladesh University</h3>
                        <h4 style="text-align: center;">Department of Computer Science & Engineering</h4>
                        <h4 style="text-align: center;">Batch No : 37th</h4>
                        <hr>
                        <h4> PROJECT NAME</h4>
                        <?php $folders = ["Phonebook"]; ?>
                        <ul class="mainNav">
                            <?php
                            foreach ($folders as $key => $folder) {
                                if ($folder == "Phonebook") {
                                    echo"<li>>>>>> <a href='views/SEID119441/{$folder}/' style='font-size:20px;'>Phone Book</a> <<<<<</li>";
                                }
                            }
                            ?>
                        </ul>
                        <h4> <u>PROJECT FEATURES: </u>  </h4>
                        <ol class="mainNav" style="list-style:decimal-leading-zero;width:60%;float: left;">
                           
                            
                            <li> Data Insertion, Deletion, Update and Read (CRUD) with Image in MYSQL. </li>	
                            <li> Phone Book Data Show By a Specific Name. </li>	
                            <li> Trash System of Phone Book Data. </li>	
                            <li> Trash Data of Phone Book Filtering By Name, Age, eMail, Phone Number. </li>
							<li> Trash Data of Phone Book Recovery System. </li>                          	
                        </ol>
                        <img src="http://www.isneo.org/wp-content/uploads/phonebook.png" style="max-width:40%;height: auto; float:right; margin-top:-40px;max-height:250px; " alt="Phonebook Image"  />
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
    </body>
</html>