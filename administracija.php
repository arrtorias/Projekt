<?php

session_start();  

include 'connect.php';

$uspjesnaPrijava = false;
$admin = false;

if($_SESSION['level'] == 1)
{
    $admin = true;
}

if(isset($_POST['prijava']))
{
    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql =
    "SELECT *
     FROM korisnik
     WHERE korisnicko_ime=?";

    $stmt = mysqli_stmt_init($dbc);

    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($stmt);

    $result =
    mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);

        if(password_verify($lozinka, $row['lozinka']))
        {
            $uspjesnaPrijava = true;

            $_SESSION['username'] =
            $row['korisnicko_ime'];

            $_SESSION['level'] =
            $row['razina'];

            if($row['razina'] == 1)
            {
                $admin = true;
            }
            header("Location: administracija.php");
            exit();
        }
    }
}

if(isset($_SESSION['username']))
{
    $uspjesnaPrijava = true;
    
    if($_SESSION['level'] == 1)
    {
        $admin = true;
    }
}

if(!isset($_SESSION['username']) && !isset($_POST['prijava']))
{
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Administracija</title>
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

if($uspjesnaPrijava && $admin)
{

    if(isset($_POST['delete']))
    {
        $id = $_POST['id'];

        mysqli_query(
        $dbc,
        "DELETE FROM vijesti
         WHERE id=$id");
    }

    $query = "SELECT * FROM vijesti";

    $result = mysqli_query($dbc,$query);

    echo "<h1>Administracija vijesti</h1>";

    while($row = mysqli_fetch_array($result))
    {
?>

<form method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

<h3>
<?php echo $row['naslov']; ?>
</h3>

<p>
<?php echo $row['kategorija']; ?>
</p>

<button
type="submit"
name="delete">
Izbriši
</button>

<hr>

</form>

<?php
    }
}
else if($uspjesnaPrijava && !$admin)
{
    echo "
    <h2>Prijava uspješna.</h2>

    <p>Nemate administratorska prava za pristup ovoj stranici.</p>

    <a href='index.php'>Povratak na početnu stranicu</a>";
}

?>

</main>

<footer>
    <hr>
    <p>Kristian Pirc | kpirc@tvz.hr | 2026.</p>
</footer> 

</body>
</html>