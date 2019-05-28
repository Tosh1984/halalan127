<?php
/*
All information comes in the form of a post request.
First, each row is diseccted and added to the databse one by one based on the subelection ID
*/
 ini_set('display_errors', 'On');
 
 //echo "php init" . "\n";
 //var_dump($_POST);
 //echo "\n";


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
     $voter_block_id = mysqli_real_escape_string($link,$_POST['voter_block_id']);
     $csvString = mysqli_real_escape_string($link,$_POST['csvString']);
        //first of all, break the data into rows
        $row_arr = explode(";",$csvString);
        //now loop trough the rows and add to db
        foreach($row_arr as $row){
            $cell_arr = explode(",",$row);
            $pw = generatePassword();
            //add user
            if(($cell_arr[0] != "") && ($cell_arr[1] != "") && ($cell_arr[2] != "") && ($cell_arr[3] != "") && ($cell_arr[4] != "") && ($cell_arr[5] != "")){
                $querystr = "INSERT INTO users(name, surname, date_of_birth, address, contact_number, username, password) VALUES('" . $cell_arr[0] . "','" . $cell_arr[1] . "','" . $cell_arr[2]  . "','" . $cell_arr[3] . "','" . $cell_arr[4] . "','" . $cell_arr[5] . "','" . generatePassword()  . "')" ;
               // echo $querystr . "\n";
                mysqli_query($link, $querystr);
                //add voter block member
                //need block_id, user_id
                $block_id = 0;
                $user_id = 0;
                $querystr = "INSERT INTO voter_block_members(block_id, user_id) VALUES('" . $voter_block_id . "','" . mysqli_insert_id($link) . "')" ;
                //echo $querystr . "\n";
                mysqli_query($link, $querystr);
            }
           
        }

     //echo "<h1>Added users.</h1>" . "<br/>\n";
     //print '<a href="subelection_detail.php?id=' . $subelection_id . '">View subelection detail</a>';
     header("Location:new_voters.php");
     exit();

 }

    function generatePassword(){
        $str=rand(); 
        $result = md5($str); 
        return substr($result, 0, 5); 
    }
?>
<html>
    <head>
        <title>Add position to sub-election</title>
    </head>
    </body>
</html>
