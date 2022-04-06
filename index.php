<?php
include_once 'config.php';
?>

    <h1>Prekių valdymo sistema</h1>

    <table>
        <?php if (isLoged() === false) { ?>
            <td>
                <a href="index.php?page=login">Login</a>
            </td>
            <td>
                <a href="index.php?page=register">Register</a>
            </td>
        <?php } ?>
    </table>

<?php
if ($page === 'register') {
    include 'pages/registration.php';
}
?>