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

//candidate fields to populate
$id = "";
$name = "";
$description = "";
//vote count is calculated by SQL query and NOT stored.

if($id = $_GET['id']){
    echo "ID: " . $id . "\n";
    echo "ID end \n";
    $id = (int)$id;
}
$record_exists = false;
if($id != ""){
    //check here if record id matches and exists and populate it
    //check if id exists in the db 
    if($id_match_result = mysqli_query($link, "SELECT * FROM subelection_position WHERE id='".$id."'")){
        $row_cnt = mysqli_num_rows($id_match_result);
        if($row_cnt>0){
            //succes, record found!
            $fill_data = true;
            //start filling data
            $row = mysqli_fetch_array($id_match_result);
            $name = $row['name'];
            $description = $row['description'];
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
    <title>Position Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- display record and comfirm delete -->
    <h1>Position "<?php echo $name; ?>" Detail</h1>
    Position Name:
    <?php echo $name; ?> <br>
    Description:
    <?php echo $description; ?> <br>
    <h2>Candidates list</h3>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
            <th><strong>Candidate name</strong></th>
            <th><strong>Date of birth</strong></th>
            <th><strong>Address</strong></th>
            <th><strong>Contact Number</strong></th>
            <th><strong>Vote Count</strong></th>
            <th><strong>Action(s)</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count=1;
        $sel_query="Select candidate.id, candidate.name, candidate.date_of_birth, candidate.address, candidate.contact_number from candidate WHERE candidate.subelection_position_id=" . $id . " ORDER BY id desc;";
        $result = mysqli_query($link,$sel_query);
        while($row = mysqli_fetch_assoc($result)) { ?>
        <td align="center"><?php print $row["name"]; ?></td>
        <td align="center"><?php print $row["date_of_birth"]; ?></td>
        <td align="center"><?php print $row["address"]; ?></td>
        <td align="center"><?php print $row["contact_number"]; ?></td>
        <td align="center"><i>offline</i></td>
        <td align="center">
        <a href="subelection_detail.php?id=<?php print $row["id"]; ?>">Delete</a>
        </td>
        </tr>
        <?php $count++; } ?>
        </tbody>
    </table>
    <hr/>
    <h2>Add Candidate</h2>
    <form action="new_candidate.php" method="post">
        <input type="hidden" name="subelection_position_id" value="<?php print $id; ?>">
        Name: <input type="text" name="candidate_name"> <br/>
        Date of birth: <input type="date" name="candidate_date_of_birth"> <br/>
        Address: <input type="text" name="candidate_address"> <br/>
        Contact number: <input type="text" name="candidate_contact_number"> <br/>
        <input type="submit" value="Add Candidate">
    </form>
</body>
</html>