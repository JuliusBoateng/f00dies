<html>
<body>
<form action="ratinginsertaction.php" method="get">
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

echo "You are logged in as " . $cname . ".<br><br>";

echo $_GET['user_id'] . "<br>" . $_GET['item_name'] . "<br>" . $_GET['rest_name'] . "<br>";

?>

Enter the rating: <input type="textbox" name="rating"><br>
<input type="submit" value="Submit">
<input type="hidden" name="user_id" value=<?php echo $_GET['user_id']; ?>>
<input type="hidden" name="item_name" value=<?php echo "'" . $_GET['item_name'] . "'"; ?>>
<input type="hidden" name="rest_name" value=<?php echo "'" . $_GET['rest_name'] . "'" ;?>>
</form>
</body>
</html>
