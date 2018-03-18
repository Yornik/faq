<?php
include('Database.php');
include('dbconnection.php');

//testing if a field are filled in and strip them from ugly stuff

if (empty($_POST["questioninput"])) {
    header("Refresh:3;URL=index.php");
    echo 'no question received, You are redirected in 5 sec.';
    exit;
} else {
    $questioninput = $db->strip_input($_POST["questioninput"]);
}

if (empty($_POST["answerinput"])) {
    header("Refresh:3;URL=index.php");
    echo 'no answer received, You are redirected in 5 sec.';
    exit;
} else {
    $answerinput = $db->strip_input($_POST["answerinput"]);
}

if (empty($_POST["categoryinput"])) {
    header("Refresh:3;URL=index.php");
    echo 'no category received, You are redirected in 5 sec.';
    exit;
} else {
    $categoryinput = $db->strip_input($_POST["categoryinput"]);
}

//only do these test when there is a file to process
if(basename($_FILES["fileToUpload"]["name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $MediaFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if file already exists
    if (file_exists($target_file)) {
        header("Refresh:3;URL=index.php");
        echo "Sorry, file already exists, You are redirected in 5 sec.";
        exit;
    }
// Allow certain file formats
    if ($MediaFileType != "jpg" && $MediaFileType != "png" && $MediaFileType != "jpeg"
        && $MediaFileType != "gif" && $MediaFileType != "mp4") {
        header("Refresh:3;URL=index.php");
        echo "Sorry, only JPG, JPEG, PNG & GIF, MP4 files are allowed. You are redirected in 5 sec";
        exit;
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "file uploud complete";
        }else {
        header("Refresh:3;URL=index.php");
        echo "Sorry, file is not uplouded, You are redirected in 5 sec.";
        exit;}
}

//add everything to the database

if (!empty($answerinput) and !empty($questioninput) and !empty($_POST["categoryinput"])) {
    $db->insert(
        'QA',
        array(
            'question' => $questioninput,
            'answer' => $answerinput,
            'category' => $categoryinput,
            'media'   => $target_file
        )
    );}
    header("location: index.php");
