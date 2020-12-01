<?php

function DBOperations($sql)
{
    $pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=brainforce", "root", "root");
    $statement = $pdo->prepare($sql);
    return $statement;
}

function warehouse1()
{
    $statement = DBOperations("SELECT SUM(availabilityInWarehouse1) as sum FROM products");
    $statement->execute();
    $commonAvailabilityInWarehouse1 = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $commonAvailabilityInWarehouse1[0]['sum'];
}

function warehouse2()
{
    $statement = DBOperations("SELECT SUM(availabilityInWarehouse2) as sum FROM products");
    $statement->execute();
    $commonAvailabilityInWarehouse2 = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $commonAvailabilityInWarehouse2[0]['sum'];
}

function averagePrice()
{
    $statement = DBOperations("SELECT AVG(price) as price FROM products");
    $statement->execute();
    $averagePrice = $statement->fetchAll(PDO::FETCH_ASSOC);
    return round($averagePrice[0]['price'], 2);
}

function averageWholeSalePrice()
{
    $statement = DBOperations("SELECT AVG(wholeSalePrice) as wholeSalePrice FROM products");
    $statement->execute();
    $averageWholeSalePrice = $statement->fetchAll(PDO::FETCH_ASSOC);
    return round($averageWholeSalePrice[0]['wholeSalePrice'], 2);
}

function maxPrice()
{
    $statement = DBOperations("SELECT MAX(price) AS maxPrice FROM products");
    $statement->execute();
    $maxPrice = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $maxPrice[0]['maxPrice'];
}

function minWholesalePrice()
{
    $statement = DBOperations("SELECT MIN(wholeSalePrice) AS minPrice FROM products");
    $statement->execute();
    $maxPrice = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $maxPrice[0]['minPrice'];
}

function lowAmount()
{
    $statement = DBOperations("SELECT * FROM products WHERE availabilityInWarehouse1 < '20' OR availabilityInWarehouse2 < '20'");
    $statement->execute();
    $lowAmounts = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($lowAmounts as $lowAmount) {
        $productName = $lowAmount['productName'];
        $statement = DBOperations("UPDATE products SET note = 'Осталось мало единиц товара! Срочно пополните склад!' WHERE productName = '$productName';");
        $statement->execute();
    }
}