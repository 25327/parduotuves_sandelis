<?php
$getProduct = mysqli_query($database, 'select * from produktai');
$products = mysqli_fetch_all($getProduct, MYSQLI_ASSOC);

$action = $_GET['action'] ?? null;
if ($action === 'order') {
    $likutis = $_POST['likutis'] ?? 0;
    $produkto_id = $_POST['produkto_id'];
    if ($likutis > 0) {
        $sql = "select * from sandelio_produktai where produkto_id = $produkto_id";
        $sqlResult = mysqli_query($database, $sql);
        $item = mysqli_fetch_row($sqlResult);

        if ($item == null) {
            $saveToWarehouse = 'insert into sandelio_produktai (produkto_id, likutis) value ("' . $produkto_id . '", "' . $likutis . '")';
            mysqli_query($database, $saveToWarehouse);
        } else {
            $sql = "update sandelio_produktai set likutis = likutis + $likutis where produkto_id = $produkto_id";
            mysqli_query($database, $sql);
        }
        header('Location: index.php?page=warehouse_products');
    }
}

$sql = "select produktai.pavadinimas, sandelio_produktai.likutis from sandelio_produktai
        join produktai on produktai.id = sandelio_produktai.produkto_id";
$result = mysqli_query($database, $sql);
$warehouseProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($action === 'delete') {
    $sql = "select produkto_id from sandelio_produktai where produkto_id = {$_POST['produkto_id']}";
    $result = mysqli_query($database, $sql);
    $produkto_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
var_dump($produkto_id);

    $sql = "delete from sandelio_produktai where produto_id = {$produkto_id}";
    $result = mysqli_query($database, $sql);
//    header('Location: index.php?page=warehouse_products');
}
?>

<h2>Užsakyti produktus</h2>

<form action="index.php?page=warehouse_products&action=order" method="post">
    <table>
        <td>
            <select name="produkto_id">
                <?php foreach ($products as $product) { ?>
                    <option value="<?php echo $product['id'] ?>"><?php echo $product['pavadinimas'] ?></option>
                <?php } ?>
            </select>
        </td>
        <td>
            <input type="number" name="likutis">
            <button type="submit">Užsakyti</button>
        </td>
    </table>
</form>

<h2>Sandėlio produktai</h2>

<form action="index.php?page=warehouse_products&action=delete" method="post">
    <table>
        <tr>
            <th>Produkto pavadinimas</th>
            <th>Likutis</th>
            <th>Atšaukti</th>
        </tr>
        <?php foreach ($warehouseProducts as $warehouseProduct) { ?>
            <tr>
                <td>
                    <?php echo $warehouseProduct['pavadinimas'] ?>
                </td>
                <td>
                    <?php echo $warehouseProduct['likutis'] ?>
                </td>
                <td>
                    <button type="submit">Ištrinti</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</form>