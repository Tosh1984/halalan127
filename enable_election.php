<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
/*error_reporting(-1);
ini_set('display_errors', 'On');
echo "php init" . "\n";
var_dump($_SERVER);
echo "\n";*/
$link = mysqli_connect("localhost","root","","carl");
mysqli_set_charset($link, "utf8");
//error if not success
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); //quit if failed
}
//check first if this is a POST request. if it is, it means delete the row captured on the ID (specified in POST)

$id = "";
if($id = $_GET['id']){
    /*echo "ID: " . $id . "\n";
    echo "ID end \n";*/
    $id = (int)$id;
}

$record_id = mysqli_real_escape_string($link,$_POST['record_id']);
$querystr = "UPDATE election SET enabled=1 WHERE id=" . $id . "";
echo $querystr . "\n";

mysqli_query($link, $querystr);
//echo "<h1>Election switched to enabled.</h1>" . "\n";
header("Location: index.php");
exit();




/*$election_name = "";
$election_curr_status = "";

$record_exists = false;*/
/*if($id != ""){
    //check here if record id matches and exists and populate it
    //check if id exists in the db
    //SELECT subelection_authorized_vblocks.id, subelection_authorized_vblocks.authorized_voter_block_id, voter_block.name from subelection_authorized_vblocks INNER JOIN voter_block ON subelection_authorized_vblocks.authorized_voter_block_id=voter_block.id WHERE subelection_id=" . $id . " ORDER BY subelection_authorized_vblocks.id desc;"
    if($id_match_result = mysqli_query($link, "SELECT * from election WHERE id=" . $id . ";")){
        $row_cnt = mysqli_num_rows($id_match_result);
        if($row_cnt>0){
            //succes, record found!
            $fill_data = true;
            //start filling data
            $row = mysqli_fetch_array($id_match_result);
            $election_name = $row['name'];
            $election_curr_status = $row['enabled'];
        }else{
            //quit. record does not exits
            echo "Error! Record does not exist!" . "\n";
            exit();
        }
        mysqli_free_result($id_match_result);
    }
}else{
    print "Error! An argument was not specified. Please go back and click on the proper button.";
}*/
?>

<!DOCTYPE html>
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
</html>
