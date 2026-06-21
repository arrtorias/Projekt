<?php

session_start();

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght,XOPQ,XTRA,YOPQ,YTDE,YTFI,YTLC,YTUC@8..144,100..1000,96,468,79,-203,738,514,712&display=swap" rel="stylesheet">
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

    <h1>Prijava</h1>

    <form action="administracija.php" method="POST">

        <label>Korisničko ime</label>
            <input type="text" name="username" required>

        <br><br>

        <label>Lozinka</label>
            <input type="password" name="lozinka" required>

        <br><br>

        <button type="submit" name="prijava">
        Prijava
        </button>

    </form>

    <h3>Nemate korisnički račun?</h3>

    <a href="registracija.php">Registrirajte se ovdje</a>

</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer> 

</body>
</html>