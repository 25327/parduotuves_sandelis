<?php
$action = $_GET['action'] ?? null;
if ($action === 'save') {
    $saveProduct = 'insert into produktai (kategorija, pavadinimas, kaina, galiojimo_dienos) value ("' . $_POST['kategorija'] . '", "' . $_POST['pavadinimas'] . '", "' . $_POST['kaina'] . '", "' . $_POST['galiojimo_dienos'] . '")';
    mysqli_query($database, $saveProduct);
}

$result = mysqli_query($database, 'select * from produktai');
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo '<pre>';
print_r($products);
echo '</pre>';
?>

<h1>Produktai</h1>

<form action="index.php?page=products&action=save" method="post">
    <table>
        <tr>
            <td>
                Kategorija
            </td>
            <td>
                <input type="text" name="kategorija">
            </td>
        </tr>
        <tr>
            <td>
                Prekės pavadinimas
            </td>
            <td>
                <input type="text" name="pavadinimas">
            </td>
        </tr>
        <tr>
            <td>
                Kaina
            </td>
            <td>
                <input type="number" name="kaina">
            </td>
        </tr>
        <tr>
            <td>
                Galiojimo laikas (dienomis):
            </td>
            <td>
                <select name="galiojimo_dienos">
                    <option value="">-</option>
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo $i ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    </table>
    <button type="submit">Išsaugoti</button>
</form>