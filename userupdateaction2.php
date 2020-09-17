<html>
<head>
<title>Updating Password</title>
</head>
<body>
<form action='main.php' method='get'>
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

/* get user_id
if($stmt = mysqli_prepare($link, "SELECT user_id FROM users WHERE username = ? and password = ?")) {
	mysqli_stmt_bind_param($stmt,'ss',$_GET['iusername'],crypt($_GET['ipassword'],'fu.8nwja$dlq'));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$user_id);
        while(mysqli_stmt_fetch($stmt)) {
                $newid = $user_id;
        }
	mysqli_stmt_close($stmt);
}

/* do change */
if ($stmt = mysqli_prepare($link, "UPDATE users SET password = ? WHERE user_id = ?")) {
	mysqli_stmt_bind_param($stmt, 'si', crypt($_GET['npassword'],'fu.8nwja$dlq'),$newid);
	if(mysqli_stmt_execute($stmt)) {
		echo "Data updated Successfully.";
	} else {
		echo "Error updating data.";
	}
	mysqli_stmt_close($stmt);
}	
mysqli_close($link);
echo "<button type='submit' name='user_id' value=" . $_GET['user_id'] . " method='get'>Go back</button><br>";
?>
</form>
</body>
</html>
