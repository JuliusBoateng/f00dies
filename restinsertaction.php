<html>
<head>
<title>Restaurants</title>
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

/* insert */
if ($stmt = mysqli_prepare($link, "INSERT INTO restaurants (name,location,mon,tues,wed,thurs,fri,sat,sun,id) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
	mysqli_stmt_bind_param($stmt, 'sssssssssi', $_GET["name"],$_GET["location"],$_GET["monh"],$_GET["tueh"],$_GET["wedh"],$_GET["thuh"],$_GET["frih"],$_GET["sath"],$_GET["sunh"],$_GET["id"]);
	if(mysqli_stmt_execute($stmt)) {
		echo "Data added Successfully.";
	} else {
		echo "Error adding data.";
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($link);
echo "<button type='submit' name='user_id' value='" . $_GET['user_id'] . "'>Back to main</button>";
echo "<button type='submit' formaction='restinsertinput.php' name='user_id' value='" . $_GET['user_id'] . "'>Insert again</button>";
?>
</form>
</body>
</html>
