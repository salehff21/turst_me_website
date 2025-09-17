<?php
     
 include "..connection.php";
 
 
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = ("select Id_client,client_name from client where email = '$user_check' ");
   $result = mysqli_query($connect,$ses_sql);
      $row = mysqli_fetch_assoc($result);
       
      $count = mysqli_num_rows($result);
   $id = $row['id_client'];
   $username = $row['client_name'];
    
     
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>