
<?php

require_once '.././config.php';
///
$c = "";
$ticket_name="";
$ticket_date ="";
$ticket_price ="";
 $link = mysqli_connect($host, $user, $password, $database) 
     or die("Ошибка " . mysqli_error($link)); 
     mysqli_query($link,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
 
 
     $id =isset($_GET['id'])?$_GET['id']:1;

     $query ="SELECT * FROM tickets WHERE tickets_id ='$id'";

  
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result)
 {
    $rows = mysqli_num_rows($result); // количество полученных строк
  for($i=0;$i < $rows;$i++)
  {
    $row = mysqli_fetch_row($result);
    ///
     $c = $row[0];
     $ticket_name =$row[1];
    $ticket_date =$row[2];
    $ticket_price = $row[4];
    ////
    ////добавилаsetcookie('ticket','$c');
     /// убрала старое setcookie('ticket_info',json_encode(['tickets'=>[
     ///   "$ticket_name"=>[
        ///    'price'=>$ticket_price,
        //    'ticket_data'=>$ticket_date
      //  ]
  //  ]]));
     
 }
 mysqli_close($link);

 if(isset($_POST['submit'])){
    require_once '.././config.php'; // подключаем скрипт
 
    $conn = mysqli_connect($host, $user, $password, $database);
    // Check connection

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // как пример $ex =json_encode([ 'name'=>'Sam']);
       //$groupsJSON = json_encode(['tickets'=>[
      //  "$ticket_name"=>[
       //     "price_for_one"=>$ticket_price,
        //    "ticket_data"=>$ticket_date
    //    ]
 //   ]]);
       $user_login =$_COOKIE['login'];
       ///
       $n = mysqli_query($conn, "SELECT user_id FROM users WHERE user_login ='$user_login'" );
       
       //$n = "SELECT user_id FROM users WHERE user_login ='$user_login'";
        $tk = $_COOKIE['ticket'];

    //  $tkInfo =$_COOKIE['ticket_info'];
   // $sql =  "UPDATE users
  //  SET user_tickets_info =  '$tkInfo'
  //   WHERE user_login = '$user_login'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    

    /// 
    $sql2 = "INSERT INTO orders (id_user,id_ticket, payment) VALUES ('45', '5','1')";
    if (mysqli_query($conn, $sql2)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    ///
    mysqli_close($conn);
}
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./main.css">
    <title>Current Reice</title>
</head>
<style>
.wrapper{
    width:100%;
    background-color:rgba(0,0,0,0.9);
    color:#fff;
    height:100vh;
    font-family:sans-serif;
 }

.container{
    display: flex;
    

  justify-content: space-evenly;
}
 .image{
     width:100%;
 }
 .ticket-content{
     display:flex;
     flex-flow:column;
     justify-content:space-around;
 }
 .container-button{
     width:100%;
     display:flex;
     justify-content:flex-end;
 }
 .button{
     margin-right:28%;
     border:none;
     background:tomato;
     padding:0.25rem 1rem;
     font-size:1.2rem;
     color:#fff;
     cursor:pointer;

 }
</style>
<body>
    

 <?php
$link = mysqli_connect($host, $user, $password, $database) 
     or die("Ошибка " . mysqli_error($link)); 
     mysqli_query($link,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
 
     $query ="SELECT * FROM tickets WHERE tickets_id =$id";
  
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result)
 {
     $rows = mysqli_num_rows($result); // количество полученных строк

     ?>
<?php

for ($i = 0 ; $i < $rows ; ++$i)
{
   $row = mysqli_fetch_row($result);

  ?>

 <div class="wrapper">
    
    <div class="container">
    
      <div class="ticket-image"><img class="image" src="<?= $row[5];?>"/></div>
      <div class="ticket-content" >
       <h3 class="ticket-name">Маршрут: <?=$row[1];?></h3>
       <span class="ticket-date">Дата отправления: <?=$row[2];?></span>      
       <span class="ticket-price">Цена: <?=$row[4];?></span> 
      </div>
        </div>
        <div class="container-button"><button id="buy-ticket" class="button">Купить</button></div>
   
    </div>
<?php
      }
       
     // очищаем результат
     mysqli_free_result($result);
 }
  
 mysqli_close($link);
 ?>
   
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script>
  $('document').ready(function(){
     $('#buy-ticket').on('click',function(e){
    $.post('./index.php',{ submit:true,name:'Bob',ade:23},function(data){
       console.log(data);
    })
     });
  })
  </script>


</body>
</html>


<?php

