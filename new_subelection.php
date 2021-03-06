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
 if($id = $_GET['id']){
    /*
    echo "ID: " . $id . "\n";
    echo "ID end \n";
    */
    $id = (int)$id;
}
$sel_query = "SELECT name FROM election WHERE id = " . (int)$_GET['id'];
$result = mysqli_fetch_assoc(mysqli_query($link, $sel_query));
 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     echo "POST detected." . "\n";
     $name = mysqli_real_escape_string($link,$_POST['voter_block_name']);
     $description = mysqli_real_escape_string($link,$_POST['voter_block_description']);
     $election_id = mysqli_real_escape_string($link,$_POST['election_id']);
     $allow_all_voter_blocks = mysqli_real_escape_string($link,$_POST['allow_all_voter_blocks']);
     if($allow_all_voter_blocks == "on"){
         $allow_all_voter_blocks = 1;
     }else{
         $allow_all_voter_blocks = 0;
     }
     $querystr = "INSERT INTO subelection(name, description, election_id, allow_all_voter_blocks) VALUES('" . $name . "','" . $description . "','" . $election_id . "','" . $allow_all_voter_blocks . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     //echo "<h1>Added to cart.</h1>" . "\n";
     exit();
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

        <title>Add sub-election to election</title>
    </head>
    <body style="background-image: url('header rotate.jpg'); background-position: sticky; background-size: cover">
        <div align="center"> <h1 class="py-2 display-2 welcome animated slideInUp"> Add sub-election to <strong><?php echo $result["name"] ?></strong> </h1> </div> <br>
        <div align="center" style="background-color: rgba(255, 255, 255, 0.5); width:50%; margin-left: 25%; border-radius: 10px" class="p-2 shadow animated slideInUp">
            <br>
            <form action="new_subelection.php?id=<?php echo $id; ?>" method="post">
            <!-- Select election to add to: <select name="election_id">
            <?php
            $count=0;
            $sel_query="Select * from election ORDER BY id asc;";
            $result = mysqli_query($link,$sel_query);
            while($row = mysqli_fetch_assoc($result)) { ?>
            <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
            <?php $count++; } ?>    
            </select> <br/> -->

            Sub-election name: <input type="text" name="voter_block_name"> <br/>
            Sub-election description: <input type="text" name="voter_block_description"> <br/>
            <input type="checkbox" name="allow_all_voter_blocks"> Allow voting of all voter blocks to the election <br/>
            <i>Specific authorized voter blocks will be added later</i> <br/> <br>
            <input type="submit" class="btn btn-primary" value="Add subelection">
            <input type="hidden" name="election_id" value="<?php echo $_GET['id'] ?>">
            </form>
        </div>
    </body>
</html>
