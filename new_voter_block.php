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
 
 //add product to cart
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     echo "POST detected." . "\n";
     $name = mysqli_real_escape_string($link,$_POST['voter_block_name']);
     $description = mysqli_real_escape_string($link,$_POST['voter_block_description']);
     $election_id = mysqli_real_escape_string($link,$_POST['election_id']);
     $querystr = "INSERT INTO voter_block(name, description , parent_election_id) VALUES('" . $name . "','" . $description . "','"  . $election_id . "')" ;
 
     echo $querystr . "\n";
 
     mysqli_query($link, $querystr);
     echo "<h1>Added voter block to subelection.</h1>" . "\n";
     exit();
 }
?>
<html>
    <head>
        <title>Add voter block to election</title>
        <link href="https://fonts.googleapis.com/css?family=Andada|Lato:900|Mrs+Sheppards|Open+Sans:800|Permanent+Marker|Staatliches" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/css/foundation.min.css" integrity="sha256-xpOKVlYXzQ3P03j397+jWFZLMBXLES3IiryeClgU5og= sha384-gP4DhqyoT9b1vaikoHi9XQ8If7UNLO73JFOOlQV1RATrA7D0O7TjJZifac6NwPps sha512-AKwIib1E+xDeXe0tCgbc9uSvPwVYl6Awj7xl0FoaPFostZHOuDQ1abnDNCYtxL/HWEnVOMrFyf91TDgLPi9pNg==" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.3/dist/js/foundation.min.js" integrity="sha256-/PFxCnsMh+nTuM0k3VJCRch1gwnCfKjaP8rJNq5SoBg= sha384-9ksAFjQjZnpqt6VtpjMjlp2S0qrGbcwF/rvrLUg2vciMhwc1UJJeAAOLuJ96w+Nj sha512-UMSn6RHqqJeJcIfV1eS2tPKCjzaHkU/KqgAnQ7Nzn0mLicFxaVhm9vq7zG5+0LALt15j1ljlg8Fp9PT1VGNmDw==" crossorigin="anonymous"></script>

    </head>
    <body style="background-color: #EEEEEE">
        <div class="flex-container align-center" style="background-color: rgb(0,0,0,0.85)">
            <h1 style="font-family: Staatliches; color: white">Add voter block to election</h1>
        </div>
        <form action="new_voter_block.php" method="post">
            <center>
                <br>
                <label style="font-family: Staatliches; font-size: 2vw">Select election to add to: </label><select name="election_id">
                <?php
                $count = 0;
                $sel_query = "SELECT * FROM election ORDER BY id asc";
                $result = mysqli_query($link, $sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
                <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                <?php $count++; } ?>    
                </select> <br/>
                <label style="font-family: Staatliches; font-size: 2vw"> Voter block name: </label><input type="text" name="voter_block_name"> <br/>
                <label style="font-family: Staatliches; font-size: 2vw"> Voter block description: </label><input type="text" name="voter_block_description"> <br/>
                <h3><input type="submit" value="Add voter block" style="font-family: Staatliches; color: black" onMouseOver="this.style.color='#dfb400'"
        onMouseOut="this.style.color='black'"></h3>
            </center>
        </form>
    </body>
</html>
