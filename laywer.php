<?php
session_start(); 
 
if (isset($_SESSION['user_Id'])) {
    $client_id = $_SESSION['user_Id'];
    //echo "معرف العميل: " . $client_id;
} else {
    header('Location: login_clients.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trust Me - طلب الاستشارة</title>
    <link rel="stylesheet" href="css/laywer_style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"href="css/message.css">
</head>
<?php include 'inc/header.php'; ?>
<body>

<section id="consultation">
    <h1>طلب الاستشارة</h1>
    <form action="" method="post" enctype="multipart/form-data"> <!-- إضافة enctype -->
        <?php
        include 'connection.php';

        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // استعلام SQL لتحميل أسماء ومعرفات المحامين
        $sql = "SELECT Id_lawyer, Name FROM lawyer";
        $result = $conn->query($sql);

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

        <label for="consultation-type">نوع الاستشارة:</label>
        <select id="consultation-type" name="consultation_type">
            <option value="قانوني">قانوني</option>
            <option value="تجاري">تجاري</option>
            <option value="جنائي">جنائي</option>
            <option value="أخرى">أخرى</option>
        </select>

        <label for="problem-description">وصف المشكلة:</label>
        <textarea id="problem-description" name="problem_description" rows="5"></textarea>

        <!-- حقل رفع المرفقات -->
        <label for="attachment">رفع مرفقات (PDF فقط):</label>
        <input type="file" id="attachment" name="attachment" accept="application/pdf">

        <button type="submit" name="submit">إرسال</button>
    </form>
</section>

</body>
</html>
<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lawyer_id = isset($_POST['id_lawyer']) ? $_POST['id_lawyer'] : null;
    $consultation_type = isset($_POST['consultation_type']) ? $_POST['consultation_type'] : null;
    $problem_description = isset($_POST['problem_description']) ? $_POST['problem_description'] : null;

    if ($lawyer_id && $consultation_type && $problem_description) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $client_id = isset($_SESSION['user_Id']) ? $_SESSION['user_Id'] : null;
        
        if ($client_id) {
            // معالجة رفع الملف
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
                $file_tmp = $_FILES['attachment']['tmp_name'];
                $file_name = basename($_FILES['attachment']['name']);
                $upload_dir = 'uploads_files_con/';
                $file_path = $upload_dir . uniqid() . '_' . $file_name;

                // تحقق من نوع الملف
                if (mime_content_type($file_tmp) == 'application/pdf') {
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    // محاولة نقل الملف والتحقق من نجاح النقل
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $sql = "INSERT INTO consultations (Id_lawyer, Type_con, problem_description, Id_client, Accept, files) 
                                VALUES ('$lawyer_id', '$consultation_type', '$problem_description', '$client_id', 0, '$file_path')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div id='popupMessage' class='popup success'>تم إرسال الاستشارة بنجاح</div>";
                        } else {
                            echo "<div id='popupMessage' class='popup error'>خطأ في الإرسال: " . $conn->error . "</div>";
                        }
                    } else {
                        echo "<div id='popupMessage' class='popup error'>فشل في رفع الملف.</div>";
                    }
                } else {
                    echo "<div id='popupMessage' class='popup error'>الملف يجب أن يكون بصيغة PDF فقط.</div>";
                }
            } else {
                echo "<div id='popupMessage' class='popup error'>يرجى رفع ملف PDF.</div>";
            }
        } else {
            echo "<div id='popupMessage' class='popup error'>معرف العميل غير موجود في الجلسة.</div>";
        }
    } else {
        echo "<div id='popupMessage' class='popup error'>الرجاء إدخال جميع الحقول المطلوبة.</div>";
    }

    if (isset($conn) && $conn) {
        $conn->close();
    }

    // إضافة كود جافاسكريبت لإغلاق الرسالة بعد 3 ثوانٍ
    echo "<script>
        setTimeout(function() {
            document.getElementById('popupMessage').style.display = 'none';
        }, 4000);
    </script>";
}
?>
 