<?php

require 'adlister_db_config.php';

require 'db_connect.php';

// First, add a query to delete all the records from the table
$deleteTableContents = 'TRUNCATE users';
$dbc->exec($deleteTableContents);

$allUsers = [
    ['email' => 'letty@codeup.com', 'first_name' => 'Letty', 'last_name' => 'Fuentes',
     'password' => password_hash('fuentes', PASSWORD_DEFAULT) ],
    ['email' => 'zach@codeup.com', 'first_name' => 'Zack', 'last_name' => 'Gulde',
     'password' => password_hash('gulde', PASSWORD_DEFAULT)],
    ['email' => 'jerald@codeup.com', 'first_name' => 'Jerald', 'last_name' => 'Saenz',
     'password' => password_hash('saenz', PASSWORD_DEFAULT)]
];

$stmt = $dbc->prepare('INSERT INTO users (email, first_name, last_name, password)
    VALUES (:email, :first_name, :last_name, :password)');

foreach ($allUsers as $user) {
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':first_name', $user['first_name'], PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $user['last_name'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);

    $stmt->execute();
}
