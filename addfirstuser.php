<?php
include('Database.php');
include('dbconnection.php');

//if there is already a user in the user db dont run this script.
if(!$db->select('Users2',"id != 0", 100)->count()){ ?>
<h3>Add an user</h3>
<form method="post" action="adduser.php">
    Name: <input type="text" name="addnameinput" ><br>
    Password: <input type="password" name="addpasswordinput"><br>
    <br>
    <input class="ui-button ui-widget ui-corner-all" type="submit" name="submit1" value="Submit">
</form>

<?php } else {
    header("Refresh:3;URL=index.php");
    echo "You should not be here right now!";
} ?>


