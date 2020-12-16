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
    $eid = $_POST['examid'];
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $userID = $_SESSION['userID'];

    $sql = "SELECT * FROM questions WHERE examID = '$eid'";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
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
                <p>Instructions: Please answer all questions and press submit button</p>
                <div class="justify-content-center " id="questions">
                    <form action="checkExam.php" method="post">
                        <?php
                        echo "<input type='hidden' name='examid' value='" . $eid . "'>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            //identify if mcq or tf
                            if ($row['Qtype'] == 'mcq') {
                                echo "<div class='form-group'>
                            <h4>" . $row['QBody'] . "</h3>
                                <ol>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='1' />" . $row['opt1'] . "
                                    </li>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='2' />" . $row['opt2'] . "
                                    </li>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='3' />" . $row['opt3'] . "
                                    </li>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='4' />" . $row['opt4'] . "
                                    </li>
                                </ol>
                            </div>
                        <br/>";
                            } else if ($row['Qtype'] == 'tf') {
                                echo "<div class='form-group'>
                            <h4>" . $row['QBody'] . "</h3>
                                <ol>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='1' />" . $row['opt1'] . "
                                    </li>
                                    <li>
                                        <input type='radio' name='" . $row['qID'] . "' value='2' />" . $row['opt2'] . "
                                    </li>
                                </ol>
                            </div>
                        <br/>";
                            }
                        }
                        ?>

                        <div class="text-center">
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
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