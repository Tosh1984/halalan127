
<?php
//GET the GET variables here
//(the id)
//$_GET["name"]
error_reporting(-1);
ini_set('display_errors', 'On');
/*echo "php init" . "\n";
//var_dump($_SERVER);
echo "\n";*/
$link = mysqli_connect("localhost","root","","carl");
mysqli_set_charset($link, "utf8");
//error if not success
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); //quit if failed
}?>


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

    <title> Add new voters </title>
  </head>

  <body align="center" style="font-family: Arial">
    <div align="center"> <h1 class="display-3 welcome animated slideInUp" style="color: black; text-shadow: 2px 2px gray;"> Add voters </h1> </div> <br>
    <form action="new_voters_post.php" method="post" onsubmit="return SubmitAsString()">
            Select voter block to add to: <select name="voter_block_id">
                <?php
                $count=0;
                $sel_query="Select * from voter_block ORDER BY id asc;";
                $result = mysqli_query($link,$sel_query);
                while($row = mysqli_fetch_assoc($result)) { ?>
                <option id="<?php print $row["id"]; ?>" value="<?php print $row["id"]; ?>"><?php print $row["name"]; ?></option>
                <?php $count++; } ?>    
                </select> <br/>
        <input type="hidden" name="csvString" id="csvhere" /> <br>
        <button type="submit" class="btn btn-primary">Submit to server</button>
    </form>
    <br> <br> <hr/> <br>

      <div class="col-md-12">
        <div class="col-md-6">
              <h3>Add entry:</h3>
              Name: <input type="text" id="namef"> <br>
              Surname: <input type="text" id="surname"></div>
              Date of birth: <input type="date" id="dobf"> <br>
              Address: <input type="text" id="addrf"> <br>
                Contact number: <input type="text" id="contactf"> <br>
              <button onclick="TestPopulate()" class="btn btn-primary">Add</button>
                <!-- <button onclick="SubmitAsString()">Submit table to server.</button> -->
        </div>
        <div class="col-md-6">
              <table id="MainTable" border = "1" align = "center">
                <tr>
                  <th><b>First name</b></th>
                  <th><b>Surname</b></th>
                  <th><b>Date of birth</b></th>
                  <th><b>Address</b></th>
                        <th><b>Contact number</b></th>
                  <th><b>Username</b>
                </tr>
              </table>
        </div>
      </div>
      
	<script>
		function TestPopulate(){
			//do validation here first
			var nameField = document.getElementById("namef").value;
      var surname = document.getElementById("surname").value;
			var dob = document.getElementById("dobf").value;
			var address = document.getElementById("addrf").value;
      var contactNum = document.getElementById("contactf").value;
      var username = nameField.charAt(0) + surname;
			//alerts for debug
			//alert(nameField.length);
			//alert(studentNumField.length);
			//alert(emailField.length);
			//check email first,then all the general fields that may be blank
            var table=document.getElementById("MainTable");
            var row=table.insertRow(-1);
            var cell1=row.insertCell(0);
            var cell2=row.insertCell(1);
            var cell3=row.insertCell(2);
            var cell4=row.insertCell(3);
            var cell5=row.insertCell(4);
            var cell6=row.insertCell(5);
            cell1.innerHTML = nameField;
            cell2.innerHTML = surname;
            cell3.innerHTML = dob;
            cell4.innerHTML = address;
            cell5.innerHTML = contactNum;
            cell6.innerHTML = username;
		}
        function SubmitAsString(){
            var outString = "";
            var table = document.getElementById("MainTable");
            for (var i = 1, row; row = table.rows[i]; i++) {
                //iterate through rows
                //rows would be accessed using the "row" variable assigned in the for loop
                for (var j = 0, col; col = row.cells[j]; j++) {
                    //iterate through columns
                    //columns would be accessed using the "col" variable assigned in the for loop
                    outString = outString + col.innerText;
                    if(j<5){
                        outString = outString + ",";
                    }
                }  
                outString = outString + ";";
            }
            //alert(outString);
            //var xhr = new XMLHttpRequest();
            //xhr.open("POST", "export.php", true);
            //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            //xhr.send("csv=" + outString);
            document.getElementById("csvhere").value = outString;
            return true;
        }
	</script>
  </body>
</html>
