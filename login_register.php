<?php
    session_start();
    if(isset($_SESSION['key']))
    {
        if($_SESSION['key']=="admin")
        {
        ?>
            <script>location.assign("admin/index.php")</script>
        <?php
        }
        else if($_SESSION['key']=="voter")
        {
        ?>
            <script>location.assign("voter/index.php")</script>
        <?php
        }
    }
    else{
        $_SESSION['key']=null;
        $_SESSION['user']=null;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Voting - Register-Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-img">
                    <a href="index.php"><img class="login-img" src="images/vote.gif" alt="image"></a>
                </div>
                <?php
                // if(isset($_GET['registerred']))
                // {
                //     echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Registerred Successfully!</h4></div>';
                // }
                /*else if(isset($_GET['usernameexists']))
                    {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red; font-style:italic;">Username Exists. Try with another name!</h4></div>';
                    }  As this handles after submitting. Now handling before submitting*/
                ?>
                <?php
                if (isset($_GET['register'])) {
                    if (isset($_GET['registerred'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Registerred Successfully!</h4></div>';
                    }
                    if (isset($_GET['notregisterred'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:yellow;font-style:italic;">You are not registerred yet. Register Now!</h4></div>';
                    }
                    echo '<div class="col-lg-12 login-title">
                                USER REGISTRATION
                            </div>
                            
                            <div class="col-lg-12 login-form">
                                <div class="col-lg-12 login-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="form-control-label">FIRSTNAME</label>
                                            <input type="text" class="form-control" name="firstname" placeholder="Enter Your Firstname" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">LASTNAME</label>
                                            <input type="text" class="form-control" name="lastname" placeholder="Enter Your Lastname"  required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">USERNAME</label>
                                            <input type="text" class="form-control" name="reg_username" id="regusername" placeholder="Enter a username" required >
                                            <span id="username-exists-error" style="color: red; font-style: italic; font-weight: 400; display: none;">Username already exists. Try another name!</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">PASSWORD</label>
                                            <input type="password" class="form-control" name="password" minlength="6" placeholder="min 6 characters" required>
                                        </div>

                                        <div>
                                            <p class="form-control-label">ROLE</p>
                                            <label class="form-control-label"><input type="radio" name="role" value="voter" required>&nbsp;&nbspVOTER</label>
                                            <label class="form-control-label"><input type="radio" name="role" value="admin" required>&nbsp;&nbspADMIN</label>
                                        </div>
            
                                        <div class="col-lg-12 loginbttm">
                                            <div class="col-lg-6 login-btm login-text">
                                                <!--Message -->
                                            </div>
                                            <div class="col-lg-6 login-btm login-button">
                                                <button type="submit" name="reg-btn" class="btn btn-outline-primary" id="regbtn">REGISTER</button>
                                            </div>
                                            <div style="text-align: center;">
                                                <p style="color: aliceblue;">Already have an account?</p>
                                                <p><a href="login_register.php">LOGIN</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>';
                } else {
                    if(isset($_GET['logout_success']))
                    {
                        echo '<div><h4 style="color:red; text-align:center; font-style:italic;">Successfully Logged Out!</h4></div>';
                    }
                    if(isset($_GET['session_expired'])) {
                        
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:yellow;font-style:italic;">Session Expired!! Login again.</h4></div>';
                    }
                    echo '<div class="col-lg-12 login-title">
                                USER LOGIN
                            </div>
                            
                            <div class="col-lg-12 login-form">
                                <div class="col-lg-12 login-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="form-control-label">USERNAME</label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">PASSWORD</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
            
                                        <div class="col-lg-12 loginbttm">
                                            <div class="col-lg-6 login-btm login-text">
                                                <!-- Error Message -->
                                            </div>
                                            <div class="col-lg-6 login-btm login-button">
                                                <button type="submit" name="login-btn" class="btn btn-outline-primary">LOGIN</button>
                                            </div>';
                                             if(isset($_GET['invalid'])) {
                                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">Invalid username or password. Try again!</h4></div>';
                                            }
                                        echo '<div style="text-align: center;">
                                                <p style="color: aliceblue;">Do not have an account?</p>
                                                <p><a href="?register=1">Register Now</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>';
                }
                ?>

                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
        <script src="js/jquery_min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                let btnelement = document.getElementById('regbtn');
                $('#regusername').on('blur', function() {
                    var username = $(this).val().trim();
                    if (username !== '') {
                        $.ajax({
                            type: 'POST',
                            url: 'check_username.php',
                            data: {
                                username: username
                            },
                            success: function(data) {
                                if (data === '1') {
                                    $('#username-exists-error').show();
                                    $('button[name="reg-btn"]').prop('disabled', true);
                                    btnelement.style.background = 'red';
                                } else {
                                    $('#username-exists-error').hide();
                                    $('button[name="reg-btn"]').prop('disabled', false);
                                    btnelement.style.background = '';
                                }
                            }
                        });
                    }
                });
            });
        </script>

</body>

</html>

</body>

</html>

<?php
require_once("connection.php");
//For registration
if (isset($_POST['reg-btn'])) {
    $firstname = mysqli_real_escape_string($cxn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($cxn, $_POST['lastname']);
    $username = mysqli_real_escape_string($cxn, $_POST['reg_username']);
    $password = mysqli_real_escape_string($cxn, $_POST['password']);
    $role =  mysqli_real_escape_string($cxn, $_POST['role']);

    $checkusername = mysqli_query($cxn, "SELECT * FROM users WHERE username= '" . $username . "'");
    //inserts only if there are no records with such username.
    if (mysqli_num_rows($checkusername) == 0) {
        $insert_query = mysqli_query($cxn, "INSERT INTO users (username,firstname,lastname,password,role) VALUES ('" . $username . "','" . $firstname . "','" . $lastname . "','" . $password . "','". $role ."')");

        if (!$insert_query) {
            die(mysqli_error($cxn));
        } else { ?> <!-- As script cant be written in php closing php here.-->
            <script>
                location.assign("login_register.php?register=1&registerred=1")
            </script>
    <?php
        }
    }
    // else{
    ?>
    <!--script>location.assign("login_register.php?register=1&usernameexists=1")</script-->
    <?php
    // handling using another check_username.php and js }
}
//For login
else if (isset($_POST['login-btn'])) {
    $user_name = mysqli_real_escape_string($cxn, $_POST['username']);
    $loginpassword = mysqli_real_escape_string($cxn, $_POST['password']);

    $getrecords = mysqli_query($cxn, "SELECT * FROM users WHERE username = '" . $user_name . "'") or die(mysqli_error($cxn));
    //record existing in db
    if (mysqli_num_rows($getrecords) > 0) {
        $field = mysqli_fetch_assoc($getrecords); // array with fields

        if ($user_name == $field['username'] and $loginpassword == $field['password']) {
            $_SESSION['user'] = $field['username'];
            if ($field['role'] == "admin") {
                $_SESSION['key'] = "admin";
                    ?>
                    <script>
                        location.assign("admin/index.php")
                    </script>
                <?php
            } 
            else {
                $_SESSION['key'] = "voter";
            ?>
                <script>
                    location.assign("voter/index.php")
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                location.assign("login_register.php?invalid=1")
            </script>
        <?php
        }
    } 
    else {
        ?>
        <script>
            location.assign("login_register.php?register=1&notregisterred=1")
        </script>
<?php
    }
}
?>
