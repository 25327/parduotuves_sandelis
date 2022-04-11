<?php
$sql = 'insert into shops (pavadinimas, adresas) value ("' . $_POST['name'] . '", "' . $_POST['adress'] . '")';

mysqli_query($database, $sql);
?>

<form>
    <table>
        <tr>
            <td>Pavadinimas</td>
            <td>Adresas</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="name">
            </td>
            <td>
                <input type="text" name="adress">
            </td>
        </tr>
    </table>
</form>
