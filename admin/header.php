<?php
    //session_start();
    require_once("../connection.php");
    if(isset($_SESSION['key']))
    {
        if($_SESSION['key']!="admin")
        {
            echo "<script>location.assign('../login_register.php')</script>";
            die;
        }
    }
    else{
        echo "<script>location.assign('../login_register.php')</script>";
        die; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--title>e-Voting Admin</title-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/forms.css">
</head>
<body>
<header class="header">
    <nav>
        <div class="title">
            <a href="../index.php"><span style="font-size: 38px; color: red;">e</span><span style="font-size: 48px;">Vote</span></a>
        </div>
        <div class="navinks">
            <ul>
                <a href="index.php"><li>ADMIN PANEL</li></a>
                <a href="changepassword.php"><li>CHANGE PASSWORD</li></a>
                <a href="results.php"><li>VIEW RESULTS</li></a>
                <a href="../logout.php"><li>LOG OUT</li></a>
            </ul>
        </div>
    </nav>
</header>
    
