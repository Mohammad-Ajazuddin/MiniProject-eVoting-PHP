<?php
    session_start();
?>
<!--DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Voting - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body-->
    <?php
    include 'header.php';
    echo '
    <div class="hero">
        <div class="hero-content">
            <h2>Welcome to e-Voting! You need to register first to vote.</h2>
            <p>Voting made easy!</p>
        </div>
        <div>
            <img src="images/herogif.gif" alt="illustration" width="500" height="500">
        </div>
    </div>
    <div class="features-container">
        <h2 style="text-align:center;">FEATURES</h2>
        <section class="features">
            <div class="feature">
                <img src="images/Register.png" alt="Registration Icon">
                <h2>Register as Voter/Admin</h2>
                <p>Sign up to participate in elections as a voter or an admin. Choose your role and create a unique username for access.</p>
            </div>

            <div class="feature">
                <img src="images/admins.png" alt="Multiple admins icon">
                <h2>Multiple Admins</h2>
                <p>Any user can register as an Admin with a unique username & conduct his/her elections. Admins can create & manage elections. Set start & end dates, assign an access key to participate in election.</p>
            </div>

            <div class="feature">
                <img src="images/date.png" alt="calendar Icon">
                <h2>Time bound Elections</h2>
                <p>Explore & participate in ongoing elections conducted by various admins. Admins can specify start & end date of elections. Only ongoing elections are displayed to users</p>
            </div>
        </section>

        <section class="features">
            <div class="feature">
                <img src="images/key.png" alt="key icon">
                <h2>Access Key</h2>
                <p>Each election has an access key. As there are multiple elections, users can participate in an election with an access key which is shared by the admin.</p>
            </div>

            <div class="feature">
                <img src="images/vote.png" alt="one vote per election">
                <h2>Fair Voting</h2>
                <p>Each voter can cast only one vote per election to ensure fairness & accuracy in the elections.</p>
            </div>
    
            <div class="feature">
                <img src="images/result.png" alt="Graph Icon">
                <h2>View Results</h2>
                <p>Admins can view real-time results.</p>
        </section>
        <div class="buttons">
            <a href="login_register.php?register=1" class="button1">Register</a>
            <a href="login_register.php" class="button2">Login</a>
        </div>
    </div>
    
<section class="team">
  <h2>OUR TEAM</h2>
  <div class="team-member">
    <img src="images/Ajaz.jpg" alt="Team Member 1">
    <a href="https://www.linkedin.com/in/mohammad-ajazuddin" target="_blank"><h3>MOHAMMAD AJAZUDDIN</h3></a>
    <p>B182123</p>
  </div>
  
  <div class="team-member">
    <img src="images/Athiya.jpeg" alt="Team Member 2">
    <a href="https://www.linkedin.com/in/kousar-begum-b5aa05269" target="_blank"><h3>KOUSAR BEGUM</h3></a>
    <p>B182117</p>
  </div>
  
   <div class="team-member">
    <img src="images/Poojitha.jpeg" alt="Team Member 3">
    <a href="https://www.linkedin.com/in/poojitha-mangilipelli-220240270" target="_blank"><h3>MANGILIPELLI POOJITHA</h3></a>
    <p>B181533</p>
  </div>
     
   <div class="team-member">
    <img src="images/Akhilesh.jpeg" alt="Team Member 4">
    <a href="https://www.linkedin.com/in/pujam-akhilesh-029205225" target="_blank"><h3>PUJAM AKHILESH</h3></a>
    <p>B182591</p>
  </div>
</section>
<footer class="footer">
  <div class="footer-content">';?>
    <p>&copy;&nbsp;<?php echo date('D-M-Y') ?> | eVoting Platform</p>
    <p>By the students of RGUKT-B</p>
  </div>
</footer>