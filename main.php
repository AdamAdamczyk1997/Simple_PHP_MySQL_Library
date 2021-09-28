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
<form action="list.php" method="post">
  <label for="name">Lista wszystkich dostępnych autorów</label>
  
  <input type="submit" name="list" value="Pokaż"><br>
</form>

<form action="phpSearch.php" method="post">
	<div>Wpisz nazwisko autora</div>
  <label for="name">Nazwisko</label>
  <input type="text" name="search" id="name" placeholder="Sienkiewicz" required>
  
  <input type="submit" name="submit" value="Wyszukaj">
</form>

</div>
<div class="prawy">
<?php

// Connnection to mysql

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="Biblioteka";

	// Create connection
	$con = mysqli_connect($servername, $username, $password);


// Create database
	$sql = "CREATE DATABASE Biblioteka";
	$con->query($sql);

	$con->close();

// sql to create table

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "CREATE TABLE autorzy (
			  IDAutor int(10) UNSIGNED NOT NULL,
			  Imie text,
			  Nazwisko text
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	$conn->query($sql);


// Create table egzemplarze 
	
	$sql = "CREATE TABLE egzemplarze (
			IDEgzemplarz int(10) UNSIGNED NOT NULL,
			KsiazkaID int(10) UNSIGNED NOT NULL,
			DoWypozyczenia tinyint(1) DEFAULT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	$conn->query($sql);

// Create table ksiazki
	$sql = "CREATE TABLE ksiazki (
	  IDKsiazki int(10) UNSIGNED NOT NULL,
	  AutorID int(10) UNSIGNED NOT NULL,
	  Tytul text,
	  Wydawnictwo text,
	  RokWydania int(10) UNSIGNED DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";


	$conn->query($sql);

// Insert data to table autorzy

	$sql = "INSERT INTO autorzy (IDAutor, Imie, Nazwisko) VALUES
	(1, 'Henryk', 'Sienkiewicz');";
	$sql .= "INSERT INTO autorzy (IDAutor, Imie, Nazwisko) VALUES
	(2, 'Adam', 'Mickiewicz');";
	$sql .= "INSERT INTO autorzy (IDAutor, Imie, Nazwisko) VALUES
	(3, 'Adam', 'Asnyk');";
	
	$conn->multi_query($sql);
	$conn->close();

// Insert data to table ksiazki
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	
		$sql = "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(1, 1, 'W pustyni i w puszczy', 'Znak', 2014);";
		$sql .= "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(2, 1, 'Quo vadis', 'Greg', 2014);";
		$sql .= "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(3, 2, 'Pan Tadeusz', 'Ossolineum', 2005);";
		$sql .= "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(4, 2, 'Ballady i romanse', 'Zielona Sowa', 2010);";
		$sql .= "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(5, 2, 'Dziady', 'Ossolineum', 2009);";
		$sql .= "INSERT INTO ksiazki (IDKsiazki, AutorID, Tytul, Wydawnictwo, RokWydania) VALUES
	(6, 3, 'Do młodych', 'Fundacja Nowoczesna Polska', 2005);";
		
	$conn->multi_query($sql);
	
	$conn->close();
	
// Insert data to table egzemplarze

	$conn = new mysqli($servername, $username, $password, $dbname);


			$sql = "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(1, 1, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(2, 1, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(3, 1, 0);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(4, 2, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(5, 2, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(6, 3, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(7, 4, 0);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(8, 4, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(9, 4, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(10, 5, 1);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(11, 5, 0);";
		$sql .= "INSERT INTO `egzemplarze` (`IDEgzemplarz`, `KsiazkaID`, `DoWypozyczenia`) VALUES
		(12, 2, 1);";

	$conn->multi_query($sql);
	$conn->close();

// Select data

	$conn = mysqli_connect($servername, $username, $password, $dbname);

		
		$result = mysqli_query($conn,"SELECT * FROM ksiazki");
		
		echo "Lista dostępnych tytułów";
		echo "<table border='1'>
		<tr>
		<th>Tytuł</th>
		<th>Wydawnictwo</th>
		<th>Rok wydania</th>
		</tr>";

		while($row = mysqli_fetch_array($result))
		{
		echo "<tr>";
		echo "<td>" . $row['Tytul'] . "</td>";
		echo "<td>" . $row['Wydawnictwo'] . "</td>";
		echo "<td>" . $row['RokWydania'] . "</td>";
		echo "</tr>";
		}
		echo "</table>";
		
	//Indeksy dla zrzutów tabel

		$sql = "ALTER TABLE `autorzy`
		  ADD PRIMARY KEY (`IDAutor`)";
		$conn->query($sql);
		  
		$sql = "ALTER TABLE `egzemplarze`
		  ADD PRIMARY KEY (`IDEgzemplarz`)";
		$conn->query($sql);
		
		$sql = "ALTER TABLE `ksiazki`
		  ADD PRIMARY KEY (`IDKsiazki`)";
		  
		$conn->query($sql);

	//AUTO_INCREMENT dla tabel

		$sql = "ALTER TABLE `autorzy`
		  MODIFY `IDAutor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
		$conn->query($sql);

		$sql = "ALTER TABLE `egzemplarze`
		  MODIFY `IDEgzemplarz` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
		$conn->query($sql);

		$sql = "ALTER TABLE `ksiazki`
		  MODIFY `IDKsiazki` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
		$conn->query($sql);
		
		$conn->close();
		

?>
</div>
<div class="stopka">
<h2>Adam Adamczyk</h2>
</div>

</body>
</html> 