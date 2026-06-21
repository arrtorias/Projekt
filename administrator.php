<?php

include 'connect.php';

if(isset($_POST['delete']))
{
    $id = $_POST['id'];

    $query =
    "DELETE FROM vijesti
    WHERE id=$id";

    mysqli_query($dbc,$query);
}

$query = "SELECT * FROM vijesti";
$result = mysqli_query($dbc,$query);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
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
    <?php

    while($row = mysqli_fetch_array($result))
    {
    ?>

    <form method="POST">

        <h3><?php echo $row['naslov']; ?></h3>

        <input
        type="hidden"
        name="id"
        value="<?php echo $row['id']; ?>">

        <button
            type="submit"
            name="delete">
            Izbriši
        </button>

    </form>

    <hr>

    <?php
    }
    ?>
</main>