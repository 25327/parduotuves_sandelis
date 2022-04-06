<?php
include_once 'config.php';
?>

<form action="index.php">
    <fieldset>
        <legend>Prisijungimas:</legend>
        Paštas: <input type="email" id="email" name="email">
        <br><br>
        Slaptažodis: <input type="text" id="password" name="password">
        <br><br>
        <button type="submit">Prisijungti</button>
        <hr>
        Neturite paskyros? Užsiregistruokite!
        <br>
        <a href="index.php?page=registration">Registruotis</a>
    </fieldset>
</form>

<?php
if ($page === 'register') {
    include 'pages/registration.php';
}
?>