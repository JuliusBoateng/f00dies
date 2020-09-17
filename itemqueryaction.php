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

/* make room for more query types here */
if($_GET["name"] == NULL) {
	$query = "SELECT * FROM menuitems WHERE rest_name = ?";
	$querytype = 0;
} else if($_GET["rest_name"] == NULL) {
	$query = "SELECT * FROM menuitems WHERE name = ?";
	$querytype = 1;
} else {
	$query = "SELECT * FROM menuitems WHERE rest_name = ? and name = ?";
	$querytype = 2;
}

/* do query */
if ($stmt = mysqli_prepare($link, $query)) {

		switch($querytype) {
		case 0:
			mysqli_stmt_bind_param($stmt, 's', $_GET['rest_name']);
			break;
		case 1:
			mysqli_stmt_bind_param($stmt, 's', $_GET['name']);
			break;
		case 2:
			mysqli_stmt_bind_param($stmt, 'ss', $_GET['rest_name'], $_GET['name']);
			break;

		}
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6,
			$col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15,
			$col16, $col17, $col18)) {
			//echo "Bound\n";
		}
		echo "<table>\n";
		while($ret1 = mysqli_stmt_fetch($stmt)) {
 			echo "\t<tr>\n";
			echo "\t\t<td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td>
				<td>$col5</td><td>$col6</td><td>$col7</td><td>$col8</td>
				<td>$col9</td><td>$col10</td><td>$col11</td><td>$col12</td>
				<td>$col13</td><td>$col14</td><td>$col15</td><td>$col16</td>
				<td>$col17</td><td>$col18</td>\n";
 			echo "\t</tr>\n";
		}
		echo "</table>\n";
 		mysqli_stmt_close($stmt);
	}
mysqli_close($link);
echo "<button type='submit' name='user_id' value='" . $_GET['user_id'] . "'>Back to main</button>";
echo "<button type='submit' formaction='itemqueryinput.php' name='user_id' value='" . $_GET['user_id'] . "'>Search again</button>";
?>
</form>
</body>
</html>
