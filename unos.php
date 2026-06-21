<?php

session_start();

include 'connect.php';

if(isset($_POST['title']))
{
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $picture = $_FILES['image']['name'];

    $archive = isset($_POST['archive']) ? 1 : 0;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        'img/'.$picture
    );

    $date = date('d.m.Y.');

    $query = "
    INSERT INTO vijesti
    (datum,naslov,sazetak,tekst,slika,kategorija,arhiva)
    VALUES
    (
    '$date',
    '$title',
    '$about',
    '$content',
    '$picture',
    '$category',
    '$archive'
    )";

    mysqli_query($dbc,$query);
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vijesti</title>
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

    <h1>Unos nove vijesti</h1>

   <form action="unos.php" method="POST" enctype="multipart/form-data"
          method="POST"
          enctype="multipart/form-data"
          name="formaVijest">

        <div class="form-item">
            <label for="title">Naslov vijesti</label>
            <input type="text"
                   name="title"
                   id="title"
                   required>
        </div>

        <div class="form-item">
            <label for="about">Kratki sadržaj vijesti</label>
            <textarea name="about"
                      id="about"
                      rows="5"
                      required></textarea>
        </div>

        <div class="form-item">
            <label for="content">Sadržaj vijesti</label>
            <textarea name="content"
                      id="content"
                      rows="10"
                      required></textarea>
        </div>

        <div class="form-item">
            <label for="category">Kategorija</label>

            <select name="category" id="category">
                <option value="Politique">Politique</option>
                <option value="Sport">Sport</option>
            </select>
        </div>

        <div class="form-item">
            <label for="image">Odabir slike</label>
            <input type="file"
                   name="image"
                   id="image"
                   accept="image/*">
        </div>

        <div class="form-item checkbox-row">
            <input type="checkbox"
                   name="archive"
                   id="archive">

            <label for="archive">
                Prikazati vijest na stranici
            </label>
        </div>

        <div class="form-buttons">
            <button type="reset">Poništi</button>
            <button type="submit">Pošalji</button>
        </div>

    </form>

</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer>

</body>
</html>