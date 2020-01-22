<?php
    require_once '../.././config.php';
   
    $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link)); 
    $groupId= mysqli_real_escape_string($link, $_POST['group_id']);
     
    $query ="DELETE FROM tickets WHERE tickets_id = '$groupId'";
 
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    mysqli_close($link);
    echo "<p>Данные успешно удалены</p>";
 ?>