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
                <h2>Create Exam</h2>
                <div class="create_form">
                    <form action="newExam.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputeTitle">Exam Title</label>
                                <input type="text" name="etitle" class="form-control" id="inputeTitle" placeholder="e.g HTML basics">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exam-date-input">Exam Date</label>
                                <input class="form-control" name="edate" type="date" placeholder="2011-08-19" id="exam-date-input">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="examp-time-input">Exam Start Time</label>
                                <input class="form-control" name="estime" type="time" placeholder="13:45:00" id="examp-stime-input">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exam-date-input">Exam End Time</label>
                                <input class="form-control" name="eetime" type="time" placeholder="13:45:00" id="examp-etime-input">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exam-date-input">Question Number</label>
                                <input class="form-control" name="enum" type="text" id="exam-qnum-input">
                            </div>
                        </div>
                        <!-- <div class="jumbotron mt-2">
                            <button type="button" id="removeQuestion" class="btn btn-danger">Delete question</button>
                            <div class="form-group">
                                <label for="QTextarea">Question</label>
                                <textarea class="form-control" id="QTextarea" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Answer</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputQtype">Type</label>
                                    <select id="inputQtype" class="form-control">
                                        <option selected>Choose...</option>
                                        <option value="mcq">Multiple choice question</option>
                                        <option value="tf">True/False</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="points">Points</label>
                                    <input type="text" class="form-control" id="points">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="o1">Option 1</label>
                                <input type="text" class="form-control" id="o1" placeholder="Must be filled">
                                <label for="o2">Option 2</label>
                                <input type="text" class="form-control" id="o2" placeholder="Must be filled">
                                <label for="o3">Option 3</label>
                                <input type="text" class="form-control" id="o3" placeholder="Ignore if T/F">
                                <label for="o4">Option 4</label>
                                <input type="text" class="form-control" id="o4" placeholder="Ignore if T/F">
                            </div>
                        </div> -->
                        <button type="submit" name="CreateEx" class="btn btn-primary">Create exam</button>
                    </form>
                </div>

            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    <script src="createExam.js"></script>

</body>

</html>