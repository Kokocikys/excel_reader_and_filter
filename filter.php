<?php

$selectedAmount = trim($_POST["selectedAmount"]);
$typeOfPrice = trim($_POST["typeOfPrice"]);
$minPrice = trim($_POST["minPrice"]);
$maxPrice = trim($_POST["maxPrice"]);
$amountNumber = trim($_POST["amountNumber"]);

$errors = array();

if ($minPrice != '') {
    if (!preg_match("/^[ 0-9]+$/", $minPrice)) {
        $errors['minPriceError'] = "Допустим ввод только цифр!";
    }
}
if ($maxPrice != '') {
    if (!preg_match("/^[ 0-9]+$/", $maxPrice)) {
        $errors['maxPriceError'] = "Допустим ввод только цифр!";
    }
}
if ($amountNumber != '') {
    if (!preg_match("/^[ 0-9]+$/", $amountNumber)) {
        $errors['amountNumberError'] = "Допустим ввод только цифр!";
    }
}

if (!empty($errors)) {
    echo 'Ошибки ввода параметров!';
    die;
} else {

    $pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=brainforce", "root", "root");
    $sql = "SELECT * FROM products WHERE id > 0";

    if (empty($typeOfPrice)) {
        if (!empty($minPrice)) {
            $sql .= " AND price >= :minPrice AND wholesalePrice >= :minPrice ";
        }
        if (!empty($maxPrice)) {
            $sql .= " AND price <= :maxPrice AND wholesalePrice <= :maxPrice ";
        }
    } else {
        if ($typeOfPrice == 'wholesalePrice') {
            if (!empty($minPrice)) {
                $sql .= " AND wholesalePrice >= :minPrice ";
            }
            if (!empty($maxPrice)) {
                $sql .= " AND wholesalePrice <= :maxPrice ";
            }
        }
        if ($typeOfPrice == 'price') {
            if (!empty($minPrice)) {
                $sql .= " AND price >= :minPrice ";
            }
            if (!empty($maxPrice)) {
                $sql .= " AND price <= :maxPrice ";
            }
        }
    }
    $val1 = 0;
    if (!empty($selectedAmount) && !empty($amountNumber)) {
        if ($selectedAmount == 1) {
            $val1 = 1;
            $sql .= " AND ( availabilityInWarehouse1 <= :amountNumber AND availabilityInWarehouse2 <= :amountNumber ) ";
        }
        if ($selectedAmount == 2) {
            $val1 = 1;
            $sql .= " AND ( availabilityInWarehouse1 >= :amountNumber AND availabilityInWarehouse2 >= :amountNumber ) ";
        }
    }
    $page = isset ($_GET['page']) ? $_GET['page'] : 1;
    $limit = 25;
    $offset = $limit * ($page - 1);
    $sql .= " LIMIT $limit OFFSET $offset";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':minPrice', $minPrice);
    $statement->bindValue(':maxPrice', $maxPrice);
    if ($val1 == 1) {
        $statement->bindValue(':amountNumber', $amountNumber);
    }
    $statement->execute();
    $filtredProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

    include 'filtredTableView.php';
}