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
                <div class="box"style="height:500px">  
                    <div class="logo"></div>
                    <h2 style=" border-radius: 10px;border: 1px solid #232F63FF;" >الرد على الاستشارات</h2>

                    <form action="consultations_client.php" method="post">
                    
                            <label style="   border-radius: 10px;border: 1px solid #232F63FF;display:block;height:auto; font-weight:bold; text-align: center;font-size: x-large;text-alg">  <?php echo htmlspecialchars($consultation['replay']); ?></label> 
                           
                        <div class="inputBox">
                            <input type="hidden" name="consultation_id" value="<?php echo htmlspecialchars($consultationId); ?>">
                            <!-- Display the current replay in the input field -->
                           
                        </div>
                        
                        <!-- Change the submit button to a back button -->
                        <input style="margin-top: 80px;" type="submit" name="back" value="الرجوع إلى الصفحة السابقة">
                        
                    </form>
 
                </div>
            </div>
        </div>
    </center>
    
</body>    
</html>
