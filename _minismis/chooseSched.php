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
    include 'studentnavbar.php';
?>
<div class="w-50 container bg-white p-5 mt-5 rounded border-top">
    <h7>Choose a Schedule:</h7>
    <form action="chooseSchedStud.php" class="bg-white container" method="post">
        <select name="schedule" class="form-control mb-3 rounded">
            <?php
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "minismis";
        
            $conn = new mysqli($servername, $username, $password, $dbname);
            $subjName = $_SESSION['studSubjName'];
            // display schedules of that subject
            $sql2 = "SELECT tday, tstart, tend, subjID FROM schedule WHERE subjName='$subjName'";
            $result2 = $conn->query($sql2);
            while($row2 = $result2->fetch_assoc()){
                $subjID = $row2['subjID'];
                $start = $row2['tstart'];
                $end = $row2['tend'];
                $end = gmdate("H:i", $end);
                $start = gmdate("H:i", $start);
                echo "<option value='$subjID'>".$row2['tday']. "&emsp;".$start."&emsp;".$end."</option>";
            }
            ?>
        </select>
        <input type="submit" name="submit" class="btn border-success" value="submit">
    </form>
    <?php
        $studID = $_SESSION['studID'];
        if(isset($_POST['submit'])){
            $subject = $_SESSION['studSubjName'];
            $subjID = $_POST['schedule'];
            $sql = "INSERT INTO enrolledstud(ID, subjName, subjID) VALUES ('$studID', '$subject', '$subjID')";
            if($conn->query($sql)===TRUE){
                header("Location:student.php");
            }
        }
    ?>
</div>
</body>
</html>