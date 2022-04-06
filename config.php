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

?>