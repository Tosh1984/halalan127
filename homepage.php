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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
							<a style="color: white" href="index.php"> home </a> | 
							<a style="color: white" href="#loginModal" data-toggle="modal"> login </a>
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
			        	<form>
			        		<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="username">
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" class="form-control" placeholder="password">
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