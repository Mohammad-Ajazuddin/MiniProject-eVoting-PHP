<?php
    session_start();
    include ('../admin/check_session.php');
    $_SESSION['last_active_time'] = time();
    include("header.php");
    echo '
        <style>
            .outercontainer{
                margin: 7rem auto; 
                display:flex; 
                justify-content:center; 
                align-items:center; 
                gap:30px;
            }
            .container,.container p,table,tr,th,td{
                text-transform : uppercase;
            }
            .container{
                min-width:300px;
                max-width: fit-content;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap:20px;
                padding: 20px;
                background-color: white;
                border:1px solid grey;
                box-shadow: 2px 2px 2px 4px silver;
                translateY : 1.5;
                border-radius:5px;
            }
            .container p{
                font-weight : 600;
            }
            table,tr,th,td{
                border : 2px solid brown;
                border-collapse: collapse;
                text-align: center;
                padding : 10px;
            }
        </style>
    <div class="outercontainer">
        <div class="container">';
            $query = mysqli_query($cxn,"SELECT * FROM users WHERE username = '".$_SESSION['user']."'");
            $records = mysqli_fetch_assoc($query);
            $userid = $records['user_id'];
            $firstname = $records['firstname'];
            $lastname = $records['lastname'];
            $username = $_SESSION['user'];
        echo"<p>Firstname : $firstname</p>
            <p>Lastname : $lastname</p>
            <p>Username : $username</p>
            <p>Vote Details :</p>";
            $query = mysqli_query($cxn,"SELECT * FROM status WHERE user_id = '$userid'");
            if(mysqli_num_rows($query)==0)
            {
                echo '<p>Not Voted Yet</p>';
            }
            else{
                echo '
                    <table>
                        <tr>
                            <th>Election</th>
                            <th>Candidate ID</th>
                            <th>Candidate</th>
                        </tr>';
                while($records = mysqli_fetch_assoc($query))
                {
                    $query2 = mysqli_query($cxn,"SELECT * FROM elections WHERE election_id = '".$records['election_id']."'");
                    $row = mysqli_fetch_assoc($query2);
                    $election = $row['election_name'];
                    $candidateid = $records['candidate_id'];
                    $votedto = $records['voted_to'];
                echo"<tr>
                        <td>$election</td>
                        <td>$candidateid</td>
                        <td>$votedto</td>
                    </tr>";
                }
            }
            echo '</table>
        </div>
        <div style="display:flex; justify-content:center; align-items:center;">
                    <img src="../images/profile.gif" alt="illustration" width="400px"> 
        </div>
    </div>';
    include("../footer.php");
?>
