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
<?php
    session_start();
    // if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 0){
    //     $_SESSION['error'] = 'Invalid Session!';
    //     header("Location: login.php");
    // }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "minismis";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<body class="bg">
<?php
    include 'navbar.php';
?>
<div class="w-75 mainbg container bg-white p-5 border-top">
    <div class="row">
        <!-- Subjects -->
        <div class="col-md-6">
            <div class="border p-3 h-100 m-1 border-success rounded">
                <h5>List of Subjects</h5>
                <ul>
                    <?php
                    $sql = "SELECT subjName FROM subjects ORDER BY subjName ASC";
                    $result = $conn->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            // subject name
                            echo "<li>".ucwords($row['subjName'])."</li>";
                            // display schedules of that subject
                            $sql2 = "SELECT tday, tstart, tend FROM schedule WHERE subjName='".$row['subjName']."'";
                            $result2 = $conn->query($sql2);
                            while($row2 = $result2->fetch_assoc()){
                                $start = $row2['tstart'];
                                $end = $row2['tend'];
                                $end = gmdate("H:i", $end);
                                $start = gmdate("H:i", $start);
                                // SEC_TO_TIME($start);
                                echo "<ul>";
                                echo "<li>".$row2['tday']. "&emsp;".$start."&emsp;".$end."</li>";
                                echo "</ul>";
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Student -->
        <div class="col-md-3">
            <div class="m-1 border p-3 h-100 border-success rounded">
                <h5>List of Students</h5>
                <ul>
                    <?php
                        $sql = "SELECT fname, lname FROM users WHERE usertype='student' ORDER BY lname ASC";
                        $result = $conn->query($sql);
        
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<li>".ucfirst($row['lname']).", ".ucfirst($row['fname'])."</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Teacher -->
        <div class="col-md-3">
            <div class="m-1 border p-3 h-100 border-success rounded">
                <h5>List of Teachers</h5>
                <ul>
                    <?php
                        $sql = "SELECT fname, lname FROM users WHERE usertype='teacher' ORDER BY lname ASC";
                        $result = $conn->query($sql);
        
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<li>".ucfirst($row['lname']).", ".ucfirst($row['fname'])."</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>