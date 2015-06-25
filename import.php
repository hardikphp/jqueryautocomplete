<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
$database = "wallethub";
$datafile = $_SERVER['DOCUMENT_ROOT'].'/mydemo/logintest/wallethub/doc/PhP Test/tempdata.csv';
$conn = mysql_connect($hostname,$username,$password) or die('connection error');
mysql_select_db($database) or die('database not found');


$apploquery = 'LOAD DATA LOCAL INFILE "'.$datafile.'"
							INTO TABLE population
							FIELDS TERMINATED BY "," ENCLOSED BY \'"\'
							LINES TERMINATED BY "\\r\n"
							( location,
                                                           slug,
                                                           population
							)
							';
                echo $apploquery;

			
                        $result = mysql_query($apploquery);
			if(!$result){
				$error = true;
			}
			else{
                            echo mysql_error();
                        }
                        
                        