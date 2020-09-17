<html>
	<head>
        <title>f00dies | Results</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    </head>
<body>
<div class="title1">f00dies</div>
<div class="title2">Julius Boateng, Luke Siela, Blaise Von Ohlen, Brendan Raimann</div>
<form action='main.php' method='get'>
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
<div class="account_name">Logged in as: <?php echo "'" . $cname . "'"; ?></div>
<div class="items-container">
<?php
/* allow for loose searchability */
$name = "%" . $_GET["name"] . "%";

/* do query for rated items */
if ($stmt = mysqli_prepare($link, "SELECT DISTINCT menuitems.*, ratings.rating FROM menuitems, restaurants, ratings WHERE menuitems.rest_name = restaurants.name and ratings.user_id = ? and ratings.item_name = menuitems.name and ratings.rest_name = restaurants.name and (restaurants.location like ? or restaurants.name like ? or menuitems.name like ? or menuitems.simple_1 like ? or menuitems.simple_2 like ? or menuitems.simple_3 like ?) order by menuitems.rest_name")) {
	//echo "here!";
	if(mysqli_stmt_bind_param($stmt, 'issssss', $_GET['user_id'], $name, $name, $name, $name, $name, $name)) {
		//echo "bound params<br>";
	}
	if(mysqli_stmt_execute($stmt)) {
		//echo "executed<br>";
	}
	if(mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6,
		$col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15,
		$col16, $col17, $col18, $col19)) {
		//echo "bound result<br>";
	}
        echo "<table class='table table-striped table-sm'>";
        ?>
			<tr>
			<th scope="col">Food</th>
			<th scope="col">Restaurant</th>
			<th scope="col">Calories</th>
			<th scope="col">Category</th>
			<th scope="col">Price</th>
			<th scope="col">Allergens</th>
			<th scope="col">Basic Ingredients</th>
			<th scope="col" style="padding: 10 60 0 60;">Rate</th>
			</tr>

        <?php
        while ($ret1 = mysqli_stmt_fetch($stmt)) {
        	echo "<tr>";
		echo "<td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td>
				<td>$col5</td><td>$col6 $col7 $col8 $col9 $col10 $col11 $col12 $col13 $col14 $col15</td><td>$col16 $col17 $col18</td><td>$col19</td>";
                echo "</tr>";
       	}
        //echo "</table>";
       	mysqli_stmt_close($stmt);
}

/* do query for unrated items */
if ($stmt = mysqli_prepare($link, "SELECT DISTINCT menuitems.* FROM menuitems, restaurants WHERE menuitems.rest_name = restaurants.name and (restaurants.location like ? or restaurants.name like ? or menuitems.name like ? or menuitems.simple_1 like ? or menuitems.simple_2 like ? or menuitems.simple_3 like ?) order by menuitems.rest_name")) {
        //echo "here!";
        if(mysqli_stmt_bind_param($stmt, 'ssssss', $name, $name, $name, $name, $name, $name)) {
                //echo "bound params<br>";
        }
	if(mysqli_stmt_execute($stmt)) {
                //echo "executed<br>";
        }
	if(mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6,
                $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14, $col15,
                $col16, $col17, $col18)) {
                //echo "bound result<br>";
        }
	//echo "<table>";
	while ($ret1 = mysqli_stmt_fetch($stmt)) {
		if($stmt2 = mysqli_prepare($link, "SELECT rating FROM ratings WHERE user_id = ? and item_name = ? and rest_name = ?")) {
			echo "here!<br>";
			mysqli_stmt_bind_param($stmt2, 'iss', $_GET['user_id'], $col1, $col2);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_bind_result($stmt2, $trate);
			mysqli_stmt_fetch($stmt2);
			$erate = $trate;
			mysqli_stmt_close($stmt2);
		}
		if(empty($trate)) {
                	echo "<tr>";
                	echo "<td>$col1</td><td>$col2</td><td>$col3</td><td>$col4</td>
                                <td>$col5</td><td>$col6 $col7 $col8 $col9 $col10 $col11 $col12 $col13 $col14 $col15</td><td>$col16 $col17 $col18</td><td><a href='ratinginsertinput.php?user_id=" . $_GET['user_id'] . "&item_name=$col1&rest_name=$col2'>insert rating</a></td>";
			echo "</tr>";
		}
        }
	echo "</table>";
        mysqli_stmt_close($stmt);
}
mysqli_close($link);

echo "<button type='submit' name='user_id' value='" . $_GET['user_id'] . "'>Back to main</button>";
echo "<button type='submit' formaction='restqueryinput.php' name='user_id' value='" . $_GET['user_id'] . "'>Search again</button>";
?>
</form>
</div>
</body>
</html>
