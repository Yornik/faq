<?php

session_start([
    'cookie_lifetime' => 86400,
]);

require_once('Database.php');

//reading the database (should make a install script so you can change the password and db/username.
$db = new Database(faqapp, faqapp, bmS7GXQPLaJrFvxgZMBM8TvJQXAN9dknK2R3RU4DSmYALT84sTz6aqsHqvJQS6efRVAFYs);
$QAarray = $db->select(QA,"id != 0", 200, 'category ASC')->result_array();


$questionErr = $answerErr = $categoryErr = '';
$questioninput = $answerinput =  $categoryinput = $addnameinput = $addpasswordinput = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["questioninput"])) {
        $questionErr = "question is required";
    } else {
        $questioninput = test_input($_POST["questioninput"]);
    }

    if (empty($_POST["answerinput"])) {
        $answerErr = "answer is required";
    } else {
        $answerinput = test_input($_POST["answerinput"]);
    }
    $categoryinput = intval($categoryinput);
    if (empty($_POST["categoryinput"])) {
        $categoryErr = "Category cant be zero or empty!";
    } else {
        $categoryinput = test_input($_POST["categoryinput"]);
    }

    if (!empty($answerinput) and !empty($questioninput) and !empty($_POST["categoryinput"])) {
        $db->insert(
            'QA',
            array(
                'question' => $questioninput,
                'answer' => $answerinput,
                'category' => $categoryinput
            )
        );
        header('Refresh: 0');
    }

    $addnameinput = test_input($_POST["addnameinput"]);
    $addpasswordinput = password_hash($_POST["addpasswordinput"], PASSWORD_DEFAULT);
    if (!empty($addnameinput) and !empty($addpasswordinput)){
        $db->insert(
            'Users2',
            array(
                'name' => $addnameinput,
                'pass' => $addpasswordinput
            )
        );
        header('Refresh: 0');
    }

    $namelogin = test_input($_POST["namelogin"]);
    $Userarray = $db->select(Users2,"name == $namelogin", 1)->result_array();
    if (password_verify($_POST["passwordlogin"], $Userarray["pass"])) {
        $_SESSION['username'] = $namelogin;
        header("location: welcome.php");
    }

}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
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
<h3>Add an entry</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Question:<textarea name="questioninput" rows="5" cols="40"><?php echo $questioninput;?></textarea>
<span class="error">* <?php echo $questionErr;?></span>
<br><br>
Answer:<textarea name="answerinput" rows="5" cols="40"><?php echo $answerinput;?></textarea>
<span class="error">* <?php echo $answerErr;?></span>
<br><br>
category: <input type="number" name="categoryinput" value="<?php echo $categoryinput;?>">
<span class="error">* <?php echo $categoryErr;?></span>
<br><br>
<input type="submit" name="submit0" value="Submit">
</form>

<h3>Add an user</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="addnameinput" ><br>
    Password: <input type="password" name="addpasswordinput"><br>
    <br>
    <input type="submit" name="submit1" value="Submit">
</form>

<h3>Login as a user</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="namelogin" ><br>
    Password: <input type="password" name="passwordlogin"><br>
    <br>
    <input type="submit" name="submit2" value="Submit">
</form>



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
        echo "<div><P>{$question["answer"]}</P></div> \n";
    }
    ?>
</div>
</div>
<img src="Under_construction_graphic.gif" alt="Actually, this is the most annoying thing in the universe." >


</body>
</html>