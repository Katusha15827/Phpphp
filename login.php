<?php
$errors =['log_errors'=>NULL,
'exist_log'=>NULL
];
$errors_test =[
'exist_log'=>'такой пользователь уже зарегестрирован'
];

require_once './config.php';

$checkOnceConn = mysqli_connect($host, $user, $password, $database);
$checkLog =isset($_POST['login'])?trim($_POST['login']):'';
$resultOnceCheck = mysqli_query( $checkOnceConn, "SELECT COUNT(*) as count FROM `users` WHERE ( `user_login` = '$checkLog' )" );

$row = mysqli_fetch_assoc( $resultOnceCheck );
if($row['count'] )
{
$errors['exist_log'] =true;
}
if(isset($_POST['submit']))
{

require_once './config.php';
$conn = mysqli_connect($host, $user, $password, $database);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}


//filter_var($email_a, FILTER_VALIDATE_EMAIL)
$login = filter_var($_POST['login'],FILTER_VALIDATE_EMAIL) ;
$password =trim($_POST['password']);
$pass_hash = md5($password); ///add md5

if(!$login)
{
$errors['log_errors'] ='Не валидный email';

}
else if(isset($errors['exist_log']))
{

}

else {
$sql = "INSERT INTO users ( user_login, user_password,user_tickets_info)
VALUES ('$login', '$pass_hash',JSON_OBJECT('tickets',''))"; // $password


if (mysqli_query($conn, $sql)) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
setcookie('login', $login);
setcookie('password',$password);


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
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>Login Page</title>
</head>


<body class="text-center">    
<div class="tickets-fone2"><div style="width:100%; height:100%; background:rgba(0,0,0,0.7);">
<form method="post" action="./login.php">

<h1 style="color:#D2691E" class="h3 mb-3 font-weight-normal"> Добро пожаловать в AviaTickets</h1>    

<div class="form-group">
<label style="color:#FFDAB9">
Введите логин:
<input class="form-control" type="mail" name="login"/>
<?php
if(isset($errors['log_errors']))
{
?>
<p class="error"><?=$errors['log_errors'];?></p>
<?php
}
else if(isset($errors['exist_log'])) {
?>
<p class="error"><?=$errors_test['exist_log'];?></p>
<?php
}
?>
</label>
</div>

<div class="form-group">
<label style="color:#FFDAB9">
Введите пароль:
<input class="form-control" type="password" name="password"/>
</label>
</div>

<div class="reference">
<a href="./signIn.php">Перейти в окно  для зарегестрированных пользователей</a>
</div>

<button type="submit" name="submit" class="btn btn-primary">Зарегестрироваться</button>


</form>
</div>
</body>
</html>