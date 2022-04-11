<?php
$getProduct = mysqli_query($database, 'select * from produktai');
$products = mysqli_fetch_all($getProduct, MYSQLI_ASSOC);

echo '<pre>';
print_r($products);
echo '</pre>';
?>

<h2>Sandėlio produktai</h2>

<form>
    <table>
        <tr>
            <th>Produktas</th>
            <th>Likutis</th>
            <th>Užsakyti</th>
        </tr>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td>
                    <?php echo $product['pavadinimas'] ?>
                </td>
                <td>
                    <?php echo '' ?>
                </td>
                <td>
                    <?php echo '' ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</form>