<?php
    //not starting session here as this file is included in files where sessionis already started.
    if(isset($_SESSION['last_active_time'])){
        if((time() - $_SESSION['last_active_time'])>900)//15 mins
        {
            session_destroy();
            header('location:../login_register.php?session_expired=1');
            die;
        }
    }
    else{
        $_SESSION['last_active_time'] = time();
    }
?>
