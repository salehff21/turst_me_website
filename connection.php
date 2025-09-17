<?php  
// تفاصيل الاتصال بقاعدة البيانات  
$servername = "localhost";  
$username = "root";  
$password = "";  
$db_name = "website_db";  

// إنشاء الاتصال  
$conn = new mysqli($servername, $username, $password, $db_name);  

// التحقق من الاتصال  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

// يمكنك تنفيذ استعلامات قاعدة البيانات هنا  

// إغلاق الاتصال  

