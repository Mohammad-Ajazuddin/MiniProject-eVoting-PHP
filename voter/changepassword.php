<?php
    session_start();
    include ('../admin/check_session.php');
    $_SESSION['last_active_time'] = time();
    include_once('header.php');
    echo '<title>Change Password</title>
        <div style="margin: 7rem auto; display:flex; justify-content:center; align-items:center; gap:30px;">
                <div style="display:flex; justify-content:center; align-items:center;">
                    <img src="../images/changepwd.gif" alt="illustration" width="400px"> 
                </div>
            <form method="post" id="forms" style="width:30%; height:fit-content;">
                <fieldset>
                    <legend>CHANGE PASSWORD</legend>
                    <label>Current Password</label>
                <input type="password" name="currentpassword" placeholder="Current Password" required>
                <label>New Password</label>
                <input type="password" name="newpassword" placeholder="New Password" required>
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" required>';
                ?>
                <?php
                    if(isset($_GET['incorrect'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">Incorrect current password</h4></div>';
                    }
                    if(isset($_GET['samepassword'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">Current password & new password is same!</h4></div>';
                    }
                    if(isset($_GET['nomatch'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">New password & confirm password do not match!</h4></div>';
                    }
                    if(isset($_GET['updated'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Password updated!</h4></div>';
                    }
                ?>
                <?php
                echo '<input type="submit" value="Change Pasword" name="changepassword" id="btn">
                </fieldset>
            </form>
        </div>';
        include('../footer.php');
    ?>

<?php
    if(isset($_POST['changepassword']))
    {
        $currentpassword = mysqli_real_escape_string($cxn,$_POST['currentpassword']);
        $newpassword = mysqli_real_escape_string($cxn,$_POST['newpassword']);
        $confirmpassword = mysqli_real_escape_string($cxn,$_POST['confirmpassword']);
        $username = $_SESSION['user'];
        $query = mysqli_query($cxn,"SELECT * FROM users WHERE username = '$username'");
        $record = mysqli_fetch_assoc($query);
        $passwordindb = $record['password'];
        echo $passwordindb;
        if($currentpassword == $passwordindb)
        {
            if(($newpassword==$confirmpassword) && ($newpassword!=$currentpassword))
            {
                $update = mysqli_query($cxn,"UPDATE users SET password='$newpassword' WHERE username = '$username'");
                ?>
                    <script>location.assign("changepassword.php?updated=1")</script>
                <?php
            }
            else if($newpassword==$currentpassword)
            {
                ?>
                    <script>location.assign("changepassword.php?samepassword=1")</script>
                <?php
            }
            else
            {
                ?>
                    <script>location.assign("changepassword.php?nomatch=1")</script>
                <?php
            }
        }
        else
        {
            ?>
                <script>location.assign("changepassword.php?incorrect=1")</script>
            <?php
        }  
    }
?>
