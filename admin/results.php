<?php
    session_start();
    include ('check_session.php');
    $_SESSION['last_active_time'] = time();
    if(isset($_SESSION['key']))
    {
        if($_SESSION['key']!="admin")
        {
            header('location:../login_register.php');
            die;
        }
        else{
            include("header.php");
            require_once("../connection.php");
            echo '<title>View Results</title>';
            echo '<div style="width:80%; margin: 5rem auto 0 auto; display:flex; justify-content:center;">
                    <form method="post" style="display:flex; flex-direction:column; min-width:400px; gap:10px;">
                        <select name="electionname" required>
                            <option value="">Select an Election</option>';
                            $get_user_id = mysqli_query($cxn, "SELECT * FROM users WHERE username='". $_SESSION['user'] ."'");
                            $record = mysqli_fetch_assoc($get_user_id);
                            $user_id = $record['user_id'];
                            $get_elections = mysqli_query($cxn,"SELECT * FROM elections WHERE admin_id = '". $user_id ."' ");
                            while($field = mysqli_fetch_assoc($get_elections))
                            {
                                echo '<option value="'. $field['election_name'] .'">'. $field['election_name'] .'</option>';  
                            }
                    echo '</select>
                        <input type="submit" name="viewresults" value="View Results" id="btn">
                    </form>
                </div>
                    <div style="width:80%; margin: auto; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                        <div style="width:80%; display:flex; flex-direction:column; gap:10px; padding:5px;">';
                            if(isset($_POST['viewresults']))
                            {
                                $electionname = mysqli_real_escape_string($cxn,$_POST['electionname']);
                                echo '<h3 style="font-style:italic; text-align:center; color: blue;">Election - '. $electionname .'</h3>';
                                $get_election_id = mysqli_query($cxn,"SELECT * FROM elections WHERE election_name='". $electionname ."'");
                                $get = mysqli_fetch_assoc($get_election_id);
                                $election_id = $get['election_id'];
                                $get_candidate_details = mysqli_query($cxn,"SELECT * FROM candidates WHERE election_id = '$election_id' ORDER BY votecount DESC");
                                $query = mysqli_query($cxn,"SELECT SUM(votecount) AS totalvotes FROM candidates WHERE election_id = '$election_id'");
                                $get_total_votes = mysqli_fetch_assoc($query);
                                $total_votes = $get_total_votes['totalvotes'];
                                //echo $total_votes;
                                if($total_votes==0)
                                {
                                    echo '<h4 style="font-style:italic; text-align:center; color: red;">No votes yet!</h4>';
                                }
                                else{
                                    echo '<h3 style="text-align:center;">Total voters voted = '.$total_votes.'</h3>';
                                while($details = mysqli_fetch_assoc($get_candidate_details))
                                {
                                    echo '<h4>Candidate ID - '. $details['candidate_id'] .' | '. $details['candidate_name'].' ('. $details['votecount'] .' VOTES)</h4>';
                                    ?>
                                        <div style="width:<?=@round(($details['votecount']/$total_votes)*100)+2?>%; background-color:green; color:white; text-align:center;">
                                                <?=@round(($details['votecount']/$total_votes)*100)?>%
                                        </div>
                                    <?php
                                }
                                }
                            }
                    echo '</div>
                    </div>';
        }
    }
    else{
        header('location:../login_register.php');
    }
    include_once("../footer.php");
?>
