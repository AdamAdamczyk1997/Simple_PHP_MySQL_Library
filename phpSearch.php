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
	
	$search = $_POST['search'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="Biblioteka";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
	echo "Wróć na stronę główną!";
	die();
}

if ($search=="Mickiewicz"){
$result = mysqli_query($conn,"SELECT * FROM ksiazki where AutorID=2 ");
}
elseif ($search=="Sienkiewicz") {
$result = mysqli_query($conn,"SELECT * FROM ksiazki where AutorID=1 ");
} elseif($search=="Asnyk") {
	$result = mysqli_query($conn,"SELECT * FROM ksiazki where AutorID=3 ");
}
else {
echo "Na stanie nie ma książki tego autora<br>";
};

if($search=="Sienkiewicz" || $search=="Mickiewicz" || $search=="Asnyk"){
echo "<table border='1'>
		<tr>
		<th>Tytuł</th>
		<th>Wydawnictwo</th>
		<th>Rok wydania</th>
		</tr>";

		if($result!=NULL)
		{
			while($row = mysqli_fetch_array($result))
		{
		echo "<tr>";
		echo "<td>" . $row['Tytul'] . "</td>";
		echo "<td>" . $row['Wydawnictwo'] . "</td>";
		echo "<td>" . $row['RokWydania'] . "</td>";
		echo "</tr>";
		}
		echo "</table>";
		}
}
	$conn->close();


//Delete database
	$con = mysqli_connect($servername, $username, $password);
	$sql = "DROP DATABASE Biblioteka";
	if ($con->query($sql) === TRUE) {
	  echo "Baza danych została automatycznie usunięta do celów testowych<br>Aby ponownie załadować należy wrócić na główną stronę";
	} else {
	  echo "Error delete database: " . $con->error;
	}

	$con->close();

?>
</div>

<div class="stopka">
<h2>Adam Adamczyk</h2>
</div>

</body>
</html> 