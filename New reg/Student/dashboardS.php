<?php
session_start();
include "../mysql-connect.php";
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
    $sql = "SELECT * FROM user WHERE tID = '$userID'";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    $row = mysqli_fetch_assoc($result);
    $lname = $row['lName'];
    $fname = $row['fName'];
    $cid = $row['courseID'];
    $img = $row['imagePath'];

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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome <?php echo $lname . ' ' . $fname; ?></h1>
                </div>
                <!-- jumbo with teach info -->
                <div class="jumbotron text-center hoverable p-4">
                    <div class="row">
                        <div class="col-md-4 offset-md-1 mx-3 my-3">
                            <div class="view overlay">
                                <?php
                                echo '<img src="../images/' . $img . '" class="img-fluid" alt="Sample image for first version of blog listing">';
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7 text-md-left ml-3 mt-3">
                            <?php
                            echo '<h5 class="font-weight-normal">Hello Dear ' . $lname . '! Welcome to Online Exam system. In order to view available exams and register for one, input the examID that was given by teacher to the search input and press enroll. In order to take an exam  click "Take exam" and the list of all exams you registered for will be shown. In case you want to see statistic of exams click "Exam results"</h5>';
                            ?>
                            <div class="form-inline">
                                <div class="form-group mr-3 mb-2">
                                    <label for="examid" class="sr-only">Enter exam id</label>
                                    <input type="text" class="form-control" id="examid" placeholder="e.g 123">
                                </div>
                                <button onclick="showExam()" class="btn btn-primary mb-2">List available exams</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="examtext"></div>
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