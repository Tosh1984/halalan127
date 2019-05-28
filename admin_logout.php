<?php
session_start();
$_SESSION["admin-loggedin"] = NULL;
if(isset($_SESSION["admin-loggedin"]) == false){
    echo "logout success!";
} else {
    echo "logout failure!";
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
