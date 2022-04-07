<?php
include_once 'config.php';
?>
    <h1>Prekių valdymo sistema</h1>

    <table>
        <tr>
            <?php if (isLoged() === false) { ?>
                <td>
                    <a href="index.php?page=login">Prisijungti</a>
                </td>
                <td>
                    <a href="index.php?page=register">Registruotis</a>
                </td>
            <?php } else { ?>
                <?php
                if (isset($_POST['sandelio_darbuotojas'])) {
                    var_dump($_POST['sandelio_darbuotojas']);?>
                    <td>
                        <a href="index.php?page=warehouse">Sandėlis</a>
                    </td>
                    <td>
                        <a href="index.php?page=products">Produktai</a>
                    </td>
                <?php } else { ?>
                    <td>
                        <a href="index.php?page=shops">Parduotuvės</a>
                    </td>
                <?php } ?>
                <td>
                    <a href="index.php?page=logout">Atsijungti</a>
                </td>
            <?php } ?>
        </tr>
    </table>

<?php
if ($page === 'register') {
    include 'pages/registration.php';
} elseif ($page === 'login') {
    include 'pages/login.php';
} elseif ($page === 'logout') {
    include 'pages/logout.php';
} elseif ($page === 'warehouse') {
    include 'pages/warehouse.php';
} elseif ($page === 'shops') {
    include 'pages/shops.php';
} elseif ($page === 'products') {
    include 'pages/products.php';
}
?>