<?php

require 'adlister_db_config.php';

require 'db_connect.php';

// First, add a query to delete all the records from the table.
$deleteTableContents = 'TRUNCATE categories';
$dbc->exec($deleteTableContents);

$allCategories = [
    ['category_name' => 'Cars'],
    ['category_name' => 'Trucks'],
    ['category_name' => 'RV'],
    ['category_name' => 'Diesel Trucks'],
    ['category_name' => 'Bikes']
];

$stmt = $dbc->prepare('INSERT INTO categories (category_name)
    VALUES (:category_name)');

foreach ($allCategories as $category) {
    $stmt->bindValue(':category_name', $category['category_name'], PDO::PARAM_STR);

    $stmt->execute();
}