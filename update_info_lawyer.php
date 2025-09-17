<?php
// Database connection
include 'connection.php';
session_start();

if (!isset($_SESSION['user_Id'])) {
    die("<div id='popupMessage' class='popup error'>يحب التسجيل اولا .</div>");
}

$id = $_SESSION['user_Id'];

if ($conn->connect_error) {
    die("<div id='popupMessage' class='popup error'> فشل الاتصال بقاعدة البيانات: " . $conn->connect_error."</div>");
}

// Check if the form was submitted for update
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $field_lawyer = $_POST['field_lawyer'];
    $phone = $_POST['phone'];
    $cvPath = ""; // Set an empty path for cv

    // Check if a PDF file is uploaded
    if (isset($_FILES['cv_lawyer']) && $_FILES['cv_lawyer']['error'] === 0) {
        $cvFile = $_FILES['cv_lawyer'];
        $cvExtension = strtolower(pathinfo($cvFile['name'], PATHINFO_EXTENSION));

        // Ensure the file is a PDF
        if ($cvExtension === 'pdf') {
            $cvPath = 'uploads/' . uniqid() . '_' . basename($cvFile['name']);

            // Save the file in the directory
            if (!move_uploaded_file($cvFile['tmp_name'], $cvPath)) {
                die("An error occurred while uploading the file.");
            }
        } else {
            die("Please upload a file in PDF format only.");
        }
    }

    // Update lawyer's information in the database
$sql = "UPDATE lawyer SET 
Name='$name', 
Email='$email', 
password='$password', 
field_lawyer='$field_lawyer', 
phone='$phone'";

// If a PDF file was uploaded, update the CV column
if (!empty($cvPath)) {
$sql .= ", cv_lawyer='$cvPath'";
}

$sql .= " WHERE Id_lawyer=$id";


    if ($conn->query($sql) === TRUE) {
        echo "<div id='popupMessage' class='popup error'> تم تحديث البيانات بنجاح!.</div>";
    } else {
        echo "<div id='popupMessage' class='popup error'>حصل خطا اثناء تحديث البيانات  : " . $conn->error."</div>";
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

// Fetch lawyer's information
$result = $conn->query("SELECT * FROM lawyer WHERE Id_lawyer=$id");
$lawyer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات الشخصية
    </title>
    <link rel="stylesheet"href="css/style_update_info_lawyer.css">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet"href="css/message.css">
</head>
<?php include 'inc/header.php'; ?>
<body>
    <div class="container">
        <h1>تعديل بيانات المحامين</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $lawyer['Id_lawyer']; ?>">

            <label>الاســــم</label>
            <input type="text" name="name" value="<?php echo $lawyer['Name']; ?>" required>

            <label>الايميل</label>
            <input type="email" name="email" value="<?php echo $lawyer['Email']; ?>" required>

            <label>كلمة المرور</label>
            <input type="password" name="password" value="<?php echo $lawyer['password']; ?>" required>

            <label>المجال </label>
            <input type="text" name="field_lawyer" value="<?php echo $lawyer['field_lawyer']; ?>" required>

            <label>رقم الهاتف</label>
            <input type="text" name="phone" value="<?php echo $lawyer['phone']; ?>" required>

            <label>رفع السيره الذاتية</label>
            <input type="file" name="cv_lawyer" accept=".pdf">
            <?php if (!empty($lawyer['cv_lawyer'])): ?>
                <p>السيره الذاتية: <a href="<?php echo $lawyer['cv_lawyer']; ?>" target="_blank">View Cv</a></p>
            <?php endif; ?>

            <button type="submit" name="update">حفــظ</button>
        </form>
    </div>
</body>
</html>
