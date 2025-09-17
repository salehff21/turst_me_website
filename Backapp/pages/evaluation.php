<?php
include 'connection.php';
session_start(); // Start the session

// Check if user_Id exists in the session
if (isset($_SESSION['user_Id'])) {
    $client_id = $_SESSION['user_Id'];
    echo "Client ID: " . $client_id;
} else {
    // Redirect to the login page if client ID is not in the session
    header('Location: login_student.php');
    exit();
}

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the list of lawyers from the database
$lawyers = $conn->query("SELECT * FROM lawyer");
if (!$lawyers) {
    die("Failed to retrieve lawyer list: " . $conn->error);
}

// Ensure there is data in the lawyers result
if ($lawyers->num_rows > 0) {
    // Process the lawyers if needed
} else {
    echo "No lawyers found.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check that all required data is present
    $lawyer_id = isset($_POST['Id_lawyer']) ? $_POST['Id_lawyer'] : null;
    $evaluation = isset($_POST['evaluation']) ? $_POST['evaluation'] : null;
   // $email = isset($_POST['email']) ? $_POST['email'] : null; // حقل البريد الإلكتروني

    if ($lawyer_id && $evaluation) {
        // Insert the evaluation into the evaluations table
        $sql = "INSERT INTO evaluation (Id_client, Id_lawyer, stute_Evaluation)
                VALUES ('$client_id', '$lawyer_id', '$evaluation')"; // إضافة البريد الإلكتروني

        if ($conn->query($sql) === TRUE) {
            echo "<div id='popupMessage' class='popup success'>تم التقييم بنجاح!.</div>";
        } else {
            echo "<div id='popupMessage' class='popup success'> Error: " . $sql . "<br>" . $conn->error."</div>";
        }
    } else {
        echo "<div id='popupMessage' class='popup success'>من فضلك املئ الحقول .</div>";
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

// Close the connection after all operations
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trust Me</title>
    <link rel="stylesheet" href="stayles.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet"href="css/message.css">
</head>
<?php include 'inc/header.php'; ?>
<body>
    <section id="contact">
        <h2>تقييم المحامين</h2>
        <form method="post">
            <label for="lawyer">اختر المحامي:</label>
            <select id="lawyer" name="Id_lawyer" required>
                <?php
                // استعلام SQL لتحميل أسماء ومعرفات المحامين
                $sql = "SELECT Id_lawyer, Name FROM lawyer";
                $result = $conn->query($sql);

                // عرض القائمة المنسدلة
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['Id_lawyer'] . '">' . $row['Name'] . '</option>';
                    }
                } else {
                    echo '<option value="">لا توجد محامين متاحين</option>';
                }
                ?>
            </select>

           

            <div class="evaluation-group">
                <label>التقييم:</label>
                <input type="radio" id="excellent" name="evaluation" value="ممتاز" required>
                <label for="excellent">ممتاز</label>
                <input type="radio" id="very_good" name="evaluation" value="جيد جدا">
                <label for="very_good">جيد جدا</label>
                <input type="radio" id="good" name="evaluation" value="جيد">
                <label for="good">جيد</label>
                <input type="radio" id="acceptable" name="evaluation" value="مقبول">
                <label for="acceptable">مقبول</label>
            </div>

            <button type="submit">إرسال</button>
        </form>
    </section>
</body>
</html>
