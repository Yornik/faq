<?php
include('Database.php');
include('dbconnection.php');

$db->delete(QA, array(
    id => $_POST["id"]));
header("Refresh:0;URL=index.php");