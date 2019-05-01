 <?php
 error_reporting(-1);
 ini_set('display_errors', 'On');
/* echo "php init" . "\n";
 var_dump($_SERVER);
 echo "\n";*/
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
 
 //add product to cart
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     //echo "POST detected." . "\n";
     $name = mysqli_real_escape_string($link,$_POST['name']);
     $description = mysqli_real_escape_string($link,$_POST['description']);
     $querystr = "INSERT INTO election(name, description) VALUES('" . $name . "','" . $description . "')" ;
 
     //echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     echo "<h1>Added to elections table.</h1>" . "\n";
     exit();
 }
?>
