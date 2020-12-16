<?php
session_start();
include "../mysql-connect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard Teacher</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="dashboard.css" rel="stylesheet">

</head>

<body>
    <?php
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $userID = $_SESSION['userID'];
    if (!isset($_GET['id'])) {
        header("Location: ../Teacher/viewExamT.php");
        exit();
    }
    $eid = $_GET['id'];
    $sql = "SELECT tID FROM exam WHERE examID = '$eid'";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    $tidarr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tidarr[] = $row['tID'];
    }
    ?>
    <!-- header -->
    <?php
    include "../Teacher/header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php
            include "../Teacher/sidebarT.php";
            ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <h2>Exam statistics</h2>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Fullname</th>
                            <th>Student`s score</th>
                            <th>Maximum score</th>
                            <th>Submitted time</th>
                            <th>Details</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM user WHERE job = 'student'";
                        $result =  mysqli_query($connect, $sql);
                        if (!$result) {
                            die("Could not successfully run query." . mysqli_error($connect));
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($tidarr as $tid) {
                                if ($tid == $row['tID']) {
                                    print "<tr><td>" . $row['tID'] . "</td><td>" . $row['lName'] . " " . $row['fName'] . "</td>";
                                    $sql1 = "SELECT * FROM mark WHERE tID = '$tid' AND examID = '$eid'";
                                    $result1 =  mysqli_query($connect, $sql1);
                                    if (!$result1) {
                                        die("Could not successfully run query." . mysqli_error($connect));
                                    }
                                    $row1 = mysqli_fetch_assoc($result1);
                                    print "<td>" . $row1['grade'] . "</td><td>" . $row1['maxscore'] . "</td>";
                                    //3
                                    $sql3 = "SELECT * FROM exam WHERE tID = '$tid' AND examID = '$eid'";
                                    $result3 =  mysqli_query($connect, $sql3);
                                    if (!$result3) {
                                        die("Could not successfully run query." . mysqli_error($connect));
                                    }
                                    $row3 = mysqli_fetch_assoc($result3);
                                    print "<td>" . $row3['submitTime'] . "</td>";
                                    print "<td><form method='post' action='../Teacher/studentResultDetails.php'><input type='hidden' name='examid' value='" . $eid . "'><input type='hidden' name='tid' value='" . $tid . "'><input type='submit' name='viewd' class='btn btn-danger btn-sm' value='View details'></form></td>";
                                    print "</tr>";
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