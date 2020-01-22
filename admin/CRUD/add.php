<pre>
<?php
var_dump($_POST);
require_once '../.././config.php';


$group_name=$_POST['group_name'] ?? '';
$group_photo=$_POST['group_photo'] ?? 'https://www.iguides.ru/upload/medialibrary/1eb/1ebcafd574de43a4ff45430556612f5f.jpg';
$group_data =$_POST['group_data'] ?? '2020-01-10';
$group_price =$_POST['group_price'] ?? '100';
$group_total_number_of_tickets =$_POST['group_total_number_of_tickets'] ?? '100';
$groups_description = $_POST['groups_description'] ??'lalalala';
// Create connection
$conn = mysqli_connect($host, $user, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO tickets (
    
    tickets_path,
    tickets_time,
    tickets_type,
    tickets_price,
    tickets_photo
      
      



)
VALUES ( '$group_name', '$group_data','$group_data',
'$group_price','$group_photo')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>