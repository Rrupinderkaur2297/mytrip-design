<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ".BASEURL."/Authentication/Login.php");
    exit;
}
?>
