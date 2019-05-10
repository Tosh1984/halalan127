<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
error_reporting(-1);
ini_set('display_errors', 'On');
echo "php init" . "\n";
var_dump($_SERVER);
echo "\n";
$link = mysqli_connect("localhost","root","","carl");
mysqli_set_charset($link, "utf8");
//error if not success
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); //quit if failed
}
//check first if this is a POST request. if it is, it means delete the row captured on the ID (specified in POST)
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "POST detected." . "\n";
    $record_id = mysqli_real_escape_string($link,$_POST['record_id']);
    $querystr = "UPDATE election SET enabled=1 WHERE id=" . $record_id . "";
    echo $querystr . "\n";

	mysqli_query($link, $querystr);
    echo "<h1>Election switched to enabled.</h1>" . "\n";
    exit();
}



$election_name = "";
$election_curr_status = "";
$id = "";
if($id = $_GET['id']){
    echo "ID: " . $id . "\n";
    echo "ID end \n";
    $id = (int)$id;
}
$record_exists = false;
if($id != ""){
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enable Election</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- display record and comfirm delete -->
    <h1>Confirm ENABLE of this election? (will be enabled if already enabled)</h1>
    Election name:
    <?php print $election_name; ?> <br>
    Current status:
    <?php echo $election_curr_status; ?> <br>
    <form action="enable_election.php" method="post">
        <input type="hidden" name="record_id" value=<?php echo "\"" . $id . "\""; ?> >
        <input type="submit" name="Submit" value="Confirm Enable"/><br>
    </form>
</body>
</html>