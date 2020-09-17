<!-- ****userqueryaction.php**** -->
<html>
<head>
	<head>
        <title>f00dies | Signing In</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    </head>
</head>
<body>
<div class="title1">f00dies</div>
<div class="title2">Julius Boateng, Luke Siela, Blaise Von Ohlen, Brendan Raimann</div>
<div class="items-container">
<form action='userqueryinput.php' method='get'>
<?php

/* Connecting, selecting database */
$link = mysqli_connect('localhost', 'lsiela', 'lsiela')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'lsiela') or die('Could not select database');

/* check if entered */
if($_GET["iusername"] == NULL or $_GET["ipassword"] == NULL) {
	$logininfo = 'Login failed: all fields must be filled.<br>';
	$action = 'Go Back';
	$nextplace = 'userqueryinput.php';
	$ruser_id = 0;

/* do query */
} else if ($stmt = mysqli_prepare($link, "SELECT user_id FROM users WHERE username = ? and password = ?")) {
	mysqli_stmt_bind_param($stmt, 'ss', $_GET["iusername"], crypt($_GET["ipassword"],'fu.8nwja$dlq'));
        mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $ruser_id);
	mysqli_stmt_fetch($stmt);
	//echo $ruser_id;
	if(!empty($ruser_id)) {
		?>
		<h3>Signing in...</h3>
		<img class="loading" src="loading.svg">
		<script type="text/javascript">
			setTimeout(function(){ $("button").click(); }, 500);
		</script>
		<?php
		$logininfo = 'Login successful!<br>';
		$action = 'Continue';
		$nextplace = 'main.php';
	} else {
		?>
		<h3>Login Failed, Going back...</h3>
		<!-- <img class="loading" src="loading.svg"> -->
		<script type="text/javascript">
			setTimeout(function(){ $("button").click(); }, 1500);
		</script>
		<?php
		$logininfo = 'Login failed!<br>';
		$action = 'Go Back';
		$nextplace = 'userqueryinput.php';

	}
       	mysqli_stmt_close($stmt);
}
mysqli_close($link);

/* go to main menu with login saved */
if(empty($ruser_id)) {
	echo "<button style='display: none' type='submit' formaction=\"" . $nextplace . "\">" . $action . "</button><br>";
} else {
	echo "<button type='submit' style='display: none' formaction=\"" . $nextplace . "\" name='user_id' value=" . $ruser_id . " method='get'>" . $action . "</button><br>";	
}
?>
</form>
</div>
</body>
</html>
