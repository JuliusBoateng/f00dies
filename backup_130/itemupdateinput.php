<html>
<body>
    <form action="itemupdateaction.php" method="get">
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

    Enter the restaurant name: <input type="textbox" name="location"><br>
    Enter the item name: <input type="textbox" name="name"><br>

    Enter the attribute to update: <select name = "update_select">
      <option value="price">Price</option>
      <option value="calories">Calories</option>
      <!-- <option value="saab">Saab</option>
      <option value="mercedes">Mecedes</option>
      <option value="audi">Audi</option> -->
    </select>

    <br>
    Enter the updated value: <input type="textbox" name="update_input"><br>
    <input type="submit" value="Submit">
<input type="hidden" name="user_id" value=<?php echo $_GET['user_id']; ?>>
</form>
</body>
</html>
