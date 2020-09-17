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
	<a href='index.html'>Log out</a><br>";
	/*
	<a href='itemdeleteinput.php?user_id=" . $_GET['user_id'] . "'>Delete a menu item from the database</a><br><br>
        <a href='itemqueryinput.php?user_id=" . $_GET['user_id'] . "'>Search for a menu item</a><br>
	 */
	
/*
if ($result = mysqli_query("SELECT menuitems.simple_1, menuitems.simple_2, menuitems.simple_3
	FROM
		(SELECT ratings.item_name, ratings.rest_name
		FROM ratings
		WHERE ratings.user_id = " . $_GET['user_id'] . " and ratings.rating = 5) A, menuitems
	WHERE A.item_name = menuitems.name and A.rest_name = menuitems.rest_name")) {
		echo "here!";
		if(!empty($result)) {
			while($colarr = mysql_fetch_array($result)) {
				if(!empty($colarr[0])) {
					$query = $query . " menuitems.simple_1 = '$icol1' or menuitems.simple_2 = '$icol1' or menuitems.simple_3 = '$icol1'";
					if($icol2 || $icol3) {
                                		$query = $query . " or";
                        		}
				}
				if(!empty($colarr[0])) {
                                        $query = $query . " menuitems.simple_1 = '$icol1' or menuitems.simple_2 = '$icol1' or menuitems.simple_3 = '$
                                        if($icol2 || $icol3) {
                                                $query = $query . " or";
                                        }
                                }
				if(!empty($colarr[0])) {
                                        $query = $query . " menuitems.simple_1 = '$icol1' or menuitems.simple_2 = '$icol1' or menuitems.simple_3 = '$
                                        if($icol2 || $icol3) {
                                                $query = $query . " or";
                                        }
                                }
			}
	while(mysqli_stmt_fetch($stmt)) {
		//echo "$icol1; $icol2; $icol3<br>";
		$query = "SELECT menuitems.* FROM menuitems WHERE";
		if(!empty($icol1)) {
			$query = $query . " menuitems.simple_1 = '$icol1' or menuitems.simple_2 = '$icol1' or menuitems.simple_3 = '$icol1'";
			if($icol2 || $icol3) {
				$query = $query . " or";
			}
		}
		if(!empty($icol2)) {
			$query = $query . " menuitems.simple_1 = '$icol2' or menuitems.simple_2 = '$icol2' or menuitems.simple_3 = '$icol2'";
			if($icol3) {
				$query = $query . " or";
			}
		}
		if(!empty($icol3)) {
			$query = $query . " menuitems.simple_1 = '$icol3' or menuitems.simple_2 = '$icol3' or menuitems.simple_3 = '$icol3'";

		}
		$query = "\"$query\"";
		echo "$query<br>";
		if($stmtbig = mysqli_prepare($link, $query)) {
			echo "prepared big<br>";
			if(mysqli_stmt_execute($stmtbig)) {
			}
			if(mysqli_stmt_bind_result($stmtbig, $col1, $col2, $col3, $col4,
				$col5, $col6, $col7, $col8, $col9, $col10, $col11,
			       	$col12, $col13, $col14, $col15, $col16, $col17, $col18, $col19)) {
			}
        		echo "<table>";
        		while ($ret1 = mysqli_stmt_fetch($stmtbig)) {
                		echo "<tr>";
                			echo "<td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td>
                                		<td>$col5</td><td>$col6</td><td>$col7</td><td>$col8</td>
                                		<td>$col9</td><td>$col10</td><td>$col11</td><td>$col12</td>
                                		<td>$col13</td><td>$col14</td><td>$col15</td><td>$col16</td>
                                		<td>$col17</td><td>$col18</td><td>$col19</td>";
                		echo "</tr>";
        		}
			echo "</table>";
			mysqli_stmt_close($stmtbig);
		}
	}
	mysqli_stmt_close($stmt);
	}
 */

if ($result = mysqli_query("SELECT DISTINCT menuitems.*
	FROM
		(SELECT menuitems.simple_1, menuitems.simple_2, menuitems.simple_3
		FROM
			(SELECT ratings.item_name, ratings.rest_name
			FROM ratings
			WHERE ratings.user_id = ? and ratings.rating = 5) A, menuitems
		WHERE A.item_name = menuitems.name and A.rest_name = menuitems.rest_name) B, menuitems
	WHERE")) {





echo "this should be here";
 
?>
    </body>
</html>
