<?php
    session_start();
    include ('check_session.php');
    $_SESSION['last_active_time'] = time();
    if (isset($_SESSION['key'])) {
        if ($_SESSION['key'] != "admin") {
            header('location:../login_register.php');
            die;
        }
        else 
        {
            include("header.php");
            require_once("../connection.php");
            echo '<title>Admin Dashboard</title>';
            echo '<div><h4 style="color:navy; font-style:italic; font-size:20px; margin-top:5rem; text-align:center;">Welcome ' . $_SESSION['user'] . '!</h4></div>';
            echo '<div class="form-container">
                    <form method="post" id="forms">
                        <fieldset>
                            <legend>CREATE ELECTION</legend>
                            <label>Election</label>
                            <input type="text" name="election_name" placeholder="Election name" required>';
?>
                        <div style="display: flex;">
                            <label>Start </label>
                            <input type="date" name="start_date" min="<?php echo date('Y-m-d'); ?>" required>
                            <label> &nbsp;End </label>
                            <input type="date" name="end_date" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                            <label>Access Key</label>
                            <input type="password" name="accesskey" placeholder="Create a Key" required>
                            <input type="submit" value="Create Election" name="create_election" id="btn">

<?php
                            if (isset($_GET['election_exists'])) {
                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:red;font-style:italic;">Election Name Exists. Try a different name!</h4></div>';
                            }
                            if (isset($_GET['election_added'])) {
                                echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Election Added!</h4></div>';
                            }
                    echo '</fieldset>
                    </form>

                    <form method="post" id="forms">
                        <fieldset>
                            <legend>ADD CANDIDATE</legend>
                            <label>Select Election</label>
                            <select name="electionname" required>
                                <option value="">Select an Election</option>';
                                $get_user_id = mysqli_query($cxn, "SELECT * FROM users WHERE username='" . $_SESSION['user'] . "'");
                                $record = mysqli_fetch_assoc($get_user_id);
                                $user_id = $record['user_id'];
                                $get_elections = mysqli_query($cxn, "SELECT * FROM elections WHERE admin_id = '" . $user_id . "' ");
                                while ($field = mysqli_fetch_assoc($get_elections)) {
                                echo '<option value="' . $field['election_name'] . '">' . $field['election_name'] . ' | ' . $field['start_date'] . ' - ' . $field['end_date'] . '</option>';
                                }
                    echo '</select>
                        <label>Candidate Name</label>
                        <input type="text" name="candidatename" placeholder="Enter Candidate Name" required>
                        <input type="submit" value="Add Candidate" name="add_candidate" id="btn">';
                        if (isset($_GET['candidate_added'])) {
                            echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Candidate Added!</h4></div>';
                        }
            echo '</fieldset>
                    </form>

                    <form method="post" id="forms">
                        <fieldset>
                            <legend>DELETE ELECTION</legend>
                        <label>Select Election</label>
                        <select name="electionname" required>
                        <option value="">Select an Election</option>';
                        $get_user_id = mysqli_query($cxn, "SELECT * FROM users WHERE username='" . $_SESSION['user'] . "'");
                        $record = mysqli_fetch_assoc($get_user_id);
                        $user_id = $record['user_id'];
                        $get_elections = mysqli_query($cxn, "SELECT * FROM elections WHERE admin_id = '" . $user_id . "' ");
                        while ($field = mysqli_fetch_assoc($get_elections)) {
                        echo '<option value="' . $field['election_name'] . '">' . $field['election_name'] . ' | ' . $field['start_date'] . ' - ' . $field['end_date'] . '</option>';
                        }
                echo '</select>
                    <p style="padding-top:5px;"><h5 style="text-align:center; color:red;font-style:italic;">*Note: It\'s associated candidates are also deleted!</h5></p>
                    <input type="submit" value="Delete" name="delete_election" id="btn">';
                    if (isset($_GET['election_deleted'])) {
                        echo '<div style="padding-top:5px;"><h4 style="text-align:center; color:green;font-style:italic;">Election Deleted!</h4></div>';
                    }
            echo '</fieldset>
                    </form>
                </div>';
        }
    } 
    else {
        header('location:../login_register.php');
    }
?>

<?php
if (isset($_POST['create_election'])) {
    $electionname = mysqli_real_escape_string($cxn, $_POST['election_name']);
    $startdate = mysqli_real_escape_string($cxn, $_POST['start_date']);
    $enddate = mysqli_real_escape_string($cxn, $_POST['end_date']);
    $accesskey = mysqli_real_escape_string($cxn, $_POST['accesskey']);
    $check_election_name = mysqli_query($cxn, "SELECT * FROM elections WHERE election_name='" . $electionname . "'");
    if (mysqli_num_rows($check_election_name) > 0) {
?>
        <script>
            location.assign("index.php?election_exists=1")
        </script>
<?php
    } 
    else {
        $get_user_id = mysqli_query($cxn, "SELECT user_id FROM users WHERE username='" . $_SESSION['user'] . "'");
        $record = mysqli_fetch_assoc($get_user_id);
        $user_id = $record['user_id'];
        $insert_election = mysqli_query($cxn, "INSERT INTO elections (admin_id,election_name,start_date,end_date,accesskey) VALUES('" . $user_id . "','" . $electionname . "','". $startdate ."','". $enddate ."','" . $accesskey . "')");
    ?>
        <script>
            location.assign("index.php?election_added=1")
        </script>
    <?php
    }
}
if (isset($_POST['add_candidate'])) {
    $election = mysqli_real_escape_string($cxn, $_POST['electionname']);
    //echo $election;
    $candidatename = mysqli_real_escape_string($cxn, $_POST['candidatename']);
    //echo $candidatename;
    $get_election_id = mysqli_query($cxn, "SELECT election_id FROM elections WHERE election_name='" . $election . "'");
    $field = mysqli_fetch_assoc($get_election_id);
    $election_id = $field['election_id'];
    //echo $election_id;
    $insert_candidate = mysqli_query($cxn, "INSERT INTO candidates (election_id,candidate_name) VALUES('" . $election_id . "','" . $candidatename . "')");
    ?>
    <script>
        location.assign("index.php?candidate_added=1")
    </script>
    <?php
}
if (isset($_POST['delete_election'])) {
    $election = mysqli_real_escape_string($cxn, $_POST['electionname']);
    $delete_election = mysqli_query($cxn, "DELETE FROM elections WHERE election_name='" . $election . "'");
    if ($delete_election) {
    ?>
        <script>
            location.assign("index.php?election_deleted=1")
        </script>
<?php
    }
}
include_once("../footer.php");
?>
