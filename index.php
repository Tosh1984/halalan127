
<?php
 error_reporting(-1);
 ini_set('display_errors', 'On');
 //echo "php init" . "\n";
 //var_dump($_SERVER);
 echo "\n";
 $link = mysqli_connect("localhost","root","","carl");
 //error if not success
 if(mysqli_connect_errno()){
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit(); //quit if failed
 }

 session_start();
 if(!(isset($_SESSION["admin-loggedin"]))){
    echo "you must be logged in as an admin! <br/>";
    echo '<a href="admin_login.php">Login</a>';
    exit();
}else{
    echo '<a href="admin_logout.php">Admin [logout]</a>';
}
 ?>

<html>
    <head>
            <!--css file-->
            <link rel = "stylesheet" href = "elections.css">

            <!-- animate.css -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

            <!-- Javascript-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

            <title> Elections (Admin) </title>
    </head>

    <body>
        <div align="center" class="animated bounceInDown admin-logo-container">
            <img src="elections admin.png" class="admin-logo">
        </div>
    <div align="center" class="animated bounceInUp button-container">
        <a href="create_election.html" style="color: white"> <button type="button" class="btn btn-info"> Create an election </button> </a>
        <a href="new_voter_block.php" style="color: white"> <button type="button" class="btn btn-info"> Add voter block to a election </button> </a>
        <a href="new_subelection.php" style="color: white"> <button type="button" class="btn btn-info"> Add sub-election to existing election </button> </a>
        <a href="new_voters.php" style="color:white"> <button type="button" class="btn btn-info"> Add new voters to existing voter block </button> </a>
    </div>

    <hr>
    <div class="container">
        <h2>Election list + actions</h2>
        <table class="table" style="border-collapse:collapse; font-family: Arial;">
            <thead align="center">
                <tr>
                <th><strong>Election name</strong></th>
                <th><strong>Election Desription</strong></th>
                <th><strong>Action(s)</strong></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $count=1;
            $sel_query="Select * from election ORDER BY id desc;";
            $result = mysqli_query($link,$sel_query);
            while($row = mysqli_fetch_assoc($result)) { ?>
            <td align="center"><?php print $row["name"]; ?></td>
            <td align="center"><?php print $row["description"]; ?></td>
            <td align="center">
            <a href="election_detail.php?id=<?php print $row["id"]; ?>">View/Edit Subelections</a>
            </td>
            </tr>
            <?php $count++; } ?>
            </tbody>
        </table>
    </div>
    

        <script type="text/javascript">
            $(document).ready(function(){
                $("tr:even").css( "background-color", "rgb(153, 153, 153)");
            });
        </script>

    </body>
</html>