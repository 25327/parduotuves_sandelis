<?php
$name = $_POST['pavadinimas'] ?? null;
$adress = $_POST['adresas'] ?? null;
$sql = 'insert into parduotuves (pavadinimas, adresas) value ("' . $name . '", "' . $adress . '")';
mysqli_query($database, $sql);
?>

<form action="index.php?page=shops" method="post">
    <table>
        <tr>
            <td>Parduotuvės Pavadinimas</td>
            <td><input type="text" name="pavadinimas"></td>
        </tr>
        <tr>
            <td>Parduotuvės Adresas</td>
            <td>
                <input type="text" name="adresas">
            </td>
        </tr>
    </table>
    <button type="submit">Išsaugoti</button>
</form>
