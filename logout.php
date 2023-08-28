<?php
    session_start();
    session_destroy();
    header("location:login_register.php?logout_success=1");
?>