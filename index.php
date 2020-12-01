<? require 'vendor/autoload.php';
require_once "countPages.php";
require_once "tableOutput.php"; ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href='css/stylesheet.css'/>
    <title>Список товаров</title>
</head>
<body>

<h1>Загрузите таблицу, чтобы добавить данные!</h1>

<div class="fileUpload">
    <div>
        <form method="post" id="importExcelForm" enctype="multipart/form-data">
            <input type="file" name="importExcel">
            <input type="submit" name="import" value="Загрузить" id="import">
        </form>
    </div>
</div>
<br>

<div id="message"></div>

<div>
    <form id="filter">
        <p>Показать товары, у которых:</p>
        <p>Тип купли-продажи: <select id="typeOfPrice">
                <option value="" disabled selected></option>
                <option value="wholesalePrice">Опт</option>
                <option value="price">Розница</option>
            </select></p>
        <p>Цена от <input type="text" name="minPrice" placeholder="1000" id="minPrice"> до <input type="text"
                                                                                                  name="maxPrice"
                                                                                                  placeholder="50000"
                                                                                                  id="maxPrice"> рублей.
        </p>
        <p>Наличие на складе <select id="selectedAmount">
                <option value="" disabled selected></option>
                <option value="1">не более</option>
                <option value="2">не менее</option>
            </select> <input type="text" name="amountNumber" id="amountNumber" placeholder="20"> штук.
        </p>
        <input type="submit" value="Показать товары">
    </form>
</div>

<div id="tableArea">
    <? include 'filter.php'; ?>
</div>

<div>
    <br><span>Данные по всей таблице:</span>
    <div id="avaliability">
        <? include 'productsParamsView.php'; ?>
    </div>
</div>
<div id="pageChoose">Выберете страницу
    <select name="pageSelect" id="pageSelect">
        <? include 'pageSelectView.php'; ?>
    </select>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/app.js"></script>
<script src="js/pagination.js"></script>
<script src="js/filter.js"></script>

</body>
</html>