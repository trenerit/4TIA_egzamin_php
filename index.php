<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = mysqli_connect('localhost', 'root', '', 'zgloszenia');

$kto = 'policjant';
                    
    if(isset($_POST['status'])) {
                    
        if($_POST['status'] == 'ratownik') {
            $kto = 'ratownik';
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>ZGŁOSZENIA</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<header>
    <h1>Zgłoszenia wydarzeń</h1>
</header>
<main>
    <section class="lewa">
        <h2>Personel</h2>
        <form method="post">
            <input type="radio" name="status" value="policjant" checked> Policjant
            <input type="radio" name="status" value="ratownik"> Ratownik
            <input type="submit" value="Pokaż">
        </form>
        <h3>
            Wybrano opcję: <?php echo $kto ?>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT `id`, `imie`, `nazwisko` FROM `personel` WHERE `status` = '$kto'";
                    
                    $result = mysqli_query($connect, $query);

                    while($row = mysqli_fetch_array($result)) {
                    // $id = $row['id'];    
                    // $imie = $row['imie'];    
                    // $nazwisko = $row['nazwisko'];    
                    echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[imie]</td>
                            <td>$row[nazwisko]</td>
                        </tr> 
                        ";
                    }
                ?>
               
            </tbody>
        </table>
    </section>
    <section class="prawa">
        <h2>Nowe zgłoszenie</h2>
        <ol>
        <?php

                    $query2 = "SELECT id, nazwisko FROM personel WHERE id NOT IN (SELECT id_personel FROM rejestr);";
                    
                    $result2 = mysqli_query($connect, $query2);

                    while($row2 = mysqli_fetch_array($result2)) {  
                    echo "
                        <li>$row2[id] $row2[nazwisko]</li> 
                        ";
                    }
                ?>
        </ol>
        <form method="post">
            <label>Wybierz id osoby z listy:</label><br>
            <input type="number" name="id_osoby">
            <input type="submit" name="dodaj" value="Dodaj zgłoszenie">
        </form>
        <?php

            if(isset($_POST['id_osoby'])) {
                         
            $id = $_POST['id_osoby'];
            
            $query3 = "INSERT INTO `rejestr` (`id`, `data`, `id_personel`, `id_pojazd`) VALUES (NULL, NOW(), '$id', '14');";
            
            $result3 = mysqli_query($connect, $query3);
            }
                    
        ?>
    </section>
</main>
<footer>
    <p>Stronę wykonał: numer_zdajacego</p>
</footer>
</body>
</html>
<?php
mysqli_close($connect);
?>
