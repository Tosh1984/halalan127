<?php
//setup db connection here
//use php sessions to keep track of logins
/*error_reporting(-1);
ini_set('display_errors', 'On');
echo "php init" . "\n";
*/
session_start();
//var_dump($_SESSION);

// if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
//     echo "you are already logged in!";
//     exit();
// }

// $link = mysqli_connect("localhost","root","","MP1v1");
//error if not success
// if(mysqli_connect_errno()){
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit(); //quit if failed
// }

//check if this is a post request, if it is, add to db
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //echo "POST detected." . "\n";
	/*$username = $_POST['username'];
	$password = $_POST['password'];
    //check if email exists in the db already
    if($username == "superadmin" && $password == "master4all!"){
       // echo "credentials match! is registered!" . "\n";

        // Store data in session variables
        $_SESSION["admin-loggedin"] = true;

        // Redirect user to welcome page
       // echo "You are now logged in!" . "\n as " . "admin" . "\n";
        header("Location: index.php");
        exit();
    }else{
        echo '<div class="alert alert-danger alert-dismissible fade show" style="width: 100%"> <strong>User does not exist</strong>.</div>';
    }*/
}
echo $_SESSION['username'];
?>

<html>
	<head>
		<!--css file-->
		<link rel = "stylesheet" href = "elections.css">

		<!-- animate.css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

		<!-- Required meta tags -->
	    <meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/boostrap/css/bootstrap.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<title> Elections </title>
	</head>

	<body background="white">
		<div>
			<div>
				<img src="header rotate.jpg" class="backdrop">
				<div class="logo-container">
					<div>
						<div class="header"> 
							<a href="index.php">
								<img src="elections trans.png" class="logo">
							</a>
						</div>
						<div class="header links">
							<a style="color: white" href="loginpage.php"> home </a> | 
							<a style="color: white" href="homepage.php"> logout </a>
						</div>
					</div>
					<div align="center"> 
						<h1 class="font-weight-bold display-3 welcome animated fadeIn"> EXERCISE YOUR RIGHT TO VOTE </h1>
					</div>
				</div>
			</div>
		</div>

		

		<?php

		?>
	</body>
</html>