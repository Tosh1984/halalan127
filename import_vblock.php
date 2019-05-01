<?php
 error_reporting(-1);
 ini_set('display_errors', 'On');
 echo "php init" . "\n";
 var_dump($_SERVER);
 //input
 //1. user id
 //2. new voting block id to copy to
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
     $block_id = mysqli_real_escape_string($link,$_POST['block_id']);
     $user_id = mysqli_real_escape_string($link,$_POST['user_id']);
     $querystr = "INSERT INTO voter_block_members(block_id, user_id) VALUES('" . $block_id . "','" . $user_id . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     echo "<h1>Authorized user to another block.</h1>" . "<br/>\n";
     //print '<a href="position_detail.php?id=' . $position_id . '">View subelection detail</a>';
     exit();
 }
?>
<html>
    <head>
        <title>Add candidate to position</title>
    </head>
    </body>
</html>
