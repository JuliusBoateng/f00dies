****netid.php****

<html>
<head>
<title>Restaurants</title>
</head>
<body>
<p> Here is the restaurant data: </p>
<?php
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lsiela', 'lsiela')
 or die('Could not connect: ' . mysql_error());
echo 'Connected successfully';
mysqli_select_db($link, 'lsiela') or die('Could not select database');
// Performing SQL query
$query = 'SELECT * FROM restaurants';
$result = mysqli_query($link, $query) or die('Query failed: ' . mysql_error());
// Printing results in HTML
echo "<table>\n";
while ($tuple = mysqli_fetch_array($result, MYSQL_ASSOC)) {
 echo "\t<tr>\n";
 foreach ($tuple as $col_value) {
 echo "\t\t<td>$col_value</td>\n";
 }
 echo "\t</tr>\n";
}
echo "</table>\n";
// Free resultset
mysqli_free_result($result);
// Closing connection
mysqli_close($link);
?>
</body>
</html>
