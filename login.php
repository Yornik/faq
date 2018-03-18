<?php
include('Database.php');
include('dbconnection.php');
session_start();

$namelogin = $db->escape($db->strip_input($_POST["namelogin"]));
if(!empty($namelogin)){
    $passwordlogin = $db->strip_input($_POST["passwordlogin"]);
    $Userarray = $db->select(Users2,"name = '$namelogin'", 1)->row();
    if(password_verify($passwordlogin, $Userarray->pass)) {
        $_SESSION['username'] = $namelogin;
        header("Refresh:0;URL=index.php");
    }
    else{header("Refresh:3;URL=index.php");
    echo "Sorry, could not login , You are redirected in 5 sec.";}}else{
    header("Refresh:3;URL=index.php");
    echo "Sorry, could not login , You are redirected in 5 sec.";}