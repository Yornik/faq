<?php

session_start([
    'cookie_lifetime' => 86400,
]);

require_once('Database.php');
include('dbconnection.php');


$QAarray = $db->select('QA',"id != 0", 2000, 'category ASC')->result_array();

$questionErr = $answerErr = $categoryErr = '';
$passwordloginc= $namelogin = $questioninput = $answerinput =  $categoryinput = $addnameinput = $addpasswordinput = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namelogin = $db->escape(strip_input($_POST["namelogin"]));
    if(!empty($namelogin)){
        $passwordlogin = strip_input($_POST["passwordlogin"]);
    $Userarray = $db->select(Users2,"name = '$namelogin'", 1)->row();
    if(password_verify($passwordlogin, $Userarray->pass)) {
        $_SESSION['username'] = $namelogin;
        header('Refresh: 0');
    }
    else{
        echo "login failed";
    }}
}

function strip_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlentities($data);
return $data;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=70%, initial-scale=1">
  <title>FAQ Yornik Heyl</title>
  <link rel="stylesheet" href="jquery-ui.min.css">
  <script src="jquery-1.12.4.min.js"></script>
  <script src="jquery-ui.min.js"></script>
    <script>
        $( function() {
            $( "#accordion,#accordion-inner" ).accordion({
                collapsible: true,
                heightStyle: "content"
            });
        } );
    </script>
</head>
<body>

<div id="accordion">
    <?php
    if($_SESSION['username']) { ?>
<h3>Add an qestion and answer</h3>
<form method="post" action="addquestion.php" enctype="multipart/form-data">
Question:<textarea name="questioninput" rows="5" cols="40"><?php echo $questioninput;?></textarea>
<span class="error">* <?php echo $questionErr;?></span>
<br><br>
Answer:<textarea name="answerinput" rows="5" cols="40"><?php echo $answerinput;?></textarea>
<span class="error">* <?php echo $answerErr;?></span>
<br><br>
category: <input type="text" name="categoryinput" value=<?php echo $categoryinput;?>>
<span class="error">* <?php echo $categoryErr;?></span>
<br>
    Select media to upload: <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
<input type="submit" name="submit0" value="Submit">
</form>

<h3>Add an user</h3>
<form method="post" action="adduser.php">
    Name: <input type="text" name="addnameinput" ><br>
    Password: <input type="password" name="addpasswordinput"><br>
    <br>
    <input type="submit" name="submit1" value="Submit">
</form>
    <?php }else{ ?>
<h3>Login as a user</h3>
<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="namelogin" ><br>
    Password: <input type="password" name="passwordlogin"><br>
    <br>
    <input type="submit" name="submit2" value="Submit">

</form><?php }
    $addedCategory=array();
    foreach ($QAarray as $question){
	if(!in_array($question["category"],$addedCategory)){
	    if($addedCategory != null){
		    echo "</div> \n \n";
		}
		echo "<h3>{$question["category"]}</h3>";
		array_push($addedCategory, $question["category"]);
		echo "<div id=\"accordion-inner\"> \n";
	}
        echo "<h3>{$question["question"]}</h3> \n";
        echo "<div><P>{$question["answer"]}</P></div> \n";
    }
    ?>
</div>
</div>
<img src="Under_construction_graphic.gif" alt="Actually, this is the most annoying thing in the universe." >
<br>

<?php
if($_SESSION['username']) { ?>
<p><a href="logout.php" class="btn btn-danger">Sign Out</a></p>
<?php } ?>


</body>
</html>