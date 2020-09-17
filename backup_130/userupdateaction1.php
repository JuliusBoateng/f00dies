<html>
<head>
<title>f00dies | Success</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
</head>
<body>
<div class="title1">f00dies</div>
    <div class="title2">Julius Boateng, Luke Siela, Blaise Von Ohlen, Brendan Raimann</div>
<form action='userupdateinput1.php' method='get'>
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
?>
<div class="account_name">Logged in as: <?php echo $cname ?></div>
<div class="items-container">
<?php
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
if ($stmt = mysqli_prepare($link, "UPDATE users SET username = ? WHERE user_id = ?")) {
	mysqli_stmt_bind_param($stmt, 'si',$_GET["nusername"],$_GET['user_id']);
	if(mysqli_stmt_execute($stmt)) {
		echo "Data updated Successfully.";
	} else {
		echo "Error updating data.";
	}
	mysqli_stmt_close($stmt);
}	
mysqli_close($link);
echo "<br><br><button type='submit' formaction='main.php' name='user_id' value=" . $_GET['user_id'] . " method='get'>Go back</button><br>";
?>
</form>
</div>
</body>
</html>
