<html>
<head>
<title>Menu Items</title>
</head>
<body>
<form action='main.php' method='get'>
<?php

/* Connecting, selecting database */
$link = mysqli_connect('localhost', 'lsiela', 'lsiela')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'lsiela') or die('Could not select database');

/* display login info */
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

/* delete */
if ($stmt = mysqli_prepare($link, "DELETE FROM restaurants WHERE name = ? and rest_name = ?")) {
	mysqli_stmt_bind_param($stmt, 'ss', $_GET["name"],$GET["rest_name"]);
	if(mysqli_stmt_execute($stmt)) {
		echo "Data deleted Successfully.";
	} else {
		echo "Error deleting data.";
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($link);
echo "<button type='submit' name='user_id' value='" . $_GET['user_id'] . "'>Back to main</button>";
echo "<button type='submit' formaction='restdeleteinput.php' name='user_id' value='" . $_GET['user_id'] . "'>Delete again</button>";
?>
</form>
</body>
</html>
