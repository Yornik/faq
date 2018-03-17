<?php
include('Database.php');
include('dbconnection.php');

if (empty($_POST["questioninput"])) {
    $questionErr = "question is required";
} else {
    $questioninput = $db->strip_input($_POST["questioninput"]);
}

if (empty($_POST["answerinput"])) {
    $answerErr = "answer is required";
} else {
    $answerinput = $db->strip_input($_POST["answerinput"]);
}

if (empty($_POST["categoryinput"])) {
    $categoryErr = "Category cant be empty!";
} else {
    $categoryinput = $db->strip_input($_POST["categoryinput"]);
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$MediaFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($MediaFileType != "jpg" && $MediaFileType != "png" && $MediaFileType != "jpeg"
    && $MediaFileType != "gif" && $MediaFileType != "mp4") {
    echo "Sorry, only JPG, JPEG, PNG & GIF, MP4 files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo"file uplouded";
    }
}

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
