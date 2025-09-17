<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trust Me - استشارة قانونية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
        }
        .container {
            width: 524px;
    margin: 50px auto;
    padding: 55px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 17px;
        }
        input, select, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>تواصل مع المحامي</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        
        <?php  
        include 'connection.php';

        if ($conn->connect_error) {  
            die("فشل الاتصال: " . $conn->connect_error);  
        }

        // استعلام SQL لتحميل أسماء ومعرفات المحامين
        $sql = "SELECT Id_lawyer, Name FROM lawyer";  
        $result = $conn->query($sql);

        // عرض القائمة المنسدلة
        echo '<label for="lawyer">اختر المحامي:</label>';  
        echo '<select id="lawyer" name="id_lawyer">';  

        if ($result->num_rows > 0) {  
            while ($row = $result->fetch_assoc()) {  
                echo '<option value="' . $row['Id_lawyer'] . '">' . $row['Name'] . '</option>'; 
            }  
        } else {  
            echo '<option value="">لا توجد محامين متاحين</option>';  
        }  

        echo '</select>';  
        $conn->close();
        ?>
        <input type="text" name="field" placeholder="المجال" required>
        <textarea name="message" placeholder="اكتب رسالتك هنا..." rows="5" required></textarea>
        <input type="file" name="attachment">
        <button type="submit">إرسال</button>
    </form>
</div>

</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $lawyer = $_POST['lawyer'];
    $field = $_POST['field'];
    $message = $_POST['message'];
    $attachment = $_FILES['attachment'];

    // معالجة المرفق
    if ($attachment['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filePath = $uploadDir . basename($attachment['name']);
        move_uploaded_file($attachment['tmp_name'], $filePath);
    }

    // إرسال البيانات أو معالجتها (تخزين في قاعدة بيانات، إرسال بريد إلكتروني...)
    echo "تم إرسال رسالتك بنجاح!<br>";
    echo "البريد الإلكتروني: $email<br>";
    echo "المحامي: $lawyer<br>";
    echo "المجال: $field<br>";
    echo "الرسالة: $message<br>";
}
?>
