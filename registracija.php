<?php

session_start();

include 'connect.php';

if(isset($_POST['registracija']))
{
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $passRep = $_POST['passRep'];

    if($pass == $passRep)
    {
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        $query = "INSERT INTO korisnik
        (ime, prezime, korisnicko_ime, lozinka, razina)
        VALUES
        (
        '$ime',
        '$prezime',
        '$username',
        '$hashed_password',
        0
        )";

        mysqli_query($dbc, $query);

        echo "<p>Registracija uspješna!</p>";
    }
    else
    {
        echo "<p>Lozinke nisu iste!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registracija</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png" alt="Le Monde">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>

            <li>
                <a href="kategorija.php?kategorija=Politique">
                POLITIQUE
                </a>
            </li>

            <li>
                <a href="kategorija.php?kategorija=Sport">
                SPORT
                </a>
            </li>

            <li>
                <a href="unos.php">
                UNOS
                </a>
            </li>

            <?php
            if(isset($_SESSION['username']))
            {
                ?>
                <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                <li><a href="logout.php">ODJAVA</a></li>
                <?php
            }
            else
            {
                ?>
                <li><a href="login.php">PRIJAVA</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>

<main class="form-container">

    <h1>Registracija korisnika</h1>

    <form method="POST">

        <label>Ime</label>
        <input type="text" name="ime" required>

        <br><br>

        <label>Prezime</label>
        <input type="text" name="prezime" required>

        <br><br>

        <label>Korisničko ime</label>
        <input type="text" name="username" required>

        <br><br>

        <label>Lozinka</label>
        <input type="password" name="pass" required>

        <br><br>

        <label>Ponovi lozinku</label>
        <input type="password" name="passRep" required>

        <br><br>

        <button type="submit" name="registracija">
        Registracija
        </button>

    </form>

</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer> 

</body>
</html>