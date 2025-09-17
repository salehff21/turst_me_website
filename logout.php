<?php
session_start();
session_unset();
session_destroy();
header("Location: login_clients.php"); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
exit();
