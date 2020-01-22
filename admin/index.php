<?php
 

 function isRegister($login, $password) {
     if($password=='1234' && $login =='admin@mail.ru'){
         return true;

     }
   return false;
   
    }

    isRegister($_POST['admin_login'],$_POST['admin_password'])?true:header('Location: http://localhost/NewSite/admin/login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
    <title>Addmin page </title>
    <style>
        *{
            box-sizing:border-box;
        }
        html,body{
            padding:0;
            margin:0;
            width:100vh;
        }
    </style>
</head>
<body> 
<?php
require_once '.././config.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM tickets";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
?>
<div class="container">
<table class="table" style="max-width:100%;">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Ticket Name</th>
      <th scope="col">ticket data</th>
      <th scope="col">Ticket photo</th>
     
      <th scope="col"> price for ticket</th>
      <th scope="col"> Ticket Photo</th>
     
        <th scope="col">удалить группу</th>
      <th scope="col">отредактировать группу</th>
      
    
    
      
    </tr>
  </thead>
  
<?php
        
        
  for($i =0;$i<$rows;$i++)
  {
    $row = mysqli_fetch_row($result);
      
      ?>
      <tr>
        <td><?=$row[0];?></td>
        <td><?=$row[1];?></td>
        <td><?=$row[2];?></td>
        <td><?=$row[3];?></td>
        <td><?=$row[4];?></td>
        <td><?=$row[5];?></td>
         <th scope="col"><form action="./CRUD/delete.php" method="post">
        <input type="text" style="display:none;" name="group_id" value="<?=$row[0];?>"/>
        <button
        class="btn btn-danger"
        type="submit" >Удалить группу</button></form></th>
        
        <th scope="col"><form action="./redact/index.php" method="get">
        <input type="text" style="display:none;" name="group_id" value="<?=$row[0];?>"/>
        <button
        class="btn btn-warning"
        type="submit" >Изменить поля</button></form></th>

    </tr>
    
      <?php
  }
        
        // очищаем результат
    mysqli_free_result($result);
}
 
mysqli_close($link);
?>
</table>
</div>
<div class="container">
<form class="form" action="./CRUD/add.php" method="post">
     <div class="form-group">
    <label for="groupName">Group Name</label>
    <input name="group_name" type="text" class="form-control" id="groupName" aria-describedby="emailHelp" placeholder="Enter group Name">
   </div>
  
   <div class="form-group">
    <label for="groupPhoto">Photo input .jpg format</label>
    <input
     name="group_photo"
    type="text" class="form-control" id="groupPhoto"
     aria-describedby="emailHelp" placeholder="Enter group Photo">
   </div>
   
   <div class="form-group">
    <label for="groupData"> input data</label>
    <input type="text"
    name="group_data"
    class="form-control" id="groupPhoto" 
    aria-describedby="emailHelp" placeholder="Enter group Data (0000-00-00)">
   </div>
   <div class="form-group">
    <label for="groupPrice"> input price for ticket</label>
    <input type="text"
    name="group_price"
    class="form-control" id="groupPrice" 
    aria-describedby="emailHelp" placeholder="Enter group price">
   </div>
    
   <div class="form-group">
    <label for="groupNumberofTickets">input group description</label>
    <input type="text" 
    name="groups_description"
    class="form-control" id="groupNumberofTickets" 
    aria-describedby="emailHelp" placeholder="Enter  total number of description">
   </div>
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>