<?php  
// تفعيل تجميع المخرجات لتجنب مشاكل header
ob_start();

// تفاصيل الاتصال بقاعدة البيانات  
$servername = "localhost"; // عادة ما يكون localhost  
$username = "root"; // اسم المستخدم لقاعدة البيانات  
$password = ""; // كلمة المرور لقاعدة البيانات  
$db_name = "website_db"; 

// إنشاء الاتصال  
$conn = new mysqli($servername, $username, $password, $db_name);  

// التحقق من الاتصال  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
?>

<!DOCTYPE html>  
<html lang="ar" dir="ltr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">  
    <link rel="stylesheet" href="css/message.css">
</head>  

<?php include 'inc/header.php'; ?>
<body>  

<!-- #region -->
  
    <div class="box">  
        <div class="logo"></div>
        
        <h2>تسجيل الدخول</h2>  
        <form action="signup_Clients.php" method="post">  
            <div class="inputBox">  
                <input type="text" name="name" required>  
                <label>اسم العميل</label>  
            </div>  

            <div class="inputBox">  
                <input type="text" name="email" required>  
                <label>البريد الالكتروني</label>  
            </div>  

            <div class="inputBox">  
                <input type="text" name="age_client" required>  
                <label>العمـــــــر</label>  
            </div>  
            
            <div class="inputBox">  
                <input type="text" name="phone" required>  
                <label>رقم الهاتف</label>  
            </div> 

            <div class="inputBox">  
                <input type="password" name="password" required>  
                <label>كلمة المرور</label>  
            </div>  

            <div class="inputBox">  
                <input type="password" name="password3" required>  
                <label>تأكيد كلمة المرور</label>  
            </div>  

            <input type="submit" value="تسجيل" name="submit">  
        </form>  
        
        <input type="button" value="تسجيل كعميل" onclick="window.location.href='signup_Clients.php'">
        <a class="space" style="margin-left: 30%;"></a>
        <input type="button" value="تسجيل كمحامي" onclick="window.location.href='signup_laywer.php'">
    </div>  
</body>    
</html>

<?php
// التحقق من إرسال النموذج  
if (isset($_POST['submit'])) {  
    $name = mysqli_real_escape_string($conn, $_POST['name']);  
    $age = mysqli_real_escape_string($conn, $_POST['age_client']);  
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);  
    $password = mysqli_real_escape_string($conn, $_POST['password']);  
    $cpassword = mysqli_real_escape_string($conn, $_POST['password3']);  

    // تحقق من أن كلمات المرور متطابقة  
    if ($password !== $cpassword) {  
        echo "<div id='popupMessage' class='popup error'>كلمات المرور غير متطابقة!</div>";
    } else {  
        // تشفير كلمة المرور  
        $encrypted_password = md5($password); 

        // تحقق من أن البريد الإلكتروني غير مستخدم مسبقًا  
        $select = mysqli_query($conn, "SELECT * FROM `client` WHERE Email_client = '$email'");

        if (mysqli_num_rows($select) > 0) {  
            echo "<div id='popupMessage' class='popup error'>البريد الإلكتروني مستخدم مسبقًا!</div>";
        } else {  
            // إدراج البيانات في قاعدة البيانات  
            $query = "INSERT INTO `client` (`client_name`, `age_client`, `Email_client`, `phone_client`, `password`) VALUES ('$name','$age', '$email', '$phone','$encrypted_password')";  

            if (mysqli_query($conn, $query)) {  
                // عرض رسالة النجاح واستخدام JavaScript للتوجيه بعد ثانيتين
                echo "<div id='popupMessage' class='popup success'>تم التسجيل بنجاح!</div>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'home.php';
                    }, 2000);  
                </script>";
            } else {  
                $error_message = mysqli_error($conn);  
                echo "<div id='popupMessage' class='popup error'>حدث خطأ أثناء التسجيل: " . $error_message . "</div>";  
            }  
        }  
    }

    // إخفاء الرسائل بعد فترة قصيرة باستخدام JavaScript
    echo "<script>
    setTimeout(function() {
        var popup = document.getElementById('popupMessage');
        if (popup) {
            popup.style.display = 'none';
        }
    }, 3000);
    </script>";
}

// إغلاق الاتصال بقاعدة البيانات  
mysqli_close($conn);  

// إنهاء تجميع المخرجات وإرسالها للمتصفح
ob_end_flush();
?>
