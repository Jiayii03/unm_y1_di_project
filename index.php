<?php
     require "DBCreateDatabase.php"; // this file creates a database called `car_reservation_db`, after connecting to the localhost
     require "DBCreateStaffTable.php"; // require "DBConnected.php", creates a table called `staff`
     require "DBCreateCarsTable.php"; // require "DBConnected.php", creates a table called `cars`
     require "DBCreateReservationTable.php"; // require "DBConnected.php", creates a table called `reservation`
     require "DBCreateCustomerTable.php"; // require "DBConnected.php", creates a table called `customer`

     session_start();


     //------------log in system---------------
     $invalid_login = false; //set invalid_login = false first.
     $login_successful = false; //set login_successful = false first.

     if($_SERVER["REQUEST_METHOD"] == "POST"){

        //----------if it is a log in system form submission-------------
        if(isset($_POST["username"])){ 
            require "DBConnected.php";

            $username = $_POST["username"];
            $password = $_POST["password"];
        
            $sql = "SELECT * FROM `staff`";
    
            if($sql_run = $conn->query($sql)){
                // var_dump($sql_run->fetch_assoc());
                if($sql_run->num_rows > 0){ //if there's any record in the table
                    while($row = $sql_run->fetch_assoc()){ //fetch each record from the table
                        if($username == $row["username"] && $password == $row["password"]){ //if username and password matches
                            $_SESSION["username"] = $username; //create a session
                            $login_successful = true; 
                           
                        }else{
                            $invalid_login = true; // we only want this to be true when login is invalid, i.e. after form submission
                        }
                    }
                }
            }
        }


        //----------if it is a reservation form submission---------------
        if(isset($_POST["startDate"])){
            
            $startDate = $_POST["startDate"];
            $endDate = $_POST["endDate"];

        }
     }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>

    <h1>This is the index page.</h1>
    
    <!-- -------------log in form-------------- -->
    <?php
    if(!$login_successful){ // if not logged in, display this login form
        ?>
        <h3>Log In</h3>
        <form action="index.php" method="post" autocomplete="off" class="login">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Type your username"><br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Type your password"><br>

            <input type="submit" value="Log In">
            <a href="login/signup.php">Not yet signed up?</a>
        </form>
        
        <?php
    }
    ?>
    

    <h3>
        <?php
        if(isset($_SESSION["username"])){
            ?>
            Hello, <?= $_SESSION["username"] ?>
            <button class="logOut" onclick="location.href='login/logout.php'">Log Out</button>
            <?php
            // unset($_SESSION["username"]); //unset the session after refresh the page
        }elseif ($invalid_login == true){
            ?>
            Invalid Login <!--display this only when login is invalid-->
            <?php
        }
        ?>
    </h3>
    
    <!-- --------------reservation----------------- -->
    <form action="index.php" method="post" autocomplete="off" class="reservation">
        <label for="startDate">Start Date: </label>
        <input type="date" name="startDate" id="startDate">

        <label for="endDate">End Date: </label>
        <input type="date" name="endDate" id="endDate">
        
        <label for="vehicleType">Select type of vehicle: </label>
        <select name="vehicleType" id="vehicleType">
            <option value="luxurious" selected>Luxurious Car</option>
            <option value="sports">Sports Car</option>
            <option value="classics">Classics Car</option>
        </select>

        <br>
        <input type="submit" value="Check Availability">
    </form>

    <?php
    
    ?>




</body>
</html>