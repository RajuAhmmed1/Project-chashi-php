
<?php ob_start();?>
<?php include"includes/db.php";?>
<?php session_start();?>

<?php include"includes/header.php"; ?>


    <!-- Navigation -->
<?php include"includes/navigation.php"; ?>

    <!-- Page Content -->
  


<?php
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $f_email=mysqli_real_escape_string($connection,$email);
    $f_password=mysqli_real_escape_string($connection, $password);
    
/*    if(empty($f_email))
    {
        $error_email="this field is required";
    }
    else
    {
        if(!filter_var($f_email,FILTER_VALIDATE_EMAIL))
        {
             $error_email="please enter a valid email";
        }
       
    }
    
    if(empty($_password))
    {
        $error_passowrd="This filed is required";
    }*/
    
    
    $query="select * from users WHERE user_email='{$f_email}' Limit 1";
    $select_users=mysqli_query($connection, $query);
    if(!$select_users)
    {
        die("failed".mysqli_error($connection));
    }
    
    if(mysqli_num_rows($select_users)==1)
    {
        $user=mysqli_fetch_assoc($select_users); 
        if($user['user_email']==$f_email && $user['user_password']==$f_password)
            {
                $_SESSION['username']=$user['username'];
                $_SESSION['user_email']=$user['user_email'];
                $_SESSION['user_id']=$user['user_id'];
                 header('Location: admin/index.php');

            }
    }
    
    else 
    {
        $error="Incorrect email or password";
    }
    

  
}

?>

    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 style="text-align:center">Login</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="">
                    <span class="error" style="text-align:center; color:red;"><?php if(isset($error)){echo $error;}?></span><br>
                        <span class="error" style="text-align:center; color:red;"><?php if(isset($error_email)){echo $error_email;}?></span><br>
                        <span class="error" style="text-align:center; color:red;"><?php if(isset($error_password)){echo $error_password;}?></span><br>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-md btn-block" value="Login">
                     
                    </form>
                       <a style="text-align:center; margin-left:235px; margin-top:40px; font-weight: bold; font-size: 15px;" href="registration.php">Registration</a>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


<?php include"includes/footer.php"; ?>
