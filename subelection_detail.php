<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
error_reporting(-1);
ini_set('display_errors', 'On');
/*
echo "php init" . "\n";
var_dump($_SERVER);
echo "\n";
*/
$link = mysqli_connect("localhost","root","","carl");
mysqli_set_charset($link, "utf8");
//error if not success
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); //quit if failed
}

$id = "";
$parent_election_id = "";
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
    if($id_match_result = mysqli_query($link, "SELECT * FROM subelection WHERE id='".$id."'")){
        $row_cnt = mysqli_num_rows($id_match_result);
        if($row_cnt>0){
            //succes, record found!
            $fill_data = true;
            //start filling data
            $row = mysqli_fetch_array($id_match_result);
            $name = $row['name'];
            $parent_election_id = $row['election_id'];
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
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "POST detected." . "\n";
    $vblock_id = mysqli_real_escape_string($link,$_POST['voter_block_id']);
    $querystr = "INSERT INTO subelection_authorized_vblocks(subelection_id, authorized_voter_block_id) VALUES('" . $id  . "','" . $vblock_id . "')" ;

    echo $querystr . "\n";

    mysqli_query($link, $querystr);
    echo "<h1>Authorized block</h1>" . "\n";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sub-Election Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Andada|Lato:900|Mrs+Sheppards|Open+Sans:800|Permanent+Marker|Staatliches" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation.min.css" integrity="sha256-xpOKVlYXzQ3P03j397+jWFZLMBXLES3IiryeClgU5og= sha384-gP4DhqyoT9b1vaikoHi9XQ8If7UNLO73JFOOlQV1RATrA7D0O7TjJZifac6NwPps sha512-AKwIib1E+xDeXe0tCgbc9uSvPwVYl6Awj7xl0FoaPFostZHOuDQ1abnDNCYtxL/HWEnVOMrFyf91TDgLPi9pNg==" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/js/foundation.min.js" integrity="sha256-/PFxCnsMh+nTuM0k3VJCRch1gwnCfKjaP8rJNq5SoBg= sha384-9ksAFjQjZnpqt6VtpjMjlp2S0qrGbcwF/rvrLUg2vciMhwc1UJJeAAOLuJ96w+Nj sha512-UMSn6RHqqJeJcIfV1eS2tPKCjzaHkU/KqgAnQ7Nzn0mLicFxaVhm9vq7zG5+0LALt15j1ljlg8Fp9PT1VGNmDw==" crossorigin="anonymous"></script>
</head>
<body style="background-color: #EEEEEE">
    <center>
    <!-- display record and comfirm delete -->
    <div class="flex-container align-center" style="background-color: rgb(0,0,0,0.85)">
        <h1 style="font-family: Staatliches; color: white">Sub-Election "<?php echo $name; ?>" Detail</h1>
    </div>
    Sub-Election Name:
    <?php echo $name; ?> <br>
    Description:
    <?php echo $description; ?> <br>
    <div class="flex-container align-center" style="background-color: rgb(0,0,0,0.85)">
        <h2 style="font-family: Staatliches; color: white">Authorized Voter Block list</h3>
    </div>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
            <th><strong>Voter block ID</strong></th>
            <th><strong>Voter block Name</strong></th>
            <th><strong>Action(s)</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count=1;
        $sel_query="Select subelection_authorized_vblocks.id, subelection_authorized_vblocks.authorized_voter_block_id, voter_block.name from subelection_authorized_vblocks INNER JOIN voter_block ON subelection_authorized_vblocks.authorized_voter_block_id=voter_block.id WHERE subelection_id=" . $id . " ORDER BY subelection_authorized_vblocks.id desc;";
        $result = mysqli_query($link,$sel_query);
        while($result && $row = mysqli_fetch_assoc($result)) { ?>
        <td align="center"><?php print $row["authorized_voter_block_id"]; ?></td>
        <td align="center"><?php print $row["name"]; ?></td>
        <td align="center">
        <a href="delete_auth_vblock.php?id=<?php print $row["authorized_voter_block_id"]; ?>">Delete</a> <br/>
        <a href="view_voter_block_users.php?id=<?php print $row["authorized_voter_block_id"]; ?>">View voter block users</a>
        </td>
        </tr>
        <?php $count++; } ?>
        </tbody>
    </table>
    <hr/>
    <h3>Add an authorized voter block</h3>
    <form method="post" action="subelection_detail.php?id=<?php print $id; ?>">
            Voter block (of same election): 
                <select name="voter_block_id">
                <?php
                $count=0;
                $sel_query="Select voter_block.id, voter_block.name from voter_block WHERE parent_election_id=" . $parent_election_id . " ORDER BY id asc;";
                $result = mysqli_query($link,$sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
                <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                <?php $count++; } ?>    
                </select> <br/>
            <input type="submit" value="Authorize Block" style="font-family: Staatliches; color: black" onMouseOver="this.style.color='#dfb400'"
        onMouseOut="this.style.color='black'">
    </form>
    <hr/>
    <div class="flex-container align-center" style="background-color: rgb(0,0,0,0.85)">
        <h2 style="font-family: Staatliches; color: white">Position List</h2>
    </div>
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                <th><strong>Position name</strong></th>
                <th><strong>Position description</strong></th>
                <th><strong>Action(s)</strong></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $count=1;
            $sel_query="SELECT * FROM subelection_position WHERE subelection_id=" . $id . " ORDER BY id desc;";
            $result = mysqli_query($link,$sel_query);
            while($result && $row = mysqli_fetch_assoc($result)) { ?>
            <td align="center"><?php print $row["name"]; ?></td>
            <td align="center"><?php print $row["description"]; ?></td>
            <td align="center">
            <a href="position_detail.php?id=<?php print $row["id"]; ?>">View/Edit Candidates</a> <br/>
            <a href="delete_position.php?id=<?php print $row["id"]; ?>">Delete</a>
            </td>
            </tr>
            <?php $count++; } ?>
            </tbody>
        </table>
    <hr/>    
    <div class="flex-container align-center" style="background-color: rgb(0,0,0,0.85)">
        <h2 style="font-family: Staatliches; color: white">Add position</h2>
    </div>
    <form action="new_position.php" method="post">
        <input type="hidden" value="<?php echo $id; ?>" name="subelection_id">
        Name: <input type="text" name="position_name"> <br/><br>
        Description: <input type="text" name="position_description"><br/><br>
        <input type="submit" value="Add position to sub-election" style="font-family: Staatliches; color: black" onMouseOver="this.style.color='#dfb400'"
        onMouseOut="this.style.color='black'">
    </form>
    </center>
</body>
</html>