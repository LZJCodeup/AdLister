<?php

require 'adlister_db_config.php';

require 'db_connect.php';

// First, add a query to delete all the records from the table.
$deleteTableContents = 'TRUNCATE ads';
$dbc->exec($deleteTableContents);

$allAds = [
    ['title' => 'Car For Sale', 'price' => 30000.00, 'description' => 'Honda car for sale.', 'image' => 'uploads/placeholder.png', 'date_posted' => '2015-12-17 00:00:00', 'category_id' => 1, 'users_id' => 1],
    ['title' => 'Truck For Sale', 'price' => 40000.00, 'description' => 'Truck car for sale.', 'image' => 'uploads/placeholder.png', 'date_posted' => '2015-12-17 00:00:00', 'category_id' => 2, 'users_id' => 2],
    ['title' => 'RV For Sale', 'price' => 15000.00, 'description' => 'RV car for sale.', 'image' => 'uploads/placeholder.png', 'date_posted' => '2015-12-17 00:00:00', 'category_id' => 3, 'users_id' => 3],
    ['title' => 'Diesel Truck For Sale', 'price' => 35000.00, 'description' => 'Diesel car for sale.', 'image' => 'uploads/placeholder.png', 'date_posted' => '2015-12-17 00:00:00', 'category_id' => 4, 'users_id' => 1],
    ['title' => 'Bike For Sale', 'price' => 50000.00, 'description' => 'Bike car for sale.', 'image' => 'uploads/placeholder.png', 'date_posted' => '2015-12-17 00:00:00', 'category_id' => 5, 'users_id' => 2],
];

$stmt = $dbc->prepare('INSERT INTO ads (title, price, description, image, date_posted, category_id, users_id)
    VALUES (:title, :price, :description, :image, :date_posted, :category_id, :users_id)');

foreach ($allAds as $ad) {
    $stmt->bindValue(':title', $ad['title'], PDO::PARAM_STR);
    $stmt->bindValue(':price', $ad['price'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
    $stmt->bindValue(':image', $ad['image'], PDO::PARAM_STR);
    $stmt->bindValue(':date_posted', $ad['date_posted'], PDO::PARAM_STR);
    $stmt->bindValue(':category_id', $ad['category_id'], PDO::PARAM_INT);
    $stmt->bindValue(':users_id', $ad['users_id'], PDO::PARAM_INT);

	$stmt->execute();
}