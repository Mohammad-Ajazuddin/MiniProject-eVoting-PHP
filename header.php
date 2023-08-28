<?php
    //session_start();
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>e-Voting - Home</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body style="min-height:100vh;">
    <header class="header">
    <nav>
        <div class="title">
            <a href="index.php"><span style="font-size: 38px; color: red;">e</span><span style="font-size: 48px;">Vote</span></a>
        </div>
        <div class="navinks">
            <ul>';
                if(isset($_SESSION['key']) && $_SESSION['key']=="admin")
                {
                    echo '
                    <a href="admin/index.php"><li>ADMIN PANEL</li></a>
                    <a href="admin/changepassword.php"><li>CHANGE PASSWORD</li></a>
                    <a href="admin/results.php"><li>VIEW RESULTS</li></a>
                    <a href="logout.php"><li>LOG OUT</li></a>';
                }
                else if(isset($_SESSION['key']) && $_SESSION['key']=="voter")
                {
                    echo '
                    <a href="voter/index.php"><li>VOTE NOW</li></a>
                    <a href="voter/changepassword.php"><li>CHANGE PASSWORD</li></a>
                    <a href="voter/profile.php"><li>PROFILE</li></a>
                    <a href="logout.php"><li>LOG OUT</li></a>';
                }
                else{
                    echo '<a href="login_register.php?register=1"><li>REGISTER</li></a>
                    <a href="login_register.php"><li>LOGIN</li></a>';
                }
                
            echo '</ul>
        </div>
    </nav>
</header>';
?>