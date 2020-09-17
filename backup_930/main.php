<html>
    <head>
        <title>f00dies | Main</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    </head>
    <body>
        <!-- <div class="title1">f00dies</div>
        <div class="title2">Julius Boateng, Luke Siela, Blaise Von Ohlen, Brendan Raimann</div>
        <div class="navbar">
            <div class="tab active" id="1"><div style="display: table-cell; vertical-align: middle">Player Stats</div></div>
            <div class="tab" id="2"><div style="display: table-cell; vertical-align: middle">Team Stats</div></div>
            <div class="tab" id="3"><div style="display: table-cell; vertical-align: middle">Shooting Stats</div></div>
            <div class="tab" id="4"><div style="display: table-cell; vertical-align: middle">Best Points / Season</div></div>
            <div class="tab" id="5"><div style="display: table-cell; vertical-align: middle">Advanced Stats</div></div>
            <div class="tab" id="6"><div style="display: table-cell; vertical-align: middle">Best Points / Career</div></div>
            <div class="tab" id="7"><div style="display: table-cell; vertical-align: middle">Single Year Stats</div></div>
        </div> -->
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
echo "
	<a href='restqueryinput.php?user_id=" . $_GET['user_id'] . "'>Search for restaurant</a> <br>
        <a href='restinsertinput.php?user_id=" . $_GET['user_id'] . "'>Input a restaurant into the database</a> <br>
	<a href='restdeleteinput.php?user_id=" . $_GET['user_id'] . "'>Delete a restaurant from the database</a> <br><br>
        <a href='iteminsertinput.php?user_id=" . $_GET['user_id'] . "'>Input a menu item into the database</a><br>
        <a href='itemupdateinput.php?user_id=" . $_GET['user_id'] . "'>Update price of a menu item</a><br><br>
        <a href='userupdateinput1.php?user_id=" . $_GET['user_id'] . "'>Update username</a><br>
	<a href='userupdateinput2.php?user_id=" . $_GET['user_id'] . "'>Update password</a><br>
	<a href='index.html'>Log out</a><br>"
	/*
	<a href='itemdeleteinput.php?user_id=" . $_GET['user_id'] . "'>Delete a menu item from the database</a><br><br>
        <a href='itemqueryinput.php?user_id=" . $_GET['user_id'] . "'>Search for a menu item</a><br>
	 */

?>
    </body>
</html>
