<pre>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
    <title>Redact page</title>
</head>
<body>
<?php

require_once '../.././config.php'; // подключаем скрипт


$groupId =$_GET['group_id']??"1";
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM tickets WHERE tickets_id= $groupId ";


$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 


if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    
  if($rows==1)
  {
    $row = mysqli_fetch_row($result);
    // var_dump($row);
     ?>
     <form action=".././CRUD/update.php" method="post">
     <input type="text" name="tickets_id" value="<?=$row[0];?>" style="display:none;" />
     <div class="form-group">
    <label for="groupName">Ticket Path</label>
    <input name="tickets_name" type="text" class="form-control" 
    id="groupName" value="<?=$row[1];?>" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
  
      <div class="form-group">
    <label for="groupName">Ticket Time</label>
    <input name="tickets_data" type="text" class="form-control" 
    id="groupName" value="<?=$row[2];?>" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
  
   <div class="form-group">
    <label for="groupName">Ticket Type(1/0)</label>
    <input name="tickets_type" type="text" class="form-control" 
    id="groupName" value="<?=$row[3];?>" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
   <div class="form-group">
    <label for="groupName">Ticket Price</label>
    <input name="tickets_price" type="text" class="form-control" 
    id="groupName" value="<?=$row[4];?>" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
   <div class="form-group">
    <label for="groupName">Ticket Photo</label>
    <input name="tickets_photo" type="text" class="form-control" 
    id="groupName" value="<?=$row[5];?>" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
   
  <button type="submit" class="btn btn-secondary">Изменить данные</button>
    </form>
     <?php
  }
   
}
 
        
// очищаем результат
mysqli_free_result($result);
 
mysqli_close($link);
?>    

</body>
</html>