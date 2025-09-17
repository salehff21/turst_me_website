

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">  
</head>  
<?php include 'inc/header.php'; ?>
<body>  

<!-- #region -->
 


    <div class="WaterMark"> </div>
   
    <div class="box11" style="top:87%;">  
    <input type="button"  value="تسجيل الدخول" onclick="window.location.href='login_clients.php'"> 
            <a class="space" style="margin-left: 30%;">      </a> </a>
 
     <input type="button"  value="تسجيل جديد " onclick="window.location.href='signup_Clients.php'">
    </div>  
</div>

</body>    
</html>

<style>
.box11 {
    direction: ltr;
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 900px;
    width: 90%;
    padding: 40px;
    background: rgb(227, 227, 227);
    box-sizing: border-box;
    border-radius: 10px;
}
 
.box11 input[type="button"] {  
    background: #181873;
    display: inline;
    font-weight: bold;
    color: white;
    cursor: pointer;
    border-radius: 10px;
    margin: 7px auto 6px 30px;
    width: 27%;
    padding: 8px;
    border: 1px solid #181873;
    font-size: 16px;
}  
</style>
