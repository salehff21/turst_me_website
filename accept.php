<?php
include 'connection.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// تأكد من وجود Id_con في رابط الصفحة
if (isset($_GET['id'])) {
    $consultationId = intval($_GET['id']); // الحصول على Id_con من الرابط وتحويله إلى عدد صحيح
} else {
    echo "Consultation ID not provided.";
    exit();
}

// التحقق من وجود user_Id في الجلسة
if (!isset($_SESSION['user_Id'])) {
    header('Location: login_clients.php');
    exit();
}

// التحقق من الضغط على زر قبول أو رفض
if (isset($_POST['submit'])) {
    $action = ($_POST['submit'] === 'قبول') ? 1 : 2;
    $Id_users=$_SESSION['user_Id'];
    // تحديث حالة الاستشارة بناءً على الزر المضغوط
    $sql = "UPDATE consultations SET accept = ? WHERE Id_con = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $action, $consultationId);

    // الرسالة ستظهر في منتصف الصفحة وستختفي تلقائيًا بعد 3 ثوانٍ
if ($stmt->execute()) {
    $message = ($action === 1) ? "تم قبول الاستشارة بنجاح!" : "تم رفض الاستشارة بنجاح!";
    echo "<div id='popupMessage' class='popup success'>{$message}</div>";
    echo "<script>
    setTimeout(function() {
        var popup = document.getElementById('popupMessage');
        if (popup) {
            popup.style.display = 'none';
        }
        // إعادة التوجيه إلى صفحة consulation.php
        window.location.href = 'consultations.php';
    }, 2000);
</script>";

} else {
    echo "<div id='popupMessage' class='popup error'>حدث خطأ أثناء تحديث حالة الاستشارة: " . $conn->error . "</div>";
}


// جلب بيانات الاستشارة للعرض
$result = $conn->query("SELECT * FROM consultations WHERE Id_con = $consultationId");
 

if (!$result || $result->num_rows === 0) {
    echo "<div id='popupMessage' class='popup error'>لا توجد استشارة بهذا الرقم.</div>";
    exit();
}

$consultation = $result->fetch_assoc(); // استرجاع بيانات الاستشارة المحددة
}?>

<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">  
    <link rel="stylesheet" type="text/css" href="css/Style_conslation.css">
    <link rel="stylesheet"href="css/message.css">
</head>  
<?php include 'inc/header.php'; ?>
<body>  
    <div class="WaterMark"></div>    

    <center>
        <div id="website_db">
            <div class="center-content">
                <div class="box">  
                    <div class="logo"></div>
                    <h2>قبول الاستشارات</h2>

                    <form action="" method="post">
                         
                        <input type="submit" name="submit" value="قبول">
                        <input type="submit" name="submit" value="رفض">
                    </form>
 
                </div>
            </div>
        </div>
    </center>
    
</body>    
</html>
