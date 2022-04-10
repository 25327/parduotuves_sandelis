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
                switch (getUser($database, $_SESSION['email'])[1]) {
                    case 'sandelio_darbuotojas';
                        ?>
                        <td>
                            <a href="index.php?page=warehouse_products">Sandėlis</a>
                        </td>
                        <td>
                            <a href="index.php?page=products">Produktai</a>
                        </td>
                        <?php
                        break;
                    case 'parduotuves_darbuotojas';
                        ?>
                        <td>
                            <a href="index.php?page=shops">Parduotuvės</a>
                        </td>
                        <?php
                        break;
                }
                ?>
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
} elseif ($page === 'warehouse_products') {
    include 'pages/warehouse_products.php';
} elseif ($page === 'shops') {
    include 'pages/shops.php';
} elseif ($page === 'products') {
    include 'pages/products.php';
}
?>