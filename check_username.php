<?php
    require_once("connection.php");
    $username = mysqli_real_escape_string($cxn, $_POST['username']);
    $checkusername = mysqli_query($cxn, "SELECT * FROM users WHERE username = '".$username."'");
    echo mysqli_num_rows($checkusername);
?>
