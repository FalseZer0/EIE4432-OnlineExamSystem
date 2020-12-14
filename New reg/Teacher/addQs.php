<?php

if(isset($_POST['addq']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    
    $eid = $_POST['id']; 
    $qbody = $_POST['qbody'];
    $qans = $_POST['qans']; 
    $qtype = $_POST['qtype'];    
    $qpoints = $_POST['qpoints']; 
    $qop1 = $_POST['qop1'];
    $qop2 = $_POST['qop2']; 
    $qop3 = $_POST['qop3']; 
    $qop4 = $_POST['qop4'];  
    $sql = "INSERT INTO questions (examID, QBody, Qtype, Qanswer, points, opt1, opt2, opt3, opt4) VALUES ('$eid','$qbody', '$qtype', '$qans','$qpoints','$qop1','$qop2','$qop3','$qop4');";
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect) );
    }
    header("Location: ../Teacher/viewExamT.php");
    exit();
}
else{
    header("Location: ../Teacher/viewExamT.php?error=qerror");
    exit();
}


?>


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