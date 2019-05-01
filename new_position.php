<?php
 error_reporting(-1);
 ini_set('display_errors', 'On');
 echo "php init" . "\n";
 var_dump($_SERVER);
 echo "\n";
 $link = mysqli_connect("localhost","root","","carl");
 //error if not success
 if(mysqli_connect_errno()){
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit(); //quit if failed
 }
 //also quit if user not logged in
 //session_start();
 //if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
 //    echo "Error! Only logged in users may add to cart." . "\n";
 //    exit();
 //}
 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     echo "POST detected." . "\n";
     $name = mysqli_real_escape_string($link,$_POST['position_name']);
     $description = mysqli_real_escape_string($link,$_POST['position_description']);
     $subelection_id = mysqli_real_escape_string($link,$_POST['subelection_id']);
     $querystr = "INSERT INTO subelection_position(name, description, subelection_id) VALUES('" . $name . "','" . $description . "','" . $subelection_id . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     echo "<h1>Added position to sub-election.</h1>" . "<br/>\n";
     print '<a href="subelection_detail.php?id=' . $subelection_id . '">View subelection detail</a>';
     exit();
 }
?>
<html>
    <head>
        <title>Add position to sub-election</title>
    </head>
    </body>
</html>
