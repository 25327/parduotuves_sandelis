<?php
if (isset($_POST['pastas'])) {
    $email = $_POST['pastas'];
    $password = $_POST['slaptazodis'];

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = 'Užpildykite visus laukus';
    }

    $sql = 'select * from darbuotojai where pastas = "' . $email . '" and slaptazodis = "' . $password . '"';
    $checkUser = mysqli_query($database, $sql);

    if ($checkUser == null) {
        $errors[] = 'Blogi prisijungimo duomenys';
    }

    if (empty($errors)) {
        $_SESSION['email'] = $email;
        header('Location: index.php');
    }
}
?>

<ul>
    <?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            ?>
            <li>
                <?php echo $error ?>
            </li>
        <?php }
    } ?>
</ul>
<form action="index.php?page=login" method="post">
    <fieldset>
        <legend>Prisijungimas:</legend>
        Paštas: <input type="email" name="pastas" value="<?php echo $_GET['email'] ?? null ?>">
        <br><br>
        Slaptažodis: <input type="password" name="slaptazodis">
        <br><br>
        <button type="submit">Prisijungti</button>
        <hr>
        Neturite paskyros? Užsiregistruokite!
        <br>
        <a href="index.php?page=register">Registruotis</a>
    </fieldset>
</form>