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

$sel_query = "SELECT name FROM election WHERE id = " . (int)$_GET['id'];
$result = mysqli_fetch_assoc(mysqli_query($link, $sel_query));

 //add product to cart
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     echo "POST detected." . "\n";
     $name = mysqli_real_escape_string($link,$_POST['voter_block_name']);
     $description = mysqli_real_escape_string($link,$_POST['voter_block_description']);
     $election_id = mysqli_real_escape_string($link,$_POST['election_id']);
     $querystr = "INSERT INTO voter_block(name, description , parent_election_id) VALUES('" . $name . "','" . $description . "','"  . (int)$election_id . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     //echo "<h1>Added voter block to subelection.</h1>" . "\n";
     header("Location: index.php");
     exit();
 }
?>

<?php
    /*$id = "";
    if($id = $_GET['id']){
        echo "ID: " . $id . "\n";
        echo "ID end \n";
        $id = (int)$id;
    }*/
    //$sel_query = "SELECT name FROM election WHERE id = " . (int)$_GET['id'];
    //$result = mysqli_fetch_assoc(mysqli_query($link, $sel_query));
    //echo $result["name"];
?>
<html>
    <head>
        <link rel = "stylesheet" href = "elections.css">
        <link rel="stylesheet" type="text/css" href="animate.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>Halalan127 | Admin</title>

    </head>
    <body style="background-image: url('header rotate.jpg'); background-position: sticky; background-size: cover">
        <div align="center"> <h1 class="py-2 display-2 welcome animated slideInUp"> Add new voter block to <strong><?php echo $result["name"] ?></strong> </h1> </div> <br>
        <div align="center" style="background-color: rgba(255, 255, 255, 0.5); width:50%; margin-left: 25%; border-radius: 10px" class="p-2 shadow animated slideInUp">
            <br>
            <form action="new_voter_block.php" method="post">
                <center>
                    <br>
                    <!-- <select name="election_id">
                    <?php
                    $count = 0;
                    $sel_query = "SELECT * FROM election ORDER BY id asc";
                    $result = mysqli_query($link, $sel_query);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                    <?php $count++; } ?>    
                    </select> <br/> -->
                    
                    <label> Voter block name: </label><input type="text" name="voter_block_name"> <br/>
                    <label> Voter block description: </label><input type="text" name="voter_block_description"> <br/>
                    <input type="hidden" name="election_id" value="<?php echo $_GET['id'] ?>"> <br>
                    <h3><input type="submit" value="Add voter block" class="btn btn-primary"></h3>
                </center>
            </form>
        </div>
    </body>
</html>
