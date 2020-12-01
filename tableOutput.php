<?php
function getProducts($limit, $offset)
{
    $pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=brainforce", "root", "root");
    $statement = $pdo->prepare("SELECT * FROM products");
    $statement->execute();
    return $products = $statement->fetchAll(PDO::FETCH_ASSOC);
}