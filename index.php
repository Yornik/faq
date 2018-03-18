<?php

session_start([
    'cookie_lifetime' => 86400,
]);

require_once('Database.php');
include('dbconnection.php');


$QAarray = $db->select('QA',"id != 0", 2000, 'category ASC')->result_array();

$questionErr = $answerErr = $categoryErr = '';
$passwordloginc= $namelogin = $questioninput = $answerinput =  $categoryinput = $addnameinput = $addpasswordinput = '';

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
<?php
if(!$_SESSION['username']) { ?>
<form method="post" action="login.php">
    Name: <input type="text" name="namelogin" >
    Password: <input type="password" name="passwordlogin">
    <input type="submit" name="submit2" value="Login">
</form>
<?php } ?>
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
    <?php } ?>
<?php
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
        echo "<div><P>{$question["answer"]}";
        if($question["media"]){
            if(strtolower(pathinfo($question["media"],PATHINFO_EXTENSION))== 'mp4'){
                echo"<br> <video width=\"600\" controls>";
                echo" <source src={$question["media"]} type=\"video/mp4\">";
                echo" </video>";
            }else{
                echo"<br> <img src={$question["media"]} >";
            }
        }
        echo"</P></div> \n";
    }
    ?>
</div>
</div>

<?php
if($_SESSION['username']) { ?>
<p><a href="logout.php" class="btn btn-danger">Sign Out</a></p>
<?php } ?>


</body>
</html>