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