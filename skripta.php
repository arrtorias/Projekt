<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz vijesti</title>
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

<?php

$title = "";
$about = "";
$content = "";
$category = "";


$image = $_FILES['image']['name'];

move_uploaded_file(
    $_FILES['image']['tmp_name'],
    'img/' . $image
);

if(isset($_POST['title']))
{
    $title = $_POST['title'];
}

if(isset($_POST['about']))
{
    $about = $_POST['about'];
}

if(isset($_POST['content']))
{
    $content = $_POST['content'];
}

if(isset($_POST['category']))
{
    $category = $_POST['category'];
}

?>

<main class="article-container">

    <article class="article-page">

        <p class="category">
            <?php echo $category; ?>
        </p>

        <h1>
            <?php echo $title; ?>
        </h1>

        <p class="subtitle">
            <?php echo $about; ?>
        </p>

        <section class="slika">
            <?php
                echo "<img src='img/$image' alt='Slika vijesti'>";
            ?>
        </section>

        <section class="article-content">
            <p>
                <?php echo nl2br($content); ?>
            </p>
        </section>

    </article>

</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer>

</body>
</html>