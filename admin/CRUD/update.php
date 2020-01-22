<pre>
<?php
require_once '../.././config.php'; // подключаем скрипт
  $tickets_id =$_POST['tickets_id'];
 $tickets_path =$_POST['tickets_name'];
 $tickets_data =$_POST['tickets_data'];
 $tickets_type =$_POST['tickets_type'];
 $tickets_price =$_POST['tickets_price'];
 $tickets_photo =$_POST['tickets_photo'];

$conn = mysqli_connect($host, $user, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE tickets SET 
tickets_path='$tickets_path',
tickets_photo='$tickets_photo', 
tickets_time='$tickets_data', 
tickets_price ='$tickets_price'
 
 WHERE tickets_id='$tickets_id'";

if (mysqli_query($conn, $sql)) {
  echo "<p>Update successefully</p>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
 