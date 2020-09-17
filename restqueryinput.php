<html>
	<head>
        <title>f00dies | Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    </head>
<body>
<div class="title1">f00dies</div>
<div class="title2">Julius Boateng, Luke Siela, Blaise Von Ohlen, Brendan Raimann</div>
<div class="items-container">
<form action="restqueryaction.php" method="get">
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
<br>
<p>Search by restaurant, building</p>
Search: <input type="textbox" name="name"><br>
<!--Search by building: <input type="textbox" name="building"><br><br>-->
<input type="hidden" name="user_id" value=<?php echo $_GET['user_id']; ?>>
<input type="submit" value="Submit">
</form>
</div>
</body>
</html>
