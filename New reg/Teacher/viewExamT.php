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
  include "../Teacher/header.php";
  ?>

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php
      include "../Teacher/sidebarT.php";
      ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>Exams</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Exam ID</th>
                <th>Exam title</th>
                <th>Exam date</th>
                <th>Start time</th>
                <th>End Time</th>
                <th>Question number</th>
                <th>Add question</th>
                <th>View questions</th>
                <th>Delete exam</th>
                <th>Exam Statistics</th>
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
                    $eid = $row['examID'];
                    $etitle = $row['examTitle'];
                    $edate = $row['examDate'];
                    $starttime = $row['startTime'];
                    $endTime = $row['endTime'];
                    $qnum = $row['questionNum'];
                    print "<tr><td>" . $eid . "</td><td>" . $etitle . "</td><td>" . $edate . "</td><td>" . $starttime . "</td><td>" . $endTime . "</td><td>" . $qnum . "</td><td><button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#" . $eid . "'>Add question</button></td><td> <a type='button' href='../Teacher/showQ.php?id=" . $eid . "' class='btn btn-info btn-sm'>View question</a></td><td><a type='button' href='../Teacher/deleteEx.php?id=" . $eid . "' class='btn btn-danger btn-sm'>Delete exam</a></td> <td><a type='button' href='../Teacher/examResults.php?id=" . $eid . "' class='btn btn-success btn-sm'>Exam Statistics</a></td></tr>";
                    print '                  
                  <!-- Modal -->
                  <div class="modal fade" id="' . $eid . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">

                          <h5 class="modal-title">Add question</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form  class="form" action="addQs.php" method="post">
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="QTextarea">Question</label>
                                <textarea name="qbody" class="form-control" id="QTextarea" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Answer</label>
                                    <input name="qans" type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputQtype">Type</label>
                                    <select name="qtype" id="inputQtype" class="form-control">
                                        <option selected>Choose...</option>
                                        <option value="mcq">Multiple choice question</option>
                                        <option value="tf">True/False</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="points">Points</label>
                                    <input name="qpoints" type="text" class="form-control" id="points">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="o1">Option 1</label>
                                <input name="qop1" type="text" class="form-control" id="o1" placeholder="Must be filled">
                                <label for="o2">Option 2</label>
                                <input name="qop2" type="text" class="form-control" id="o2" placeholder="Must be filled">
                                <label for="o3">Option 3</label>
                                <input name="qop3" type="text" class="form-control" id="o3" placeholder="Ignore if T/F">
                                <label for="o4">Option 4</label>
                                <input name="qop4" type="text" class="form-control" id="o4" placeholder="Ignore if T/F">
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addq" class="btn btn-primary">Add qustion</button>
                                <input type="hidden" name="id" value="' . $eid . '"/>   
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>';
                  }
                }
              }

              ?>

            </tbody>
          </table>
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

</body>

</html>