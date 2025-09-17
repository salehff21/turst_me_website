<?php  
include 'connection.php';  

// Display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
     <meta charset="UTF-8">  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">  
     <title>Trust Me</title>  
     <link rel="stylesheet" type="text/css" href="css/style.css">  
     <link rel="stylesheet"href="css/message.css">
</head>  
<?php include 'inc/header.php'; ?>
<body>  

<div class="box">  
    <div class="logo"></div>
      <h2>تسجيل الدخول</h2>   <!---<h2><?php //echo md5('2009') ;?></h2>-->
    <form action="" method="post">  
        <div class="inputBox">  
            <input type="text" name="email" required>  
            <label>الايميل</label>  
        </div>  
        <div class="inputBox">  
            <input type="password" name="password" required>  
            <label>كلمة المرور</label>  
        </div>  
        <input type="submit" name="submit" value="تسجيل دخول">  
    </form>  
</div>  

    
</body>    
</html> 

<?php

// Start the session
session_start();

// تأكد من وجود الاتصال بقاعدة البيانات
include 'connection.php';

// Check if the form has been submitted  
if (isset($_POST['submit'])) {  
    // Escape special characters in email and password inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $entered_password = mysqli_real_escape_string($conn, $_POST['password']);  

    // Encrypt the entered password using MD5 (to match the stored password format)
    $encrypted_entered_password = md5($entered_password);

    // Query to retrieve the user with the encrypted password from the database
    $select = mysqli_query($conn, "SELECT * FROM lawyer WHERE Email = '$email' AND password = '$encrypted_entered_password'") or die('Query failed');  

    // Check if the user exists and the password matches
    if (mysqli_num_rows($select) > 0) {  
        $row = mysqli_fetch_assoc($select);  
        
        // Store user session information upon successful login
        $_SESSION['user_Id'] = $row['Id_lawyer'];  
        $_SESSION['email'] = $email;  
        $_SESSION['client'] = false; // Define that the user is not a client
        
        // Redirect to home page
        header('location:home.php');  
        exit();  
    } else {  
        // Error message if email or password is incorrect
        $message = 'خطا في الايميل او الباسورد تاكد من الادخال!';
    }  
}

// Display any error messages
if (isset($message)) {  
    echo "<div id='popupMessage' class='popup error'> $message </div>";  

    // Script to hide the message after 3 seconds
    echo "<script>
    setTimeout(function() {
        var popup = document.getElementById('popupMessage');
        if (popup) {
            popup.style.display = 'none';
        }
    }, 3000);
    </script>";
}  

?>


