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
    $querystr = "DELETE FROM subelection_position WHERE id=" . $record_id . "";

    echo $querystr . "\n";

	mysqli_query($link, $querystr);
    echo "<h1>Record deleted.</h1>" . "\n";
    exit();
}



$position_name = "";
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
    if($id_match_result = mysqli_query($link, "SELECT * from subelection_position WHERE id=" . $id . ";")){
        $row_cnt = mysqli_num_rows($id_match_result);
        if($row_cnt>0){
            //succes, record found!
            $fill_data = true;
            //start filling data
            $row = mysqli_fetch_array($id_match_result);
            $position_name = $row['name'];
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
    <title>Delete Position</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- display record and comfirm delete -->
    <h1>Confirm delete of this record?</h1>
    Position name:
    <?php print $position_name; ?> <br>
    ID:
    <?php echo $id; ?> <br>
    <form action="delete_position.php" method="post">
        <input type="hidden" name="record_id" value=<?php echo "\"" . $id . "\""; ?> >
        <input type="submit" name="Submit" value="Confirm Delete"/><br>
    </form>
</body>
</html>