<? require_once "productsParams.php"; ?>
<p>
<table>
    <tr class="mainTR">
        <th class="mainTH">Общиее количество товара на складе №1</th>
        <th class="mainTH">Общиее количество товара на складе №2</th>
        <th class="mainTH">Средняя розничная цена, руб</th>
        <th class="mainTH">Средняя оптовая цена, руб</th>
    </tr>
    <tr>
        <td width="25%"><?= warehouse1() ?></td>
        <td width="25%"><?= warehouse2() ?></td>
        <td width="25%"><?= averagePrice() ?></td>
        <td width="25%"><?= averageWholeSalePrice() ?></td>
    </tr>
</table></p>