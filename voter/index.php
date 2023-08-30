<?php
    session_start();
    include ('../admin/check_session.php');
    $_SESSION['last_active_time'] = time();
    //$_SESSION['electionid'];
    if (isset($_SESSION['key'])) {
        if ($_SESSION['key'] != "voter") {
            header('location:../login_register.php');
            die;
        }
        else 
        {
            function delayAndRedirect() {
                echo '<script>
                          setTimeout(function() {
                              window.location.href = "index.php";
                          }, 3000); // 3000 milliseconds (3 seconds) delay
                      </script>';
                exit;
            }

            include("header.php");
            require_once("../connection.php");
            echo '<title>Voter Dashboard</title>';
            echo '<div><h4 style="color:navy; font-style:italic; font-size:20px; margin-top:5rem; text-align:center;">Welcome ' . $_SESSION['user'] . '!</h4></div>';
            echo '<div style="width:80%; margin: 15px auto 0 auto; display:flex; justify-content:center;">
                    <form method="post" style="display:flex; flex-direction:column; min-width:400px; gap:10px;">
                        <select name="electionname" required>
                            <option value="">Select Election</option>';
                            $currdate = date('Y-m-d');
                            $query = mysqli_query($cxn,"SELECT * FROM elections WHERE start_date <= '$currdate' AND end_date>= '$currdate'");
                            while($records = mysqli_fetch_assoc($query))
                            {
                                echo '<option value="'. $records['election_name'] .'">'. $records['election_name'] .'</option>';
                            }
                    echo '</select>
                        <input type="password" name="accesskey" placeholder="Enter key shared by admin" required>
                        <input type="submit" value="Enter" name="enterelection" id="btn">
                       </form>';
                 echo '</div>';
                            if(isset($_GET['voted']))
                            {
                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Your Vote is Submitted!!</h4></div>
                                      <p style="text-align:center;">Redirecting in 3 seconds...</p>';
                                delayAndRedirect();
                            }
                            if(isset($_GET['alreadyvoted']))
                            {
                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">You can only vote once in an election!!</h4></div>
                                      <p style="text-align:center;">Redirecting in 3 seconds...</p>';
                                delayAndRedirect();
                            }
                        if(isset($_POST['enterelection']))
                        {
                            $election = mysqli_real_escape_string($cxn,$_POST['electionname']);
                            $accesskey = mysqli_real_escape_string($cxn,$_POST['accesskey']);
                            $query = mysqli_query($cxn,"SELECT * FROM elections WHERE election_name='$election'");
                            $record = mysqli_fetch_assoc($query);
                            $keyindb = $record['accesskey'];
                            if($accesskey != $keyindb)
                            {
                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">Invalid Access Key!!</h4></div>';
                            }
                            else if($accesskey == $keyindb)
                            {
                        echo '<style>
                                caption{
                                    padding:5px;
                                    font-size:16px;
                                    font-style: italic;
                                    font-weight:600;
                                    color:navy;
                                }
                                table{
                                    width:50%; 
                                    text-align:center;
                                }
                                table,th,td{
                                    padding: 5px;
                                    border: 2px solid navy;
                                    border-collapse: collapse;
                                }
                                td{
                                    text-transform:uppercase;
                                }
                            </style>
                            <div style="margin-top:10px; padding:5px;">';
                            echo '<form method="post" style="display:flex; flex-direction:column; align-items:center; justify-content:center; gap:15px;">';
                                $query1 = mysqli_query($cxn,"SELECT * FROM elections WHERE election_name = '$election'");
                                $record = mysqli_fetch_assoc($query1);
                                $electionid = $record['election_id'];
                                $_SESSION['electionid'] = $electionid;
                                $query2 = mysqli_query($cxn,"SELECT * FROM candidates WHERE election_id='$electionid'");
                            echo '<table>
                                    <caption>Election - '.$election.'</caption>
                                        <tr>
                                            <th>Candidate ID</th>
                                            <th>Candidate Name</th>
                                            <th>Select</th>
                                        </tr>';
                                while($record = mysqli_fetch_assoc($query2))
                                {
                                    echo '<tr>
                                            <td>'.$record['candidate_id'].'</td>
                                            <td>'.$record['candidate_name'].'</td>
                                            <td><input type="radio" name="candidateid" value='.$record['candidate_id'].' required></td>
                                        </tr>';
                                }
                                echo '</table>
                                      <input type="submit" name = "submitvote" value="Submit Vote" id="btn" style="width:200px;">  
                                    </form>
                                </div>';
                            }
                        }         
        }
    } 
    else {
        header('location:../login_register.php');
    }
    include('../footer.php');
?>

<?php
    if(isset($_POST['submitvote']))
    {
        $user = $_SESSION['user'];
        $query1 = mysqli_query($cxn,"SELECT * FROM users WHERE username = '$user'");
        $record = mysqli_fetch_assoc($query1);
        $userid = $record['user_id'];
        $electionid = $_SESSION['electionid'];
        //to check whether the user already voted in the election
        $query2 = mysqli_query($cxn,"SELECT * FROM status WHERE user_id = '$userid' AND election_id = '$electionid'");
        if(mysqli_num_rows($query2)>0)
        {   
            header("location:index.php?alreadyvoted=1");
            exit;
        }
        else{
            $candidateid = mysqli_real_escape_string($cxn,$_POST['candidateid']);
            $getcandidate = mysqli_query($cxn,"SELECT * FROM candidates WHERE candidate_id = '$candidateid'");
            $record = mysqli_fetch_assoc($getcandidate);
            $candidate = $record['candidate_name'];
            // echo $electionid;
            // echo $userid;
            // echo $candidate;
            $addvote = mysqli_query($cxn,"UPDATE candidates SET votecount = votecount+1 WHERE candidate_id = '$candidateid'");
            $updatestatus = mysqli_query($cxn,"INSERT INTO status (user_id,election_id,candidate_id,voted_to) VALUES('$userid','$electionid','$candidateid','$candidate')");
            if($addvote && $updatestatus)
            {
                header("location:index.php?voted=1");
                exit;
            }
        }
    }
?>
