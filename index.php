<?php
  if(!isset($_COOKIE['login']))
 {
   header('Location: http://localhost/Newsite/login.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <title>Avenue Site</title>
</head>
<body>
    <?php
    
require_once 'config.php'; // подключаем скрипт
 
 $link = mysqli_connect($host, $user, $password, $database) 
     or die("Ошибка " . mysqli_error($link)); 
     mysqli_query($link,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
 
     $query ="SELECT * FROM tickets";

  
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result)
 {
     $rows = mysqli_num_rows($result); // количество полученных строк

     ?>
     <div class="tickets-fone"><div style="width:100%; height:100%; background:rgba(0,0,0,0.7);"></div></div>
<div class="container" >
  <ul class="all-tickets">

     <?php

      for ($i = 0 ; $i < $rows ; ++$i)
     {
         $row = mysqli_fetch_row($result);
        ?>
              <li class="all-tickets-item">

<div class="all-tickets-item-arrow"> <a class="ref" href="./buy/index.php/?id=<?=$row[0];?>"><i class="fas fa-angle-right arrow"></i></a>
</div>
<span class="all-tickets-item-city"><?=$row[1];?></span>
    
    <span class="all-tickets-item-data"><?=$row[2];?></span>
    <span class="all-tickets-item-type" ><?=$row[3]=="1"?"Вип":"Эконом";?></span>
    <span class="all-tickets-item-price" ><?=$row[4]?></span>

</li>   

        <?php
      }
       
     // очищаем результат
     mysqli_free_result($result);
 }
  
 mysqli_close($link);
 ?>


</ul>  
</div>

 
</body>
</html>