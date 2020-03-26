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
    if(isset($_POST['subjName'])){
        $_SESSION['subjName'] = $_POST['subjName'];
    }
    if(isset($_POST['submit'])){
        $subject = $_POST['subjName'];
        $sql = "SELECT * FROM subjects WHERE subjName ='$subject'";
        $result = $conn->query($sql);
        if($result->num_rows == 0 ){
            $sql = "INSERT INTO subjects (subjName) VALUES ('$subject')";
            $conn->query($sql);
        }
    }
    if(isset($_POST['submitTime'])){

        $start = $_POST['start'];
        $end = $_POST['end'];
        $pop = $_POST['pop'];
        $day = $_POST['day'];
        $subject = $_SESSION['subjName'];
        if($start>=$end){
            echo "<h7 class='text-danger'>Please don't time travel</h7>";
        }else{
            $_SESSION['tstart'] = $start;
            $_SESSION['tend'] = $end;
            $_SESSION['pop'] = $pop;
            $_SESSION['tday'] = $day;
            header("Location:addTeacher.php");
        }
    }
?>
<?php
    include 'navbar.php';
?>
<div class="w-25 container bg-white p-5 mt-5 rounded border-top">
    <form action="addTime.php" method="post">
        <h7>Start:</h7>
        <select name="start" class="p-1 form-control mb-3" placeholder="Time Start">
            <?php
                $hour = 7; $minute  = 30; $value = 27000;
                while($hour<17){
                    echo "<option value='$value'>$hour:$minute</option>";
                    $minute += 30; $minute %= 60; $value +=1800;
                    if($minute == 0){
                        $minute = '00'; $hour++;
                    }
                }
            ?>
        </select>
        <h7>End:</h7>
        <select name="end" class="p-1 form-control mb-3" placeholder="Time Start">
            <?php
                $hour = 8; $minute  = 30; $value = 30600;
                while($hour<18){
                    echo "<option value='$value'>$hour:$minute</option>";
                    $minute += 30; $minute %= 60; $value +=1800;
                    if($minute == 0){
                        $minute = '00'; $hour++;
                    }
                }
            ?>
        </select>
        <h7>Maximum Number of Students:</h7>
        <select name="pop" class="p-1 form-control mb-3" placeholder="Time Start">
            <?php
                $pop = 5;
                while($pop<46){
                    echo "<option value='$pop'>$pop</option>";
                    $pop+=5;
                }
            ?>
        </select>
        <h7>Day:</h7>
        <select name="day" class="p-1 form-control mb-3">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="w-50 col-md-8">
                <input type="submit" name="submitTime" class="rounded btn btn-success w-100 mb-3" value="Submit">
            </div>
            <div class="col-md-2"></div>
        </div>
    </form>
</div>
</body>
</html>