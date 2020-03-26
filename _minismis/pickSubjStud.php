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
<div class="w-25 container bg-white p-5 mt-5 rounded border-top">
    <form action="pickSubjStud.php" class="bg-white container" method="post">
        <h7>List of Subjects</h7><br>
        <select name="subject" class="form-control mb-3">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "minismis";
        
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT subjName FROM subjects ORDER BY subjName ASC";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $subjName = $row['subjName'];
                    echo "<option value='$subjName'>".ucwords($subjName)."</option>";
                    // subject name
                }
            }
            ?>
        </select>
        <input type="submit" name="submit" class="btn border-success" value="submit">
    </form>
    <?php
        session_start();
        if(isset($_POST['submit'])){
            $_SESSION['studSubjName'] = $_POST['subject'];
            // echo $_SESSION['studSubjName'];
            header("Location:chooseSchedStud.php");
        }
    ?>
</div>
</body>
</html>