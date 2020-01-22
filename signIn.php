<?php

  $isRegistered =false;
  if(isset($_POST['submit'])){
    require_once './config.php'; // подключаем скрипт
 
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
         
    $query ="SELECT * FROM users";
     
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         
         for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
              if($row[1]==$_POST['login'] && $row[2]==md5($_POST['password'])) /// $password
              {
                  $isRegistered =true;
                  setcookie('login',$_POST['login']);
                  setcookie('password', $_POST['password']);
              }
        }
          
        // очищаем результат
        mysqli_free_result($result);
    }
     
    mysqli_close($link);
  }

   
  $isRegistered? header('Location: http://localhost/Newsite/index.php'):false;

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign in</title>
</head>
<body class="text-center">
<div class="tickets-fone2"><div style="width:100%; height:100%; background:rgba(0,0,0,0.7);">
    
<form method="post" action="./signIn.php">
<div class="form-group">
<label style="color:#FFDAB9">
Введите логин:
<input   class="form-control" type="text"
value="<?= isset($_COOKIE['login'])?$_COOKIE['login']:"";?>"
 name="login"/>
</label>
</div>

<div class="form-group">
<label style="color:#FFDAB9">
Введите пароль:
<input class="form-control" type="password"
value="<?= isset($_COOKIE['password'])?$_COOKIE['password']:"";?>"
 name="password"/>
</label>
</div>

<div class="checkbox mb-3">
    <label style="color:#FFDAB9">
      <input type="checkbox" value="remember-me"> Запомнить
    </label>
  </div>

<button type="submit" name="submit" class="btn btn-primary">Войти</button>

</div>
</form>
</body>
</html>