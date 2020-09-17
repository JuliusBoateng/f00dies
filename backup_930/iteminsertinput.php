<html>
<body>
<form action="iteminsertaction.php" method="get">
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

Enter the restaurant name: (max length: 19 chars): <input type="textbox" name="rest_name"><br>
Enter the menu item name: (max length: 19 chars): <input type="textbox" name="mname"><br>
Enter allergen 1: <input type="textbox" name="a1"><br>
Enter allergen 2 (if applicable): <input type="textbox" name="a2"><br>
Enter allergen 3 (if applicable): <input type="textbox" name="a3"><br>
Enter allergen 4 (if applicable): <input type="textbox" name="a4"><br>
Enter allergen 5 (if applicable): <input type="textbox" name="a5"><br>
Enter allergen 6 (if applicable): <input type="textbox" name="a6"><br>
Enter allergen 7 (if applicable): <input type="textbox" name="a7"><br>
Enter allergen 8 (if applicable): <input type="textbox" name="a8"><br>
Enter allergen 9 (if applicable): <input type="textbox" name="a9"><br>
Enter allergen 10 (if applicable): <input type="textbox" name="a10"><br>
Enter a simple name: <input type="textbox" name="s1"><br>
Enter a second simple name (if applicable): <input type="textbox" name="s2"><br>
Enter a third simple name (if applicable): <input type="textbox" name="s3"><br>
Enter the category (max length: 19 chars): <input type="textbox" name="cat"><br>
Enter the calorie amount: <input type="textbox" name="cal"><br>
Enter the price: <input type="textbox" name="price"><br>
<input type="submit" value="Submit">
<input type="hidden" name="user_id" value=<?php echo $_GET['user_id']; ?>>
</form>
</body>
</html>
