<?php
// ijungti klaidu pranesimus
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// pradedam sesiją
session_start();

//prisijungimai prie duomenu bazes
$ip = 'localhost';
$username = 'root';
$password = '';
$database = 'parduotuves_sandelis';

// jungiames prie duomenu bazes
$database = mysqli_connect($ip, $username, $password, $database);

// Tikrinam ar pavyko prisijungti prie duomenu bazes
if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}

$page = $_REQUEST['page'] ?? null;

function isLoged(): bool
{
    if (isset($_SESSION['email'])) {
        return true;
    } else {
        return false;
    }
}

function getUser($database, $email)
{
    $user = mysqli_query($database, 'select * from darbuotojai where pastas = "' . $email . '"');
    $user = mysqli_fetch_row($user);

    return $user;
}

$dateToday = date('Y-m-d');
$dateSql = "select pp.kaina, pm.marza from parduotuves_prekes pp
            join parduotuves_marzos pm on pp.parduotuves_id = pm.parduotuves_id
            where pp.galioja_iki = 'SdateToday' and pp.utilizuota = 0;";
$getProducts = mysqli_query($database, $dateSql);
$products = mysqli_fetch_all($getProducts, MYSQLI_ASSOC);

foreach ($products as $product) {
//    echo '<pre>';
//    print_r($product);
}

?>