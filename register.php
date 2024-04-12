<?php
// START THE SESSION
session_start();

include "dbsetup.php";

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function createUser($username, $password, $email)
{
    // SET UP DB CONNECTION
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db = "gamesdb";

    $connection = new mysqli($host, $db_username, $db_password, $db);

    // CHECK CONNECTION
    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
    }

    $hashed_password = hashPassword($password);

    $stmt = $connection->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute())
    {
        return true;
    }
    else
    {
        return false;
    }

    $connection->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
 
    // Create user account
    if (createUser($username, $password, $email))
    {
        echo ("User account created successfully!");
    }
    else
    {
        echo ("Error creating user account.");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register an account</title>
    <link rel="stylesheet" href="style.css"></link>
</head>
<body>
<div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
 
 
    </div>
   
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
 
        <input type="submit" value="Register">
 
    </form>
</body>
</html>