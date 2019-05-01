<?php
//setup db connection here
//use php sessions to keep track of logins
error_reporting(-1);
ini_set('display_errors', 'On');
echo "php init" . "\n";

session_start();
//var_dump($_SESSION);
//echo "\n";

//まず、ユーザのセーションクーキを確認
if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
    echo "you are already logged in!";
    exit();
}

// $link = mysqli_connect("localhost","root","","MP1v1");
//error if not success
// if(mysqli_connect_errno()){
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit(); //quit if failed
// }

//check if this is a post request, if it is, add to db
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "POST detected." . "\n";
	$username = $_POST['username'];
	$password = $_POST['password'];
    //check if email exists in the db already
    if($username == "superadmin" && $password == "master4all!"){
        echo "credentials match! is registered!" . "\n";
        // Password is correct, so start a new session
        session_start();

        // Store data in session variables
        $_SESSION["admin-loggedin"] = true;

        // Redirect user to welcome page
        echo "You are now logged in!" . "\n as " . "admin" . "\n";
        exit();
    }else{
        echo "username (or pw) does not exist!" . "\n";
    }
}
?>

<html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Login</h1>
    <form action="admin_login.php" method="post">
        <!-- 自分情報を入力 -->
        <label>username: </label>
        <input type="text" name="username"><br>
        <label>password: </label>
        <input type="password" name="password"><br>
        <input type="submit" name="Submit" value="Submit"/><br>
    </form>
</body>
</html>
