<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
//error_reporting(-1);
//ini_set('display_errors', 'On');
//echo "php init" . "\n";
//var_dump($_SERVER);
//echo "\n";
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
    /*
    echo "ID: " . $id . "\n";
    echo "ID end \n";
    */
    $id = (int)$id;
}
$record_exists = false;
if($id != ""){
    //check here if record id matches and exists and populate it
    //check if id exists in the db 
    if($id_match_result = mysqli_query($link, "SELECT * FROM election WHERE id='".$id."'")){
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
    <title>Election Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="text-align: center;">
    <!-- display record and comfirm delete -->
    <div style="background-color: black; color:white; text-align:center; font-family: arial">
    <h1>Election "<?php echo $name; ?>" Detail</h1>
    </div>
    Election Name:
    <?php echo $name; ?> <br><br>
    Description:
    <?php echo $description; ?> <br>
    <h2>Sub-election list</h3>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
            <th><strong>Sub-Election name</strong></th>
            <th><strong>Sub-Election Desription</strong></th>
            <th><strong>All voter blocks allowed?</strong></th>
            <th><strong>Action(s)</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count=1;
        $sel_query="Select * from subelection WHERE election_id=" . $id . " ORDER BY id desc;";
        $result = mysqli_query($link,$sel_query);
        while($row = mysqli_fetch_assoc($result)) { ?>
        <td align="center"><?php print $row["name"]; ?></td>
        <td align="center"><?php print $row["description"]; ?></td>
        <td align="center"><?php print $row["allow_all_voter_blocks"]; ?></td>
        <td align="center">
        <a href="subelection_detail.php?id=<?php print $row["id"]; ?>">View/Edit authorized voter blocks</a>
        </td>
        </tr>
        <?php $count++; } ?>
        </tbody>
    </table>
</body>
</html>