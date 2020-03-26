<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="bg">
<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "minismis";

    $conn = new mysqli($servername, $username, $password, $dbname);
?>
<?php
    include 'navbar.php';
?>
<div class="w-25 container bg-white p-5 mt-5 rounded border-top">
    <form action="addTeacher.php" method="post">
        <h7>Select a Teacher:</h7>
        <select name="teacher" class="p-1 form-control" placeholder="teacher">
            <?php
                $confirm = 1;
                $start = $_SESSION['tstart'];
                $end =  $_SESSION['tend'];
                $pop = $_SESSION['pop'];
                $day = $_SESSION['tday'];
                $subject = $_SESSION['subjName'];
                $sql  = "SELECT ID, fname, lname FROM users WHERE usertype='teacher'";
                $result = $conn->query($sql);
                //takes all teachers
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){   
                        //save teachers names and $ID
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $ID = $row['ID'];
                        //
                        $sql2 = "SELECT subjID FROM teachersched WHERE ID='".$row['ID']."'";
                        $result2 = $conn->query($sql2);
                        //takes all subjID from teachersched
                        if($result2->num_rows > 0){
                            while($row2 = $result2->fetch_assoc()){
                                $subjID = $row2['subjID'];
                                //takes all time
                                $sql3 = "SELECT tstart, tend FROM schedule WHERE subjID='$subjID' AND tday='$day'";
                                $result3 = $conn->query($sql3);
                                if($result3->num_rows > 0){
                                    while($row3 = $result3->fetch_assoc()){
                                        //compare inputted $start and database $tstart
                                        $tstart = $row3['tstart'];
                                        $tend= $row3['tend'];
                                        //if $start and $end is less than database $tstart then it fits in the sched,
                                        //or if $start is after database $tend
                                        if(($start < $tstart && $end<$tstart) || $start >= $tend){
                                        }else{
                                            //confirm variable, if schedule cannot fit then confirm says no
                                            $confirm=0;
                                        }
                                    }
                                }
                            }
                        }
                        //display teacher if confirm says yes
                        if($confirm==1){
                            //value is teacher ID for inserting later
                            echo "<option value='$ID'>".ucfirst($lname).", ".ucfirst($fname)."</option>";
                        }
                        //always set confirm back to yes
                        $confirm=1;
                    }
                } 
                else {
                    echo "<option value='teacher'>Error</option>";
                }
            ?>
        </select>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="w-50 col-md-8">
                <input type="submit" name="submit" class="rounded btn btn-success w-100 mb-3" value="Submit">
            </div>
            <div class="col-md-2"></div>
        </div>
    <?php
        if(isset($_POST['submit'])){
            $teacher = $_POST['teacher'];
            $start = $_SESSION['tstart'];
            $end =  $_SESSION['tend'];
            $pop = $_SESSION['pop'];
            $day = $_SESSION['tday'];
            $subject = $_SESSION['subjName'];
            $sql2 = "INSERT INTO teachersched (ID,  subjName, subjID, studPop) VALUES 
            ('$teacher', '$subject', null, '$pop')";
            if ($conn->query($sql2)===TRUE){
                $sql3 = "SELECT subjID FROM teachersched ORDER BY subjID DESC LIMIT 1";
                $result = ($conn->query($sql3))->fetch_assoc();
                $subjID = $result['subjID'];
                $sql = "INSERT INTO schedule (tday, tstart, tend, subjName, subjID) VALUES 
                ('$day', '$start','$end','$subject','$subjID')";
                if($conn->query($sql)===TRUE){
                    echo "<script language='javascript'>alert('Information Successfully Added!');";
                }else {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
            header("Location:admin.php");
        }
        ?>
    </form>
</div>
</body>
</html>