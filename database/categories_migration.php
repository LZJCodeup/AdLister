<?php
require 'adlister_db_config.php';
require 'db_connect.php';

//outputs successful connection
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$deleteTable = 'DROP TABLE IF EXISTS categories';

$dbc->exec($deleteTable);

$createTable = 'CREATE TABLE categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(15) NOT NULL,
    PRIMARY KEY (id)
)';

$dbc->exec($createTable);