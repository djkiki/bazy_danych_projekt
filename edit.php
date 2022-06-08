<html>
<head>
<title>Edytuj osobę</title>
</head>
<body>
<h1> Edytuj osobę </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – uzyjemy je w zapytaniu ponizej
$id = $_POST['idos'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=zad2projekt_s188559 user=s188559
password=tajnehaslo123 host=localhost") or die("Nie moge
polaczyc sie z baza danych ! ");
// tu powinno byc polaczenie
// wykonajmy zapytanie – najpierw wyswietlmy dane
$query = "Select jaki_kierowca,imie,nazwisko,model,nr_rejestracyjny,data_odjazdu,data_powrotu from wycieczka w LEFT JOIN kierowca k ON w.jaki_kierowca=k.id_kierowcy LEFT JOIN autokar a
 ON w.jaki_autokar=a.id_autokaru where jaki_kierowca='$id'";
$wynik = pg_query($query);
?>
<form action=update.php method=post>
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
Data przyjazdu: <input type="datetime-local" name="data_przyjazdu" id="data_przyjazdu">
<input type=hidden name=idos value=<?php echo $id; ?>>
<input type=submit name=zmien value=zmien>
</form>
<?php
$kierowca= $rows['id_kierowcy'];
if (isset($_POST['zmien']))
{
$start=$_POST['data_odjazdu'];
$start=str_replace("T"," ",$start);
$start=date('Y-m-d H:i:s',strtotime($start));
$koniec=$_POST['data_przyjazdu'];
$koinec=str_replace("T"," ",$koniec);
$koniec=date('Y-m-d H:i:s',strtotime($koniec));
$query = "UPDATE wycieczka SET jaki_kierowca='".$_POST['kierowca']."', jaki_autokar='".$_POST['autokar']."',data_odjazdu='$start', data_powrotu='$koniec' where jaki_kierowca='$id'";
$wynik = pg_query($query);
// sprawdzmy ile wierszy podmieniono
}
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo '<form action=main.php method=post>
<input type=submit name=Ok value=OK>
</form>';
?>
</body>
</html>
