<?php
include 'connection.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verify consultation ID is present in the URL
if (isset($_GET['id'])) {
    $consultationId = intval($_GET['id']); // Sanitize consultation ID
} else {
    echo "Consultation ID not provided.";
    exit();
}

// Verify user session is set
if (!isset($_SESSION['user_Id'])) {
    header('Location: login_clients.php');
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $replay = $_POST['replay'] ?? '';

    // Ensure replay field is not empty
    if (!empty($replay)) {
        // Update the consultation reply in the database
        $sql = "UPDATE consultations SET replay = ? WHERE Id_con = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $replay, $consultationId); // Corrected the parameter types

        // Execute the statement and provide feedback
        if ($stmt->execute()) {
            $message = "تم الرد على الاستشارة بنجاح!";
            echo "<div id='popupMessage' class='popup success'>{$message}</div>";
            echo "<script>
                setTimeout(function() {
                    var popup = document.getElementById('popupMessage');
                    if (popup) {
                        popup.style.display = 'none';
                    }
                }, 3000);
            </script>";
        } else {
            echo "<div id='popupMessage' class='popup error'>حدث خطأ أثناء تحديث حالة الاستشارة: " . $conn->error . "</div>";
        }
    } else {
        echo "<div id='popupMessage' class='popup error'>يرجى كتابة الرد قبل الإرسال.</div>";
    }
}

// Retrieve consultation data to display
$result = $conn->query("SELECT * FROM consultations WHERE Id_con = $consultationId");

if (!$result || $result->num_rows === 0) {
    echo "<div id='popupMessage' class='popup error'>لا توجد استشارة بهذا الرقم.</div>";
    exit();
}

$consultation = $result->fetch_assoc();
?>

<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">  
    <link rel="stylesheet" type="text/css" href="css/Style_conslation.css">
    <link rel="stylesheet" href="css/message.css">
</head>  
<?php include 'inc/header.php'; ?>
<body>  
    <div class="WaterMark"></div>    

    <center>
        <div id="website_db">
            <div class="center-content">
                <div class="box">  
                    <div class="logo"></div>
                    <h2>الرد على الاستشارات</h2>

                    <form action="" method="post">
                        <div class="inputBox">
                            <input type="hidden" name="consultation_id" value="<?php echo htmlspecialchars($consultationId); ?>">
                            <input type="text" name="replay" required>
                            <label>اكتب الرد على الاستشارة</label>
                        </div>
                        
                        <input type="submit" name="submit" value="ارسال">
                        
                    </form>
 
                </div>
            </div>
        </div>
    </center>
    
</body>    
</html>
