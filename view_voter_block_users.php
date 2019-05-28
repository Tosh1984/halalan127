<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
/* The purpose of this page:
to display users associated with a voter block.
possible action: inport user to other voter block.
*/
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

$id = "";
$name = "";
$description = "";

if($id = $_GET['id']){
    //echo "ID: " . $id . "\n";
    //echo "ID end \n";
    $id = (int)$id;
}
$record_exists = false;
if($id != ""){
    //check here if record id matches and exists and populate it
    //check if id exists in the db 
    if($id_match_result = mysqli_query($link, "SELECT * FROM voter_block WHERE id='".$id."'")){
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
<body style="text-align: center;">
    <div align="left"><button class="btn btn-outline-primary" onclick="javascript:history.back()"> Back </button></div>
    <!-- display record and comfirm delete -->
    <h1 class="display-3">Voter block " <strong> <?php echo $name; ?> </strong>" Details</h1>
    <h2>Description: <?php echo $description; ?> </h2>
    <br><br><br>
    <h2>Voter list</h2>
    <table width="100%" border="1" class="table table-hover" style="border-collapse:collapse;">
        <thead>
            <tr>
            <th><strong>First Name</strong></th>
            <th><strong>Surname</strong></th>
            <th><strong>Username</strong></th>
            <th><strong>Date of birth</strong></th>
            <th><strong>Address</strong></th>
            <th><strong>Contact Number</strong></th>
            <th><strong>Action(s)</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count=1;
        $sel_query="SELECT voter_block_members.block_id, voter_block_members.user_id, users.name, users.surname, users.username, users.date_of_birth, users.address, users.contact_number, users.id FROM voter_block_members INNER JOIN users ON voter_block_members.user_id=users.id WHERE voter_block_members.block_id='".$id."'";
        $result = mysqli_query($link,$sel_query);
        while($row = mysqli_fetch_assoc($result)) { ?>
        <td align="center"><?php print $row["name"]; ?></td>
        <td align="center"><?php print $row["surname"]; ?></td>
        <td align="center"><?php print $row["username"]; ?></td>
        <td align="center"><?php print $row["date_of_birth"]; ?></td>
        <td align="center"><?php print $row["address"]; ?></td>
        <td align="center"><?php print $row["contact_number"]; ?></td>
        <td align="center"> 
            <form action="import_vblock.php" method="post">
                <input type="hidden" name="user_id" value="<?php print $id; ?>">
                <select name="block_id">
                    <?php
                    $counter=0;
                    $options_query="Select voter_block.id, voter_block.name from voter_block ORDER BY id asc;";
                    $options_result = mysqli_query($link,$options_query);
                    while($row = mysqli_fetch_assoc($options_result)) { ?>
                        <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                    <?php $counter++; } ?>    
                </select> <br/>
                <input type="submit" class="btn btn-primary" value="Add to other voting block">
            </form>
        </td>
        </tr>
        <?php $count++; } ?>
        </tbody>
    </table>
</body>
</html>