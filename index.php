<?php
$link = mysqli_connect("localhost","root","","carl");
//error if not success
if(mysqli_connect_errno()){

  echo "";
  // The database server is not responding please check with your database administrator.
  die(); //quit if failed
}

session_start();
$navbarOptions = '';
if(!(isset($_SESSION["admin-loggedin"]))){
$navbarOptions = '<form action="admin_logout.php" method="post">
                    <button type="submit" class="btn btn-outline-secondary" name="logout" id="logout">Log Out</button>
                  </form>';
} else {

$navbarOptions = '<a href="admin_login.php">Login</a>';
}
 ?>

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

  <body>
    <header>
      <nav class="navbar navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
          <li class="nav-item align-self-center">
            <?php echo $navbarOptions; ?>
          </li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="container">
        <div align="center" class="">
            <img src="elections admin.png">
        </div>
        <div align="center">
            <a href="create_election.html"><button type="button" class="btn btn-info"> Create an election </button></a>
            <a href="new_voter_block.php"><button type="button" class="btn btn-info"> Add voter block to a election </button></a>
            <a href="new_subelection.php"><button type="button" class="btn btn-info"> Add sub-election to existing election </button></a>
            <a href="new_voters.php" ><button type="button" class="btn btn-info"> Add new voters to existing voter block </button></a>
        </div>

        <hr>

        <div class="container">
            <h2 class="display-4">List of elections</h2>
            <table class="table table-hover" style="border-collapse:collapse;">
                <thead align="center">
                  <tr>
                    <th></th>
                    <th scope="col"><strong>Election name</strong></th>
                    <th scope="col"><strong>Election Desription</strong></th>
                    <th scope="col"><strong>Election Ongoing?</strong></th>
                    <th colspan=2></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count=1;
                  $sel_query="Select * from election ORDER BY id desc;";
                  $result = mysqli_query($link,$sel_query);
                  while($row = mysqli_fetch_assoc($result)) { ?>

                    <td align="center">
                      <?php
                          if($row["enabled"] == 0){
                              echo '<a href="enable_election.php?id=' . $row["id"] . '"><i class="fas fa-toggle-off fa-lg"></i></a>';
                          } else {
                              echo '<a href="disable_election.php?id=' . $row["id"] . '"><i class="fas fa-toggle-on fa-lg" style="color: green;"></i></a>';
                          }
                      ?>
                    </td>
                    <td align="center"><?php print $row["name"]; ?></td>
                    <td align="center"><?php print $row["description"]; ?></td>

                    <?php
                        if($row["enabled"] == 0){
                            echo '<td align="center">Not Ongoing</td>';
                        }else{
                            echo '<td align="center">Ongoing</td>';
                        }
                    ?>

                    <td align="center">
                      <a href="election_detail.php?id= <?php print $row["id"]; ?> "><i class="fas fa-edit fa-lg"></i></a>
                    </td>
                  </tr>
                  <?php $count++; } ?>
                </tbody>
            </table>
        </div>
      </div>
    </main>




    <script type="text/javascript">
        $(document).ready(function(){
            $("tr:even").css( "background-color", "rgb(153, 153, 153)");
        });
    </script>
  </body>
</html>
