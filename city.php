<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
$database = "wallethub";
$conn = mysql_connect($hostname,$username,$password) or die('connection error');
mysql_select_db($database) or die('database not found');

$json = array();
$citess = array();
if($_REQUEST['action']=='load_city_pop')
{   
    $searchstr = $_REQUEST['str'];
    $myquery = "SELECT location, slug
    FROM  `population` 
    WHERE slug LIKE  '".$searchstr."%'
    ORDER BY population DESC 
    LIMIT 0 , 10";

    $row = mysql_query($myquery);
   if(!$row)
   {
          $json['result'] = 'no'; 
   }
   else
   {    
    while($data = mysql_fetch_array($row,MYSQL_ASSOC))
    {
        //echo '<pre>';
        //print_r($data);
        if(!empty($data))
        {
            $citess[] = $data;	
           // $json['result'] = 'yes';
        }
        else
        {
           
            //$json['result'] = 'no'; 
        }    
    }
     $json=$citess;
   } 
    echo json_encode($json);
}    
    
?>