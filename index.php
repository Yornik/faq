<?php
require_once('Database.php');

$db = new Database(faqapp, faqapp, bmS7GXQPLaJrFvxgZMBM8TvJQXAN9dknK2R3RU4DSmYALT84sTz6aqsHqvJQS6efRVAFYs);
$QAarray = $db->select(QA,"id != 0", 200, 'category ASC')->result_array();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ Yornik Heyl</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
</body>
</html>