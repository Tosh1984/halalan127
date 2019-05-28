<?php
session_start();
$_SESSION["user-loggedin"] = NULL;
if(isset($_SESSION["user-loggedin"]) == false){
    echo "logout success!";
} else {
    echo "logout failure!";
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
