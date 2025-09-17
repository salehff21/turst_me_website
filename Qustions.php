<?php
  session_start(); // بدء الجلسة
 
  // التحقق من وجود user_id في الجلسة
  if (isset($_SESSION['user_Id'])) {
      // إذا كان معرف العميل موجود في الجلسة
      $client_id = $_SESSION['user_Id'];
    //  echo "معرف العميل: " . $client_id;
  } else {
      // إذا لم يكن معرف العميل موجودًا، قد ترغب في إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
      header('Location: login_clients.php');
      exit();
  }
  ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trust Me</title>
    <link rel="stylesheet" href="css/Styles_Qustions.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<?php include 'inc\header.php';?>

<body>
    
    <div class="content">
        <button>كيف يمكنني تلقي الأسئلة؟</button>
        <button>كيف يمكنني التسجيل كمحامي؟<br>
            يتم ذلك من خلال الدخول على المنصة يوجد خانة التسجيل كمحامي يتم النقر عليها وتعبئة البيانات
        </button>
        <button>هل يوجد شروط للانضمــام؟
            لا يوجد شــروط للإنضمــام حياك معنا في اي وقت .
        </button>
        <button>كيف أسأل؟
            الصفحة الرئيسية تسجيل كعميل تعبئة البيانات المطلوبة
            ضع السؤال في خانة إطرح سؤال
        </button>
    </div>
</body>
</html>
 