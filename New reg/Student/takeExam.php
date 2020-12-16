<?php
session_start();
include "../mysql-connect.php";
date_default_timezone_set("Asia/Almaty");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard Student</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="dashboard.css" rel="stylesheet">
    <script src="selectExam.js"></script>

</head>

<body>
    <?php
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $userID = $_SESSION['userID'];
    $sql = "SELECT examID FROM exam WHERE tID = '$userID'";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    $eidarr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $eidarr[] = $row['examID'];
    }
    ?>
    <!-- header -->
    <?php
    include "../Student/header.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php
            include "../Student/sidebarT.php";
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h2>Exam list</h2>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Exam title</th>
                            <th>Exam date</th>
                            <th>Start time</th>
                            <th>End Time</th>
                            <th>Number of questions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM exammain";
                        $result =  mysqli_query($connect, $sql);
                        if (!$result) {
                            die("Could not successfully run query." . mysqli_error($connect));
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($eidarr as $eid) {
                                if ($row['examID'] == $eid) {
                                    $dateflag = 'disabled';
                                    $eid = $row['examID'];
                                    $etitle = $row['examTitle'];
                                    $edate = $row['examDate'];
                                    $starttime = $row['startTime'];
                                    if (date("Y-m-d") == $row['examDate']) {
                                        $date = new DateTime("now", new DateTimeZone('Asia/Almaty'));
                                        if ($row['startTime'] <= $date->format('H:i') && $row['endTime'] >= $date->format('H:i')) {

                                            $dateflag = '';
                                        }
                                    }
                                    $endTime = $row['endTime'];
                                    $qnum = $row['questionNum'];
                                    print "<tr><td>" . $eid . "</td><td>" . $etitle . "</td><td>" . $edate . "</td><td>" . $starttime . "</td><td>" . $endTime . "</td><td>" . $qnum . "</td><td><form method='post' action='../Student/exam.php'><input type='hidden' name='examid' value='" . $eid . "'><input " . $dateflag . " type='submit' class='btn btn-danger btn-sm' value='Take exam' ></form></td></tr>";
                                }
                            }
                        }
                        ?>

                    </tbody>

                </table>
            </main>

        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

</body>

</html>