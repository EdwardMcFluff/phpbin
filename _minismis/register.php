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
<body class="bg-success bg">
<?php
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
<div class="w-100 nav bg-white">
    <div class="float-left">
        <img src="https://www.clopified.com/wp-content/uploads/2019/04/university-of-san-carlos-logo.png" class="logo pl-2" alt="Logo">        
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <form action="register.php" class="rounded p-5 leftmarg bg-white" method="post">
            <input type="text" class="rounded form-control mb-3" name="fname" placeholder="First Name">
            <input type="text" class="rounded form-control mb-3" name="lname" placeholder="Last Name">
            <input type="email" class="rounded form-control mb-3" name="email" placeholder="Email">
            <select name="usertype" class="p-1 rounded form-control mb-3" placeholder="teacher">
                <option value="Student">Student</option>
                <option value="Teacher">Teacher</option>
            </select>
            <input type="password" class="rounded form-control mb-3" name="pass" placeholder="Password">
            <input type="password" class="rounded form-control mb-3" name="conpass" placeholder="Confirm Password">
            <div class="row mb-3">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <input type="submit" name ="register" class="rounded btn btn-success w-100" value="Register">
                </div>
                <div class="col-md-2"></div>
            </div>
            <?php
            if(isset($_POST['register'])){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $usertype = $_POST['usertype'];
                $pass = $_POST['pass'];
                $conpass = $_POST['conpass'];
                $temp = "SELECT * FROM users WHERE email='$email'";
                if($pass == $conpass){
                    $connquery = $conn->query($temp);
                    $connquery->fetch_assoc();
                    if($connquery->num_rows < 1){
                        $insert = "INSERT INTO users (fname, lname, email, usertype, pass, ID) VALUES 
                                ('$fname', '$lname', '$email', '$usertype', '$pass', null)";
                        $conn->query($insert);
                        if($usertype == 'Student'){
                            header("Location:admin.php");
                        }
                        if($usertype == 'Teacher'){
                            header("Location:admin.php");
                        }
                    }
                }else{
                    echo "<h7 class='text-danger'>Excuse me ma'am please recheck your password.</h7>";
                }
            }
            ?>
        </form>
    </div>
    <div class="col-md-6">
        <form action="register.php" class= "rounded p-5 rightmarg bg-white" method="post">
            <input type="email" class="rounded form-control mb-3" name="email" placeholder="Email">
            <input type="password" class="rounded form-control mb-3" name="pass" placeholder="Password">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="w-50 col-md-8">
                    <input type="submit" name="login" class="rounded btn btn-success w-100 mb-3" value="Login">
                </div>
                <div class="col-md-2"></div>
            </div>
            <?php
            session_start();
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $_SESSION['demail'] = $email;
                $pass = $_POST['pass'];
                $temp = "SELECT * FROM users WHERE email='$email' AND pass='$pass'";
                $connquery = $conn->query($temp);
                $result = $connquery->fetch_assoc();
                if($connquery->num_rows < 1){
                    echo "<h7 class='text-danger'>Excuse me ma'am please recheck your password.</h7>";
                }else{
                    if($result['usertype']=='student'){
                        header("Location:student.php");
                    }
                    if($result['usertype']=='teacher'){
                        header("Location:teacher.php");
                    }
                    if($result['usertype']=='admin'){
                        header("Location:admin.php");
                    }
                }
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>