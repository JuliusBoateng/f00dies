<!-- ****userinsertaction.php**** -->
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
<?php

/* Connecting, selecting database */
$link = mysqli_connect('localhost', 'lsiela', 'lsiela')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'lsiela') or die('Could not select database');

/* get highest user_id number to calculate value for new */
if($stmt = mysqli_prepare($link, "SELECT user_id FROM users ORDER BY user_id desc LIMIT 1")) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$previd);
	if(mysqli_stmt_fetch($stmt)) {
		$newid = $previd + 1;
		//echo $previd . "<br>" . $newid . "<br>";
	}
	mysqli_stmt_close($stmt);
}

/* do action */
if ($stmt = mysqli_prepare($link, "INSERT INTO users (user_id,username,name,password) VALUES (?,?,?,?)")) {
	mysqli_stmt_bind_param($stmt, 'isss', 
		$newid,$_GET["iusername"],$_GET["iname"],crypt($_GET["ipassword"],'fu.8nwja$dlq'));
	if(mysqli_stmt_execute($stmt)) {
		?>
			<h1>Account Created Successfully!</h1>
			<br>
			<h2>Click here to login:</h2>
			<a href='userqueryinput.php'>Login</a>

		<?php
	} else {
		echo "Error adding data.";
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>
</div>
</body>
</html>
