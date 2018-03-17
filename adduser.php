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
    );}
    elseif($db->select('Users2',"name = '$addnameinput'", 1)->count() == 0) {echo 'Username already exist';}
    else{echo "something went wrong rederecting to main page in 2 seconds";
    sleep(5);}
    header("location: index.php");
