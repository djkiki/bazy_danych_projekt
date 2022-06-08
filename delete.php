<html>
<head>
<title>Usuń osobę</title>
</head>
<body>
<h1> Usuwam osobę </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – uzyjemy je w zapytaniu ponizej
$id = $_POST['idos'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=zad2projekt_s188559 user=s188559
password=tajnehaslo123 host=localhost") or die("Nie
moge polaczyc sie z baza danych ! ");
// tu powinno byc polaczenie
// wykonajmy zapytanie
echo $id;
$query = "DELETE FROM wycieczka where jaki_kierowca = '$id'";
$wynik = pg_query($query);
// sprawdzmy ile wierszy podmieniono
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo '<form action=main.php method=post>
<input type=submit name=Ok value=OK>
</form>';
?>
</body>
</html>
