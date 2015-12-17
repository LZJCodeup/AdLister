<?php

require 'adlister_db_config.php';
require 'db_connect.php';

//outputs successful connection
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$deleteTable = 'DROP TABLE IF EXISTS ads';

$dbc->exec($deleteTable);

$createTable = 'CREATE TABLE ads (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title  VARCHAR(50) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(50),    
    date_posted DATETIME NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    users_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories (id),
    FOREIGN KEY (users_id) REFERENCES users (id)
)';

$dbc->exec($createTable);