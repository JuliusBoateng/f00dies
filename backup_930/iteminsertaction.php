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
echo "Connected successfully\n";

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
if ($stmt = mysqli_prepare($link, "INSERT INTO menuitems (name,rest_name,calories,category,price,allergen_1,allergen_2,allergen_3,allergen_4,allergen_5,allergen_6,allergen_7,allergen_8,allergen_9,allergen_10,simple_1,simple_2,simple_3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
	if(mysqli_stmt_bind_param($stmt, 'ssisdsssssssssssss', $_GET['mname'],$_GET['rest_name'],$_GET["cal"],$_GET["cat"],$_GET["price"],$_GET["a1"],$_GET["a2"],$_GET["a3"],$_GET["a4"],$_GET["a5"],$_GET["a6"],$_GET["a7"],$_GET["a8"],$_GET["a9"],$_GET["a10"],$_GET["s1"],$_GET["s2"],$_GET["s3"])) {
		echo "Binding OK.\n";
	} else {
		echo "Error binding params.\n";
	}
	if(mysqli_stmt_execute($stmt)) {
		echo "Data added Successfully.\n";
	} else {
		echo "Error adding data.\n";
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($link);
echo "<button type='submit' name='user_id' value='" . $_GET['user_id'] . "'>Back to main</button>";
echo "<button type='submit' formaction='iteminsertinput.php' name='user_id' value='" . $_GET['user_id'] . "'>Insert again</button>";
?>
</form>
</body>
</html>
