<?php
include 'connection.php';
session_start(); // Start the session
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if user_Id exists in the session
if (isset($_SESSION['user_Id'])) {
    $client_id = $_SESSION['user_Id'];
} else {
    // Redirect to the login page if client ID is not in the session
    header('Location: login_student.php');
    exit();
}
?>

<!DOCTYPE html>  
<html lang="ar">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Trust Me</title>  
    <link rel="stylesheet" type="text/css" href="css/style.css">   
    <link rel="stylesheet" type="text/css" href="css/Style_conslation.css">
</head>  
<?php include 'inc/header.php'; ?>
<body>  
 
    <div class="WaterMark"></div>    

    <center>
    <div id="website_db">
        <div class="center-content">
            <table class="table table-bordered">
                <tr class="active">
                    <th >حالة الاستشارة</th>
                    <th>رد على الاستشارة</th>
                    <th>المرفقات</th>
                    <th>اسم الطالب</th>
                    <th>نوع الاستشارة</th>
                    <th>محتوى الاستشارة</th>
                    <th>رقم الاستشارة</th>
                </tr>

                <?php
                $select_user = mysqli_query($conn, "SELECT * FROM lawyer WHERE Email = '$email'") or die('query failed');
                if (mysqli_num_rows($select_user) > 0) {
                    $fetch_user = mysqli_fetch_assoc($select_user);
                    $name_person = $fetch_user['Name'];
                } else {
                    echo "No lawyer found.";
                }
                
                // SQL query to fetch consultations data
             $sel_query = "   SELECT co.Id_con, la.Name AS lawyer_name, co.Type_con, cl.client_name, co.problem_description, co.files, co.Accept
                              FROM consultations AS co
                              JOIN lawyer AS la ON co.Id_lawyer = la.Id_lawyer
                              JOIN client AS cl ON co.Id_client = cl.Id_client
                              WHERE co.Id_lawyer = $client_id ORDER BY co.Id_con  DESC";

                // Execute the query
                $result = mysqli_query($conn, $sel_query);
                echo "<h3 style='font-weight:bold; color:black; font-size:20px'> الدكتور  : " . $name_person . "</h3>";

                // Check the result
                if ($result === false) {
                    echo "Error in query: " . mysqli_error($conn);
                } else {
                    // Display the data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        // عرض حالة الاستشارة
                        if ($row["Accept"] == '1') {
                            echo "<td  ><button style='background-color: green; font-weight:bold; color: white; border: none; padding: 10px 20px;'>مقبولة</button>";
                        } else if($row["Accept"]=='2') {
                            echo "<td ><button style='background-color: red; font-weight:bold; color: white; border: none; padding: 10px 20px;'>مرفوضة</button>";
                        }
                        else {
                        echo "<td  ><button style='background-color:#693dbe; font-weight:bold; color: white; border: none; padding: 10px 20px;'>قيد الإنتظار</button> ";
                            }
                        // زر "تعديل" للانتقال إلى صفحة accept.php مع تمرير ID الاستشارة
                        echo '<button onclick="window.location.href=\'accept.php?id=' . $row["Id_con"] . '\'" style="background-color: #3965af; font-weight: bold; color: white; border: none; padding: 10px 28px;">تعديل</button></td>';

                        // زر "رد على الاستشارة"
                        echo "<td><button onclick=\"window.location.href='replay.php?id=" . $row["Id_con"] . "'\" style='background-color: #3965af; font-weight: bold; color: white; border: none; padding: 10px 20px;'>رد</button></td>";

                        // عرض المرفقات
                        if (!empty($row["files"])) {
                            echo "<td><button onclick=\"window.open('" . $row["files"] . "', '_blank')\" style='background-color: #3965af; font-weight: bold; color: white; border: none; padding: 10px 20px;'>عرض</button></td>";
                        } else {
                            echo "<td>لا توجد مرفقات</td>";
                        }

                        // عرض اسم العميل
                        echo "<td>" . $row["client_name"] . "</td>";
                        // عرض نوع الاستشارة
                        echo "<td>" . $row["Type_con"] . "</td>";
                        // عرض محتوى الاستشارة
                        echo "<td style='width:350px;'>" . $row["problem_description"] . "</td>";
                        // عرض رقم الاستشارة
                        echo "<td>" . $row["Id_con"] . "</td>";

                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</center>

</body>    
</html>
