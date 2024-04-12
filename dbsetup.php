<?php
// SET UP DATABASE FOR THE APPLICATION

// SET UP MYSQL CONNECTION
$host = "localhost";
$username = "root";
$password = "";

$connection = new mysqli($host, $username, $password);

// CHECK CONNECTION WORKS
if ($connection->connect_error)
{
    die("Connection failed: " . $connection->connect_error);
}
else
{
    echo("dbsetup: connection good");
}

// CREATE THE DATABASE FOR THE APPLICATION
$sql_create_db = "CREATE DATABASE IF NOT EXISTS gamesdb";
if ($connection->query($sql_create_db) === true)
{
    echo("Database gamesdb created successfully");
}
else
{
    echo("<br>Error creating database: " . $connection->error);
}

$connection->select_db("gamesdb");

// creates the users table with three fields: ID, username and password
    // the ID field is the primary key for the table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    )";
 
    if ($connection->query($sql) === TRUE)
    {
        echo ("Table 'users' created successfully");
    }
    else
    {
        echo ("Error creating table: " . $connection->error);
    }

// create a table in the selected database
// specifies three fields: ID, name and email
// The ID field is the primary key for the table
$sql = "CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT,
    description TEXT,
    image_path VARCHAR(255) NOT NULL
)";
 
if ($connection->query($sql) === TRUE)
{
    echo "Table 'games' created successfully";
}
else
{
    echo "Error creating table: " . $connection->error;
}

// SHUTS DOWN THE DB CONNECTION
$connection->close();

?>