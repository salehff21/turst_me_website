<?php  
 
 // Check if 'email' is set in the session
 if (isset($_SESSION['email'])) {   
     $email = $_SESSION['email']; // Get the email from the session 
 
     // Check if 'client' is set in the session
     if (isset($_SESSION['client'])) {
         $client = $_SESSION['client'];
     } else {
         $client = null; // Default value if 'client' is not set
     }
 
    $email_show = htmlspecialchars($email);
     // Display the email securely  
 } else {  
     echo "No user logged in.";  
 }  
 ?>
 
 <!DOCTYPE html>  
 <html lang="ar">  
 <head>  
     <meta charset="UTF-8">  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">  
     <title>Trust Me</title>  
     <link rel="stylesheet"  href="../css/style.css">  
 </head>  
 
 <body>
     <header>       
    <nav class="menu">                                                        
       
         <ul>
         <li>
    <div class="supportTeam" style="display: flex; flex-direction: column; align-items: flex-start; margin-right: 80px; color: white;">
 
        <p style="margin: 0; font-size: 19px;font-weight:bold; color: white;">
          فريق الدعم الفني
        </p>
        
      
        <div onclick="window.open('https://wa.me/0510397267', '_blank')" style="display: flex; align-items: center; cursor: pointer; margin-top: 5px;">
            <h4 style="margin: 0; font-size: 18px; color: white;">
            0510397267
            </h4>
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" 
                 alt="WhatsApp" 
                 style="width: 40px; height: 40px; margin-left: 8px;">
        </div>
    </div>
</li>


         <li>
             <?php
 include 'connection.php';
 
 // Check if the user is a client
 if (isset($client) && $client === true) {
     $select_user = mysqli_query($conn, "SELECT * FROM client WHERE Email_client = '$email'") or die('query failed');
     if (mysqli_num_rows($select_user) > 0) {
         $fetch_user = mysqli_fetch_assoc($select_user);
         $name_person = $fetch_user['client_name'];
         $Id_users=$fetch_user['Id_client'];
     } else {
         echo "No client found.";
     }
 // Check if the user is a lawyer
 } else if (isset($client) && $client === false) { 
     $select_user = mysqli_query($conn, "SELECT * FROM lawyer WHERE Email = '$email'") or die('query failed');
     if (mysqli_num_rows($select_user) > 0) {
         $fetch_user = mysqli_fetch_assoc($select_user);
         $name_person = $fetch_user['Name'];
         $Id_users=$fetch_user['Id_lawyer'];
         //echo ("Email: " .$email_show) ;
     } else {
         echo "No lawyer found.";
     }
 // Case when no user is logged in
 } else {  
    // echo "No user logged in.";  
 } 
 
 ?>
 <!--
 <div class="user-profile" style=" font-weight: bold;   margin-right:20px;">
 
 
 <p style="fon-wight=bold;color:aliceblue;padding:2px;height: 11px;">المستخدم الحالي: <span><?php // echo isset($name_person) ? htmlspecialchars($name_person) : ' '; ?></span> </p>
 <p style="fon-wight=bold;color:aliceblue;padding:2px;height: 11px;">الإيميل: <span><?php //echo isset($email_show) ? htmlspecialchars($email_show) : ' '; ?></span> </p>
 <p style="fon-wight=bold;color:aliceblue;padding:2px;height: 11px;">رقم المستخدم: <span><?php //echo isset($Id_users) ? htmlspecialchars($Id_users) : ' '; ?></span> </p>
  </div>
-->
             </li>
          
             <li>
     <select onchange="location = this.value;">
         <option value="">المزيد</option>
         
         <?php if (isset( $_SESSION['client']) &&$_SESSION['client']==false): ?>
             <!-- Show these options only for lawyers -->
             <option value="update_info_lawyer.php">بيانات الحساب</option>
             <option value="consultations.php">التنبيهات</option>
             <option value="logout.php">تسجيل الخروج</option>
             <?php elseif (isset( $_SESSION['client']) &&$_SESSION['client']==true): ?>
                <option value="consultations_client.php">الإستشارات</option>
      <option value="evaluation.php">التقييم</option>
     <option value="logout.php">تسجيل الخروج</option>      
         <?php endif; ?>
         
 
     </select>
 </li>
 
              <li><a href="contact_us.php">تواصل معنا</a></li>   
              <li><a href="about_us.php">من نحن</a></li>  
              <li><a href="Qustions.php">أسئلة شائعة</a></li>  
              <li><a href="laywer.php">طلب إستشارة </a></li>  
              <li><a href="home.php">الرئيسية</a></li>  
         </ul>  
 
     </nav>  
     </header>