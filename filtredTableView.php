<? require_once 'productsParams.php'; ?>

<table>
    <tr class="mainTR">
        <th class="mainTH">Название товара</th>
        <th class="mainTH">Цена розничная, руб</th>
        <th class="mainTH">Цена оптовая, руб</th>
        <th class="mainTH">Наличие на складе №1</th>
        <th class="mainTH">Наличие на складе №2</th>
        <th class="mainTH">Страна производства</th>
        <th class="mainTH">Примечание</th>
    </tr>
    <? foreach ($filtredProducts as $product): ?>
        <? if ($product['price'] == maxPrice()) {
            echo "<tr style='background-color: red'>";
        } else {
            if ($product['wholesalePrice'] == minWholesalePrice()) {
                echo "<tr style='background-color: green'>";
            } else {
                echo "<tr>";
            }
        } ?>
        <td style="width: 30%;"><?= $product['productName']; ?></td>
        <td style="width: 15%;"><?= $product['price']; ?></td>
        <td style="width: 15%;"><?= $product['wholesalePrice']; ?></td>
        <td style="width: 5%;"><?= $product['availabilityInWarehouse1']; ?></td>
        <td style="width: 5%;"><?= $product['availabilityInWarehouse2']; ?></td>
        <td style="width: 15%;"><?= $product['countryOfOrigin']; ?></td>
        <td style="width: 15%;"><?= $product['note']; ?></td>
        </tr>
    <? endforeach; ?>
</table>