<?php
//setup db connection here
//use php sessions to keep track of logins
/*error_reporting(-1);
ini_set('display_errors', 'On');
echo "php init" . "\n";
*/
session_start();
$link = mysqli_connect("localhost","root","","carl");
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
	/*$sel_query = "SELECT name FROM users WHERE name = " . $_POST['username'];
	$result = mysqli_fetch_assoc(mysqli_query($link, $sel_query));
	$_SESSION["username"] = $result["name"];*/
    //echo "POST detected." . "\n";
	$username = $_POST['username'];
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
    }

        /* if($username == "ttest" && $password == "she6a"){
        	        $_SESSION["user-loggedin"] = true;
        	                header("Location: user_homepage.php");
exit(); */
	$conn = mysqli_connect("localhost","root","","carl");
	$result = mysqli_query($conn,"SELECT * FROM users where username = '$username' and password = '$password'")
		or die("Failed!".mysqli_error());
	$row = mysqli_fetch_array($result);
	if ($row['username'] == $username && $row['password'] == $password ){
		        $_SESSION["user-loggedin"] = true;
		        header("Location: user_homepage.php");
        exit();
	} else {
		header("Location: homepage.php");

	}

	/*$result = mysqli_query($link,"SELECT * FROM users WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
	} else {
		$message = "You are successfully authenticated!";
	}
} */



   /* else if($username == $result["name"] && $password == $result["name"]){
    	header("Location: loginpage.php");
    }*/
    //else{
        /*echo '<div class="alert alert-danger alert-dismissible fade show" style="width: 100%"> <strong>User does not exist</strong>.</div>';*/
      //  header("Location: loginpage.php");
        //echo "try again";
    //}
}

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
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<title> Elections </title>
	</head>

	<body background="white">
		<div class="container-fluid">
			<div>
				<img src="header rotate.jpg" class="backdrop">
				<div class="logo-container">
					<div>
						<div class="header">
							<a href="homepage.php">
								<img src="elections trans.png" class="logo">
							</a>
						</div>

					</div>
					<div align="center">
						<h1 class="font-weight-bold display-3 welcome animated fadeIn"> EXERCISE YOUR RIGHT TO VOTE </h1>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 170px">
			<div class="col-md-1"> </div>
			<div class="col-md-5">
				<div class="animated slideInUp delay-1s" >
					<span>
						<h1 class="display-4 add-info" align="center"> What's new? </h1>
						✔ Easy-to-use interface <br> <br>
						✔ Cool, new look! <br> <br>
						✔ Voting only takes a minute or two! <br> <br>
					</span>
				</div>
			</div>
			<div class="col-md-5">
				<div class="animated slideInUp delay-1s">
					<h1 class="display-4 add-info" align="center"> Why should you vote? </h1>
					<p>
						Do you want to make a positive impact? Voting gives you that chance! Support the candidates and ballot measures that can help your community, state, and even the nation for the greater good. Make your voice heard in these elections.
					</p>
					<div class="btn-group">
						<a class="btn btn-primary" style="" href="homepage.php"> HOME </a>
						<a class="btn btn-primary" style="" href="#loginModal" data-toggle="modal"> LOGIN </a>
					</div>
				</div>
			</div>
			<div class="col-md-1"> </div>
		</div>

		<!-- MODAL FOR LOGIN -->
		<!-- Modal -->
		<div id="loginModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> LOGIN </h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		</div>
			      	<div class="modal-body">
			        	<form method="post">
			        		<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="username" class="form-control" placeholder="username">
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password" class="form-control" placeholder="password">
							</div>
				    </div>
			      	<div class="modal-footer">
			        		<div class="form-group">
										<a href="user_login.php"> <input type="submit" value="Login" class="btn btn-primary"> </a>
									</div>
				        </form>
			      	</div>
		    	</div>
		  	</div>
		</div>
	</body>
</html>
