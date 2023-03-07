<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require "../DBConnected.php";

        $staffId = $_POST['staffId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $_SESSION['name'] = $name;
        
        $sql = "INSERT INTO staff VALUES ('$staffId', '$name', '$email', '$username', '$password')";

        if($conn->query($sql)){
            // echo "Signed Up Successfully!";
            // header("Location: DBSignUp.php");
        }
        else echo "Error inserting record: " . $conn->error;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
</head>
<body>
    <form action="signup.php" method="post" autocomplete="off">
        <label for="staffId">Staff ID</label>
        <input type="text" name="staffId" id="staffId" placeholder="Eg: s1001"><br>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Type your name"><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Type your email"><br><br>


        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Insert username"><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Insert password"><br>

        <input type="submit" value="Sign Up">
    </form>

    <?php
    if(isset($_SESSION['name'])){
        ?>
        <h1>You are successfully signed up, <?= $_SESSION['name']?> !</h1>
        <button onclick="location.href='../index.php'">Back to login</button>
        <?php
        unset($_SESSION['name']);
    }
    ?>
    
</body>
</html>