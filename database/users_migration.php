<?php
require 'adlister_db_config.php';
require 'db_connect.php';

//outputs successful connection
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$deleteTable = 'DROP TABLE IF EXISTS users';

$dbc->exec($deleteTable);

$createTable = 'CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (email)
)';

$dbc->exec($createTable);