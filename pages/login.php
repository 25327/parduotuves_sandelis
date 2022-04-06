<?php
if (isset($_POST['pastas'])) {
    $email = $_POST['pastas'];
    $password = $_POST['slaptazodis'];

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] =
    }
}
?>

<form action="index.php">
    <fieldset>
        <legend>
            <a href="index.php">Prisijungimas:</a>
        </legend>
        Paštas: <input type="email" name="pastas">
        <br><br>
        Slaptažodis: <input type="text" name="slaptazodis">
        <br><br>
        <button type="submit">Prisijungti</button>
        <hr>
        Neturite paskyros? Užsiregistruokite!
        <br>
        <a href="index.php?page=registration">Registruotis</a>
    </fieldset>
</form>