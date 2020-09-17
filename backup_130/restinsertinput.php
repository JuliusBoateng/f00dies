<html>
<body>
<form action="restinsertaction.php" method="get">
<?php

/* Connecting, selecting database */
$link = mysqli_connect('localhost', 'lsiela', 'lsiela')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'lsiela') or die('Could not select database');

if($stmt = mysqli_prepare($link, "SELECT name FROM users WHERE user_id = ?")) {
        mysqli_stmt_bind_param($stmt,'i',$_GET['user_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$name);
        while(mysqli_stmt_fetch($stmt)) {
                $cname = $name;
        }
	mysqli_stmt_close($stmt);
}

echo "You are logged in as " . $cname . ".<br>";


?>

Enter the restaurant name: <input type="textbox" name="name"><br>
Enter the restaurant location (building name; max length: 19 chars): <input type="textbox" name="location"><br>
Enter the Monday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="monh"><br>
Enter the Tuesday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="tueh"><br>
Enter the Wednesday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="wedh"><br>
Enter the Thursday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="thuh"><br>
Enter the Friday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="frih"><br>
Enter the Saturday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="sath"><br>
Enter the Sunday hours (form: [opening time]am/pm - [closing time]am/pm): <input type="textbox" name="sunh"><br>
Enter the restaurant id: <input type="textbox" name="id"><br><br>
<input type="submit" value="Submit">
<input type="hidden" name="user_id" value=<?php echo $_GET['user_id']; ?>>
</form>
</body>
</html>
