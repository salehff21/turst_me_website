
<?php
  session_start(); // بدء الجلسة
 
  // التحقق من وجود user_id في الجلسة
  if (isset($_SESSION['user_Id'])) {
      // إذا كان معرف العميل موجود في الجلسة
      $client_id = $_SESSION['user_Id'];
   //   echo "معرف العميل: " . $client_id;
  } else {
      // إذا لم يكن معرف العميل موجودًا، قد ترغب في إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
      header('Location: login_clients.php');
      exit();
  }
  ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>من نحن</title>
    <link rel="stylesheet" href="css/about_us_styles.css">
      <link rel="stylesheet"  href="css/style.css">  
</head>
<?php include 'inc/header.php'; ?>
<body>

   <!-- #region -->

    <div class="content">
        <h2>من نحن</h2>
        <div class="hover-box-container">
            <div class="hover-box" onmouseover="showText('definition')" onmouseout="hideText()">
                من نحن
            </div>
            <div class="hover-box" onmouseover="showText('goals')" onmouseout="hideText()">
                أهدافنا
            </div>
            <div class="hover-box" onmouseover="showText('message')" onmouseout="hideText()">
                رسالتنا
            </div>
        </div>

        <div id="display-text" class="description">
            مرر المؤشر على الأزرار لعرض المعلومات.
        </div>
    </div>

    <script>
        function showText(type) {
            const textElement = document.getElementById('display-text');
            if (type === 'definition') {
                textElement.innerHTML = 'موقع يقدم كافة الخدمات القانونية والاستشارات مما يسهل وصول العملاء إلى أفضل المحامين.';
            } else if (type === 'goals') {
                textElement.innerHTML = 'يهدف إلى تسهيل الوصول للمحامين ومعلومات شاملة عنهم. كما يهدف إلى توكيل محامي مناسب للقضية.';
            } else if (type === 'message') {
                textElement.innerHTML = 'يهدف موقعنا إلى تقديم أفضل الدعم للعميل وتوفير استشارات قانونية متنوعة.';
            }
        }

        function hideText() {
            const textElement = document.getElementById('display-text');
            textElement.innerHTML = 'مرر المؤشر على الأزرار لعرض المعلومات.';
        }
    </script>
</body>