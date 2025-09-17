<?php
include 'connection.php';
session_start(); // Start the session
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if user_Id exists in the session
if (isset($_SESSION['user_Id'])) {
    $client_id = $_SESSION['user_Id'];
    //echo "معرف العميل: " . $client_id;
} else {
    // Redirect to the login page if client ID is not in the session
    header('Location: login_clients.php');
    exit();
}
 ?>
 
<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet"href="stayles.css">
    <link rel="stylesheet"type="text/css" href="css/style.css"> 
    <link rel="stylesheet"href="css/message.css">
</head>  
<?php include 'inc/header.php'; ?>
<body>  
    <li>
     <div class="WaterMark" style="margin-left: 2%; display:inline"></div>
    
     <section id="contact">
        <h2>تواصل معنا</h2>
        <form method="post" action="">
            <label for="name">الاســــــم</label>
            <input style=" border-radius: 2px;border: 1px solid #232F63FF;"  type="text" id="name" name="name" required><br>

            <label for="email">:البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required><br>

            <label for="message">:الرســـالة</label>
            <textarea id="message" name="message" required></textarea><br>

            <button type="submit">إرسال</button>
        </form>
    </section>        
    </li>
</body>    
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // الحصول على بيانات النموذج
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // التحقق من أن جميع الحقول قد تم ملؤها
    if (!empty($name) && !empty($email) && !empty($message)) {
        
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        
        // تحقق مما إذا كان التحضير قد فشل
        if (!$stmt) {
            echo "<div id='popupMessage' class='popup error'>خطأ في إعداد الاستعلام: " . $conn->error . "</div>";
            exit();
        }

        $stmt->bind_param("sss", $name, $email, $message);

        // تنفيذ الاستعلام والتحقق من النجاح
        if ($stmt->execute()) {
            echo "<div id='popupMessage' class='popup success'>تم إرسال الرسالة بنجاح.</div>";
        } else {
            echo "<div id='popupMessage' class='popup error'>خطأ في إرسال الرسالة: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div id='popupMessage' class='popup error'>يرجى ملء جميع الحقول.</div>";
    }

    // إضافة جافاسكريبت لإخفاء الرسالة بعد 4 ثوانٍ
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
 

<!-- إضافة كود CSS لتنسيق الرسالة -->
 