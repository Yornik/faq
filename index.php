<?php

session_start([
    'cookie_lifetime' => 86400,
]);

require_once('Database.php');
include('dbconnection.php');

// getting data form the database for the main view
$QAarray = $db->select('QA',"id != 0", 2000, 'category ASC')->result_array();

// Make sure that all the forms are empty
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
// show a login if there is no username known to the php session.
if(!$_SESSION['username']) { ?>
<form align="right" method="post" action="login.php">
    Name: <input type="text" name="namelogin" >
    Password: <input type="password" name="passwordlogin">
    <input class="ui-button ui-widget ui-corner-all" type="submit" name="submit2" value="Login">
</form>
<?php } ?>
<div id="accordion">
    <?php
    //If there is a username make it possible to add questions, users and media THIS IS NOT SAFE
    if($_SESSION['username']) { ?>
<h3>Add an qestion and answer</h3>
<form method="post" action="addquestion.php" enctype="multipart/form-data">
Question:<textarea name="questioninput" rows="5" cols="40"><?php echo $questioninput;?></textarea>
<span class="error">*</span>
<br><br>
Answer:<textarea name="answerinput" rows="5" cols="40"><?php echo $answerinput;?></textarea>
<span class="error">*</span>
<br><br>
category: <input type="text" name="categoryinput" value=<?php echo $categoryinput;?>>
<span class="error">*</span>
<br>
    Select media to upload: <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
<input class="ui-button ui-widget ui-corner-all" type="submit" name="submit0" value="Submit">
</form>

<h3>Add an user</h3>
<form method="post" action="adduser.php">
    Name: <input type="text" name="addnameinput" ><br>
    Password: <input type="password" name="addpasswordinput"><br>
    <br>
    <input class="ui-button ui-widget ui-corner-all" type="submit" name="submit1" value="Submit">
</form>
    <?php } ?>
<?php
    $addedCategory=array();
    foreach ($QAarray as $question){
        //make a outer div if the category is not already added to the page
	if(!in_array($question["category"],$addedCategory)){
	    //making sure to close the div after the first category
	    if($addedCategory != null){
		    echo "</div> \n \n";
		}
		echo "<h3>{$question["category"]}</h3>";
		array_push($addedCategory, $question["category"]);
		echo "<div id=\"accordion-inner\"> \n";
	}
	//show the questions and answers
        echo "<h3>{$question["question"]}</h3> \n";
        echo "<div><P>{$question["answer"]}";
        //if there is media file display it as video if mp4 and as image if it is a image.
        if($question["media"]){
            if(strtolower(pathinfo($question["media"],PATHINFO_EXTENSION))== 'mp4'){
                echo"<br> <video width=\"420\" controls>";
                echo" <source src={$question["media"]} type=\"video/mp4\">";
                echo" </video>";
            }else{
                echo"<br> <img src={$question["media"]} width=\"720\"} >";
            }
        }
        //add a remove button if user is logged in THIS IS NOT SECURE anybody could send a header too deleteqestion.php
if($_SESSION['username']) {
    echo "<form action=\"Deletequestion.php\" method=\"post\">";
    echo "<input id=\"id\" name=\"id\" type=\"hidden\" value=\"{$question["id"]}\">";
    echo "<input class=\"ui-button ui-widget ui-corner-all\" type=\"submit\" name=\"Delete\" value=\"DELETE\" />";
    echo "</form>";}
    echo "</P></div> \n";

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