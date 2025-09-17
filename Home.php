 

<?php
include 'connection.php';
session_start(); // Start the session

// Check if user_Id exists in the session
if (isset($_SESSION['user_Id'])) {
    $client_id = $_SESSION['user_Id'];
//echo "Client ID: " . $client_id;
} else {
    // Redirect to the login page if client ID is not in the session
    header('Location: login_clients.php');
    exit();
}?>
<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">  
</head>  
<?php include 'inc/header.php'; ?>
<body>  


<!-- #region -->


   
    <div  class="WaterMark"> </div>
    
            
    <?php  ?>
</body>    
</html>