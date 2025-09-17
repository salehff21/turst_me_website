<?php  
// Database connection details  
$servername = "localhost";  
$username = "root";  
$password = "";  
$db_name = "website_db";  

// Create connection  
$conn = new mysqli($servername, $username, $password, $db_name);  

// Check connection  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

// Start the session
session_start();

// Display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link rel="stylesheet" href="css/message.css">
</head>  
<body>  
<?php include 'inc/header.php'; ?>

<div class="box">  
    <div class="logo"></div>
    <h2>تسجيل الدخول</h2>  
    <form action="" method="post">  
        <div class="inputBox">  
            <input type="text" name="email" required>  
            <label>اسم المستخدم</label>  
        </div>  
        <div class="inputBox">  
            <input type="password" name="password" required>  
            <label>كلمة المرور</label>  
        </div>  
        <input type="submit" name="submit" value="تسجيل الدخول">  
        <label style=" font-weight: bold;  margin-left:5%;" > إنشاء حساب جديد  <a href="signup_Clients.php">إضغط هنا</a></label>  
       <li> <label style=" font-weight: bold;  margin-right:17%;font-weight: bold;margin-right: 38%;margin-block: auto;background-color: #181873a3;color: white; font-weight: bold;padding: 9px;border-radius: 14px;" >سجل دخول كـ محامي <a href="login_lawyer.php" style="color:aliceblue">هنـــا</a></label> </li>
    </form>  

</div>  
<?php
// Check if the form has been submitted  
if (isset($_POST['submit'])) {  
    // Escape special characters in email and password inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $pass = mysqli_real_escape_string($conn, $_POST['password']);  

    // Encrypt the entered password using MD5 to match the stored password
    $encrypted_entered_password = md5($pass);

    // Query to check if the user exists with the provided email and password
    $select = mysqli_query($conn, "SELECT * FROM client WHERE Email_client = '$email' AND password = '$encrypted_entered_password'") or die('Query failed');  

    // If the user exists
    if (mysqli_num_rows($select) > 0) {  
        $row = mysqli_fetch_assoc($select);  
        
        // Store the user ID in the session
        $_SESSION['user_Id'] = $row['Id_client'];
        $_SESSION['email'] = $email;  
        $_SESSION['client'] = true;  // Set to true as the user is a client
        
        // Redirect to home page after successful login
        header('location:home.php');  
        exit();  
    } else {  
        // Error message if email or password is incorrect
        $message[] = 'خطا في الايميل او الباسورد تاكد من الادخال!';
    }  
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

<?php  
// Display any error messages
if (isset($message)) {  
    foreach ($message as $msg) {  
         echo " <div id='popupMessage' class='popup error'>  . $msg . </div>";  
    }  
}  
?>  
</body>    
</html>
