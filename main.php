<!DOCTYPE html>
<html lang="en">
<head>
    <title>PostgresSQL i php</title>
</head>
<body>
<h1> TEST </h1>
<?php
// tu umieszczamy kod skryptu
// Połączmy się z bazą danych i rozłączmy się z nią
$dbh = pg_connect("dbname=zad2projekt_s188559 user=s188559
password=tajnehaslo123 host=localhost") or die("Nie moge
polaczyc sie z baza danych ! ");
// tu powinno byc polaczenie
// wykonajmy zapytanie
$query = "INSERT INTO kierowca(imie,nazwisko) VALUES
('Adam', 'Nowak')";
//$wynik = pg_query($dbh,$query);
// wyświetlmy dane
$query = "Select jaki_kierowca,imie,nazwisko,model,nr_rejestracyjny,data_odjazdu,data_powrotu from wycieczka w LEFT JOIN kierowca k ON w.jaki_kierowca=k.id_kierowcy LEFT JOIN autokar a ON w.jaki_autokar=a.id_autokaru";
$wynik = pg_query($dbh,$query);
// odbierzmy rozmiary tabeli:
$liczba_kolumn = pg_num_fields($wynik);
$liczba_wierszy = pg_num_rows($wynik);
// teraz wyświetlmy dane
echo "<TABLE border width=1>";
echo "<TR>";
for($k =0;$k<$liczba_kolumn;$k++)
{
echo "<TD>";
echo pg_field_name($wynik,$k);
echo "</TD>"; //echo "\t";
}
echo "<td>Usun</td><td>Edytuj</td></TR>";
for($w =0;$w<$liczba_wierszy;$w++)
{
echo "<TR>";
for($k =0;$k<$liczba_kolumn;$k++)
{
echo "<TD>";
echo pg_fetch_result($wynik,$w,$k);
echo "</TD>"; //echo "\t";
}
$idos = pg_fetch_result($wynik,$w,0);
echo "<TD>";
// tu dodajemy formularz do usuwania osoby
echo "<form action=delete.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=usun value=Usun></form>";
echo "</TD>";
echo "<TD>";
// tu dodajemy formularz do edycji osoby
echo "<form action=update.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=edytuj value=Edytuj></form>";
echo "</TD>";
echo "</TR>"; //echo "<br />";
}
echo "</TABLE>";
?>
<FORM action=add.php method=POST> Dodaj nową wycieczkę do
bazy <br />
Kierowca: <select name="kierowca">
<?php
    $query="Select id_kierowcy,imie,nazwisko from kierowca";
    $result=pg_query($query);
    while($rows=pg_fetch_assoc(@$result)){
    ?><option value=<?php echo $rows['id_kierowcy'];  ?>><?php echo $rows['imie'];echo" "; echo $rows['nazwisko'];  ?></option><?php
    }
?></select>
Autokar:  <select name="autokar">
<?php
    $query="Select model,nr_rejestracyjny,id_autokaru from autokar";
    $result=pg_query($query);
    while($rows=pg_fetch_assoc(@$result)){
    ?><option value=<?php echo $rows['id_autokaru'];  ?>><?php echo $rows['model'];echo" "; echo $rows['nr_rejestracyjny'];  ?></option><?php
    }
?></select>
Data odjazdu: <input type="datetime-local" name="data_odjazdu" id="data_odjazdu">
<input type=submit name=Dodaj value=Dodaj>
</form>
<?php
pg_close($dbh);
?>
<script>
    var date= document.getElementById('data_odjazdu').value;
    console.log(date);
    console.log("dziala");
</script>
</body>
</html>
