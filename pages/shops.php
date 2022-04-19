<?php
$getShops = mysqli_query($database, 'select * from parduotuves');
$shops = mysqli_fetch_all($getShops, MYSQLI_ASSOC);

$getProduct = mysqli_query($database, 'select * from produktai');
$products = mysqli_fetch_all($getProduct, MYSQLI_ASSOC);

$action = $_GET['action'] ?? null;
if ($action === 'order') {
    $sql = "select * from produktai where id = {$_POST['produkto_id']}";
    $result = mysqli_query($database, $sql);
    $product = mysqli_fetch_row($result);

    $sqlForMargin = "select * from parduotuves_marzos where parduotuves_id = {$_POST['parduotuves_id']}";
    $resultForMargin = mysqli_query($database, $sqlForMargin);
    $margins = mysqli_fetch_all($resultForMargin, MYSQLI_ASSOC);

    $price = $product[3];
    $category = $product[1];

    foreach ($margins as $margin) {
        if ($category == 'Vaisiai' and $margin['tipas'] == 'vaisiu') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
            break;
        } elseif ($category == 'Daržovės' and $margin['tipas'] == 'morku') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
            break;
        } elseif ($category == 'Gėrimai' and $margin['tipas'] == 'bendras') {
            $price = round($price + ($price / 100 * $margin['marza']), 2);
            break;
        }
    }

    $shopOrder = 'insert into parduotuves_prekes (parduotuves_id, produkto_id, kiekis, kaina, galioja_iki) value ("' . $_POST['parduotuves_id'] . '", "' . $_POST['produkto_id'] . '", "' . $_POST['kiekis'] . '", "' . $price . '", "' . $_POST['galioja_iki'] . '")';

    mysqli_query($database, $shopOrder);
    header('Location: index.php?page=shops');
}
?>

<h2>Užsakymas</h2>

<form action="index.php?page=shops&action=order" method="post">
    <table>
        <tr>
            <td>Pasirinkite parduotuvę</td>
            <td>
                <select name="parduotuves_id">
                    <?php foreach ($shops as $shop) { ?>
                        <option value="<?php echo $shop['id'] ?>"><?php echo $shop['pavadinimas'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Pasirinkite prekę</td>
            <td>
                <select name="produkto_id">
                    <?php foreach ($products as $product) { ?>
                        <option value="<?php echo $product['id'] ?>"><?php echo $product['pavadinimas'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Užsakomas kiekis</td>
            <td>
                <input type="number" name="kiekis">
            </td>
        </tr>
    </table>
    <button type="submit">Užsakyti</button>
</form>

<h2>Užsakyti produktai</h2>

<form>
    <?php
    $getShopLists = mysqli_query($database, 'select * from parduotuves_prekes');
    $lists = mysqli_fetch_all($getShopLists, MYSQLI_ASSOC);

    $sqlForShops = "select parduotuves.pavadinimas from parduotuves_prekes
                    join parduotuves on parduotuves.id = parduotuves_prekes.parduotuves_id";
    $shopsResult = mysqli_query($database, $sqlForShops);
    $shops = mysqli_fetch_all($shopsResult, MYSQLI_ASSOC);

    $sqlForProducts = "select produktai.pavadinimas from parduotuves_prekes
                       join produktai on produktai.id = parduotuves_prekes.produkto_id";
    $productsResult = mysqli_query($database, $sqlForProducts);
    $products = mysqli_fetch_all($productsResult, MYSQLI_ASSOC);
    ?>
    <table>
        <tr>
            <th>Parduotuvė</th>
            <th>Produktai</th>
            <th>Užsakytas kiekis</th>
            <th>Kaina/vnt.</th>
            <th>Galioja iki</th>
        </tr>
        <tr>
            <td>
                <?php foreach ($shops as $shop) {
                    echo $shop['pavadinimas'] . '<br>';
                }
                ?>
            </td>
            <td>
                <?php foreach ($products as $product) {
                    echo $product['pavadinimas'] . '<br>';
                }
                ?>
            </td>
            <td>
                <?php foreach ($lists as $list) {
                    echo $list['kiekis'] . '<br>';
                }
                ?>
            </td>
            <td>
                <?php foreach ($lists as $list) {
                    echo $list['kaina'] . '<br>';
                }
                ?>
            </td>
            <td>
                <?php foreach ($lists as $list) {
                        echo $list['galioja_iki'] . '<br>';
                }
                ?>
            </td>
        </tr>
    </table>
</form>