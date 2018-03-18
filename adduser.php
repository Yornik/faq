<?php
include('Database.php');
include('dbconnection.php');

$addnameinput = $db->escape($db->strip_input($_POST["addnameinput"]));
$addpasswordinput = password_hash($_POST["addpasswordinput"], PASSWORD_DEFAULT);
if (!empty($addnameinput) and !empty($addpasswordinput) and ($db->select('Users2',"name = '$addnameinput'", 1)->count() == 0)){
    $db->insert(
        'Users2',
        array(
            'name' => $addnameinput,
            'pass' => $addpasswordinput
        )
    );
    header("Refresh:0;URL=index.php");}
    elseif($db->select('Users2',"name = '$addnameinput'", 1)->count()) {
    header("Refresh:3;URL=index.php");
    echo 'Username already exist, You are redirected in 5 sec.';
    }
    else{
header("Refresh:3;URL=index.php");
echo "non valid input, You are redirected in 5 sec.";}
