<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Projekt</title>
	
	<link rel="stylesheet" href="style.css">

</head>
	
<body>

<div class="baner"><h1>Biblioteka</h1></div>
<div class="lewy">
<a href="main.php">Powrót do strony głównej</a></br>
</div>

<div class="prawy">
<?php
	
	$search = $_POST['list'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="Biblioteka";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	$result = mysqli_query($conn,"SELECT * FROM autorzy");

		echo "<table border='1'>
		<tr>
		<th>Imie</th>
		<th>Nazwisko</th>
		</tr>";

		while($row = mysqli_fetch_array($result))
		{
		echo "<tr>";
		echo "<td>" . $row['Imie'] . "</td>";
		echo "<td>" . $row['Nazwisko'] . "</td>";
		echo "</tr>";
		}
		echo "</table><br>";
		
	$conn->close();


?>
</div>

<div class="stopka">
<h2>Adam Adamczyk</h2>
</div>

</body>
</html> 