<?php
session_start();
// include 'conn.php';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $fullname = $conn->real_escape_string($_POST['fullname']);
//     $username = $conn->real_escape_string($_POST['username']);
//     $email = $conn->real_escape_string($_POST['email']);
//     $password = $conn->real_escape_string($_POST['password']);
//     $confirm_password = $conn->real_escape_string($_POST['confirm_password']);


//     $sql = "SELECT * FROM admintbl WHERE username='$username'";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {

//         echo "<script>alert('Username already taken');</script>";
//     } else {

//         if ($password === $confirm_password) {

//             $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
//             $sql = "INSERT INTO admintbl (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$hashed_password')";
//             if ($conn->query($sql) === TRUE) {
//                 header('location:login.php?signup=success');
//             } else {
//                 echo "Error: " . $sql . "<br>" . $conn->error;
//             }
//         } else {

//             echo "<script>alert('Passwords do not match');</script>";
//         }
//     }


//     $conn->close();
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harvest Assistant</title>
    <link rel="stylesheet" href="assets/css/signup.css?v=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="img/jpg" href="assets/images/logo.png">
    <style>
        body {
            background-image: url("assets/images/bg.jpg");
        }

        .small {
            color: red;
            margin: 5px;

        }
    </style>
</head>

<body>
    <div class="wrap">
        <form action="scripts/signup.php" method="post">
            <h1>Sign Up</h1>

            <div class="input">
                <input type="text" placeholder="First Name" name="fname" required>
                <i class='bx bx-user'></i>
            </div>

            <div class="input">
                <input type="text" placeholder="Middle Name" name="mname">
                <i class='bx bx-user'></i>
            </div>

            <div class="input">
                <input type="text" placeholder="Last Name" name="lname" required>
                <i class='bx bx-user'></i>
            </div>

            <div class="input">
                <input type="text" placeholder="Username" name="username" required>
                <i class='bx bx-user'></i>
            </div>

            <div class="input">
                <input type="email" placeholder="Email" name="email" required>
                <i class='bx bx-envelope'></i>
            </div>

            <div class="input">
                <input type="password" placeholder="Password" name="password" minlength="4" required>
                <i class='bx bx-lock-alt'></i>
            </div>

            <div class="input">
                <input type="password" placeholder="Confirm Password" name="confirm_password" minlength="4" required>
                <i class='bx bx-check-circle'></i>
            </div>
            <?php
            
            if(isset($_SESSION['error_message'])){
                echo `<p class="small pass">`. $_SESSION['error_message'] .`</p>`;
            }
            
            ?>
            

            <div class="policy">
                <label><input type="checkbox" required>I agree to the <a href="policy.php">Terms & Conditions and Privacy Policy</a></label>
            </div>

            <button type="submit" name="save" class="btnsubmit">Sign Up</button>

            <div class="login">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>

        </form>
    </div>


</body>

</html>