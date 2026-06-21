<?php

session_start();

include 'connect.php';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Monde</title>
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

<main class="container">
    <section class="news-section">
        <h2>Sport</h2>

        <div class="cards">

            <?php

            $query =
            "SELECT * FROM vijesti
            WHERE kategorija='Sport'
            AND arhiva=0";

            $result = mysqli_query($dbc,$query);

            while($row = mysqli_fetch_array($result))
            {
            ?>

            <article class="card">

            <a href="clanak.php?id=<?php echo $row['id']; ?>">

            <img src="img/<?php echo $row['slika']; ?>">

            <h3>
            <?php echo $row['naslov']; ?>
            </h3>

            </a>

            </article>

            <?php
            }
            ?>

        </div>
    </section>
        <section class="news-section">
        <h2>Politique</h2>

        <div class="cards">

            <?php

            $query =
            "SELECT * FROM vijesti
            WHERE kategorija='Politique'
            AND arhiva=0";

            $result = mysqli_query($dbc,$query);

            while($row = mysqli_fetch_array($result))
            {
            ?>

            <article class="card">

            <a href="clanak.php?id=<?php echo $row['id']; ?>">

            <img src="img/<?php echo $row['slika']; ?>">

            <h3>
            <?php echo $row['naslov']; ?>
            </h3>

            </a>

            </article>

            <?php
            }
            ?>

        </div>
    </section>
</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer>

</body>
</html>