<?php
// START THE SESSION
session_start();

include "dbsetup.php";

// Function to authenticate user
function authenticateUser($username, $password)
{
    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "gamesdb";
 
    $connection = new mysqli($host, $username, $password, $db);
 
    // Check connection
    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
    }
 
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result->num_rows == 1)
    {
        $user = $result->fetch_assoc();
 
        if (password_verify($password, $user['password']))
        {
            $connection->close();
            return $user;
        }
    }
 
    return null;
}

// Login process
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = authenticateUser($username, $password);
 
    if ($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Redirect to dashboard after successful login
        exit();
    }
    else
    {
        $login_error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Game site home</title>
    <link rel="stylesheet" href="style.css"></link>
</head>
 
<body>
 
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Game library</a>
        <a href="#about">Contact</a>
        
<?php

if (!isset($_SESSION['user_id']))
{
    echo("<a href='login.php'>Login</a>");
}
else
{
    echo("<a href='logout.php'>Log out</a>");
}
 
?>
 
    </div>
 
</body>
 
</html>