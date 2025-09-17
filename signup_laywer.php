
<?php  
// تفاصيل الاتصال بقاعدة البيانات  
$servername = "localhost"; // عادة ما يكون localhost  
$username = "root"; // اسم المستخدم لقاعدة البيانات  
$password = ""; // كلمة المرور لقاعدة البيانات  
$db_name = "website_db"; 
// اسم قاعدة البيانات  

// إنشاء الاتصال  
$conn = new mysqli($servername, $username, $password, $db_name);  

// التحقق من الاتصال  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  
?>


<!DOCTYPE html>  
<html lang="ar" dir="lrt">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet"href="css/message.css">  
</head>  
<?php include 'inc/header.php'; ?>
<body>  
 
<!-- #region -->
  
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
    <div class="box" >  
        <div  class="logo"> </div>
        
        <h2>تسجيل الدخول</h2>  
        <form action="" method="post">  
            <div class="inputBox">  
               
                <input type="text" name="name" required> <!-- Added type and name -->  
                <label>اسم المحــــامي</label>  
            </div>   

            <div class="inputBox">  
                <input type="text" name="phone" required> <!-- Added type and name -->  
                <label>رقم الهاتف</label>  
            </div> 

            <div class="inputBox">  
                <input type="text" name="email" required> <!-- Added type and name -->  
                <label>البريد الالكتروني</label>  
            </div>  

            <div class="inputBox">  
                <input type="password" name="password" required> <!-- Added name -->  
                <label>كلمة المرور</label>  
            </div>  

            <div class="inputBox">  
                <input type="password" name="cpassword" required> <!-- Added type and name -->  
                <label>تاكيد كلمة المرور</label>  
            </div>  

            <div class="inputBox">  
                <input type="text" name="thefield" required> <!-- Added type and name -->  
                <label>المجال </label>  
            </div>  
          <!--  <div class="inputBox">  
            <label>ارفق سيرتك الذاتية </label>  
            <form action="upload.php" method="post" enctype="multipart/form-data"> 

      
        <input type="file" name="file" id="file" accept="application/pdf">
        </div>
        -->
        <input type="submit" name="submit" value="تسجيل"> <!-- أضف attribute name="submit" -->
    </form> 
        
            <div class="box11" style="top: 87%;">  
         
        
            <!-----    <h3>هل لديك حساب سجل حساب جديد؟  </h3>  ---->
            <input type="button"  value="تسجيل كعميل" onclick="window.location.href='signup_Clients.php'">
            <a class="space">      </a> </a>
             <input type="button"  value="تسجيل كمحامي" onclick="window.location.href='signup_laywer.php'">  
     
    </div>  
        </form>  

    </div>
      
</body>    
</html>

<?php
// تحقق مما إذا تم إرسال النموذج  
if (isset($_POST['submit'])) {  
    // قراءة البيانات وإجراء الفحص  
    $name = mysqli_real_escape_string($conn, $_POST['name']);  
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);  
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $password = mysqli_real_escape_string($conn, $_POST['password']);  
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);  
    $thefield = mysqli_real_escape_string($conn, $_POST['thefield']);  
    
    // فحص صحة كلمات المرور  
    if ($password !== $cpassword) {  
        echo "<div id='popupMessage' class='popup error'>كلمات المرور لا تتطابق!</div>";  
        exit();  
    }  
    
    // تشفير كلمة المرور  
    $encrypted_password = md5($password); // يمكنك استخدام bcrypt بمكتبة password_hash في PHP لأمان أفضل  

    // تحقق من وجود المستخدم  
    $select = mysqli_query($conn, "SELECT * FROM `lawyer` WHERE email = '$email'") or die('query failed');  

    if (mysqli_num_rows($select) > 0) {  
        echo "<div id='popupMessage' class='popup error'>البريد الإلكتروني مستخدم مسبقًا!</div>";  
    } else {  
        // إدراج البيانات في قاعدة البيانات  
        $query = "INSERT INTO `lawyer` (`Name`, `Email`, `password`, `field_lawyer`, `phone`) VALUES ('$name', '$email', '$encrypted_password', '$thefield', '$phone')";  

        if (mysqli_query($conn, $query)) {  
            echo "<div id='popupMessage' class='popup error'>تم التسجيل بنجاح!</div>";  
            header('login_lawyer.php');
        } else {  
            echo "<div id='popupMessage' class='popup error'>حدث خطأ: " . mysqli_error($conn)."</div>";  
        }  
    } 
    
        // Script to hide the message after 3 seconds
        echo "<script>
        setTimeout(function() {
            var popup = document.getElementById('popupMessage');
            if (popup) {
                popup.style.display = 'none';
            }
        }, 3000);
        </script>";
}  

// إغلاق الاتصال  
$conn->close();  
?>

