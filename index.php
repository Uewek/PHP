<?php


$connection=mysqli_connect('localhost','root','','users');


if(isset ($_POST['username'])  && isset ($_POST['password']));
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];

$query="INSERT INTO users (username,password,email) VALUES ('$username','$email','$password')";
$result=mysqli_query($connection,$query);

if($result){
    $smsg="Registration success!";
}else{
    $fsmsg="Error!!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>


<div class="container">
    <div class="form-signin" method="post">
        <h2>Registration</h2>
        <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert" }<?php echo $smsg;?> </div><?php }?>
    <?php if(isset($fsmsg)){ ?><div class="alert alert-danger" role="alert" }<?php echo $fsmsg;?> </div><?php }?>
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
    </form>
</div>

</body>
</html>