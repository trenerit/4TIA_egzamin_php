<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = mysqli_connect('localhost', 'root', '', 'zgloszenia');
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
                    $query = "SELECT `id`, `imie`, `nazwisko` FROM `personel` WHERE `status` = 'policjant'";
                    
                    $result = mysqli_query($connect, $query);

                    while($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];    
                    $imie = $row['imie'];    
                    $nazwisko = $row['nazwisko'];    
                    echo "
                        <tr>
                            <td>$id</td>
                            <td>$imie</td>
                            <td>$nazwisko</td>
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
        
        </ol>
        <form method="post">
            <label>Wybierz id osoby z listy:</label><br>
            <input type="number" name="id_osoby">
            <input type="submit" name="dodaj" value="Dodaj zgłoszenie">
        </form>
    </section>
</main>
<footer>
    <p>Stronę wykonał: numer_zdajacego</p>
</footer>
</body>
</html>
