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
     $name = mysqli_real_escape_string($link,$_POST['candidate_name']);
     $date_of_birth = mysqli_real_escape_string($link,$_POST['candidate_date_of_birth']);
     $address = mysqli_real_escape_string($link,$_POST['candidate_address']);
     $contact_number = mysqli_real_escape_string($link,$_POST['candidate_contact_number']);
     $position_id = mysqli_real_escape_string($link,$_POST['subelection_position_id']);
     $querystr = "INSERT INTO candidate(name, date_of_birth, address, contact_number, subelection_position_id) VALUES('" . $name . "','" . $date_of_birth . "','" . $address . "','" . $contact_number . "','" . $position_id . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     echo "<h1>Added candidate to position.</h1>" . "<br/>\n";
     print '<a href="position_detail.php?id=' . $position_id . '">View subelection detail</a>';
     exit();
 }
?>
<html>
    <head>
        <title>Add candidate to position</title>
    </head>
    </body>
</html>
