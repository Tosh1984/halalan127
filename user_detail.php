<?php
/*
Position Detail: list, add and delete candidates for a specific position.
Uses GET request from ID
Only the POSITION ID is needed to display candidates for that position
The database handles the rest.
*/
//GET the GET variables here
//(the id)
//$_GET["name"]
error_reporting(-1);
ini_set('display_errors', 'On');
/*echo "php init" . "\n";
var_dump($_SERVER);
echo "\n";*/
$link = mysqli_connect("localhost","root","","carl");
mysqli_set_charset($link, "utf8");
//error if not success
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); //quit if failed
}

//candidate fields to populate
$id = "";
$name = "";
$address = "";
$date_of_birth = "";
$contact_number = "";
//vote count is calculated by SQL query and NOT stored.

if($id = $_GET['id']){
    /*echo "ID: " . $id . "\n";
    echo "ID end \n";*/
    $id = (int)$id;
}
$record_exists = false;
if($id != ""){
    //check here if record id matches and exists and populate it
    //check if id exists in the db 
    if($id_match_result = mysqli_query($link, "SELECT * FROM users WHERE id='".$id."'")){
        $row_cnt = mysqli_num_rows($id_match_result);
        if($row_cnt>0){
            //succes, record found!
            $fill_data = true;
            //start filling data
            $row = mysqli_fetch_array($id_match_result);
            $name = $row['name'];
            $address = $row['address'];
            $date_of_birth = $row['date_of_birth'];
            $contact_number = $row['contact_number'];
        }else{
            //quit. record does not exits
            echo "Error! Record does not exist!" . "\n";
            exit();
        }
        mysqli_free_result($id_match_result);
    }
}else{
    print "Error! An argument was not specified. Please go back and click on the proper button.";
}
?>

<!DOCTYPE html>
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
    <body>
        <!-- display record and comfirm delete -->
        <h1>Voter <strong> <?php echo $name; ?> </strong> Details</h1>
        Name:
        <?php echo $name; ?> <br>
        DOB:
        <?php echo $date_of_birth; ?> <br>
        Address:
        <?php echo $address; ?> <br>
        contact:
        <?php echo $contact_number; ?> <br>
       
        <h2>Add to other voter block</h2>
        <form action="import_vblock.php" method="post">
            <input type="hidden" name="user_id" value="<?php print $id; ?>">
            <select name="block_id">
                    <?php
                    $count=0;
                    $sel_query="Select voter_block.id, voter_block.name from voter_block ORDER BY id asc;";
                    $result = mysqli_query($link,$sel_query);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                    <?php $count++; } ?>    
                    </select> <br/>
            <input type="submit" value="Add to other voting block">
        </form>
    </body>
</html>