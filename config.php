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
$sqlProducts = "select produkto_id from parduotuves_prekes where galioja_iki = 'SdateToday' and  utilizuota = 0";
$getProducts = mysqli_query($database, $sqlProducts);
$products = mysqli_fetch_all($getProducts, MYSQLI_ASSOC);

$sqlMargins = "select parduotuves_id, marza from parduotuves_marzos where tipas = 'baigiasi_galiojimas'";
$getMargins = mysqli_query($database, $sqlMargins);
$shopMargins = mysqli_fetch_all($getMargins, MYSQLI_ASSOC);

foreach ($shopMargins as $shopMargin) {
    $sql = "update parduotuves_prekes set kaina = round(kaina - (kaina / 100 * {$shopMargin['marza']}), 2) where parduotuves_id = {$shopMargin['parduotuves_id']} and galioja_iki = '{$dateToday}'";
    $result = mysqli_query($database, $sql);
}

$sqlValidTo = "update parduotuves_prekes set utilizuota = 1 where galioja_iki < '{$dateToday}' and utilizuota = 0";
$result = mysqli_query($database, $sqlValidTo);

?>