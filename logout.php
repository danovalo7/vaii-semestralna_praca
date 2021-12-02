<?php
session_start();
$_SESSION["logged_in"] = false;
$_SESSION["user_id"] = null;
$_SESSION["user_name"] = null;
header("location: index.php");
