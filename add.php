<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dodaj osobe</title>
</head>
<body>
    <h1>Dodano osobe</h1>
    <?php
        $kierowca=$_POST['kierowca'];
        $autokar=$_POST['autokar'];
        $start=$_POST['data_odjazdu'];
        $start=str_replace("T"," ",$start);
        $start=date('Y-m-d H:i:s',strtotime($start));
        $dbh= pg_connect("dbname=zad2projekt_s188559 user=s188559
        password=tajnehaslo123 host=localhost") or die("Nie moge sie polaczyc");
        $query="INSERT INTO wycieczka(jaki_kierowca,jaki_autokar,data_odjazdu) VALUES('$kierowca','$autokar','$start')";
        $wynik=pg_query($query);
        pg_close($dbh);
        echo '<form action=main.php method=post>
        <input type=submit name=Ok values=OK>
        </form>';
    ?>

</body>
