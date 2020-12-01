<?php
function numberOfPages($limit)
{
    $pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=brainforce", "root", "root");
    $statement = $pdo->prepare("SELECT COUNT(*) AS total FROM `products`");
    $statement->execute();
    $countProducts = $statement->fetchAll(PDO::FETCH_ASSOC);
    $numberOfPages = 1 + intdiv($countProducts[0]['total'], $limit);
    return array($numberOfPages, $countProducts[0]['total']);
}
