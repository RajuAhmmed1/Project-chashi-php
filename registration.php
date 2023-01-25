<?php ob_start()?>
<?php  include "includes/db.php"; ?>

<?php include"includes/header.php"; ?>


    <!-- Navigation -->
<?php include"includes/navigation.php"; ?>

<?php

if(isset($_POST['submit']))
{
    $error=array();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    
    $email=$_POST['email'];
    
    $user_image=$_FILES['image']['name'];
    
    $user_image_temp=$_FILES['image']['tmp_name'];
    
    $path=pathinfo($user_image,PATHINFO_EXTENSION);
    $ext=array('gif','jpg','png','jpeg','JPG','JPEG','PNG');

    move_uploaded_file($user_image_temp,"images/$user_image");
    
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    $email=mysqli_real_escape_string($connection,$email);
    $user_firstname=mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname=mysqli_real_escape_string($connection, $user_lastname);
    
 
    
    $query="select * from users where username='$username' or user_email='$email' Limit 1";
    
    $select_user=mysqli_query($connection,$query);
    
    if(!$select_user)
    {
        die("failed".mysqli_error($connection));
    }
    
    $user=mysqli_fetch_assoc($select_user);
    
    
       
    if(empty($username))
    {
        $username_error="username is required";
        array_push($error,1);
    }
    else
    {
        if($user['username']==$username)
        {
            $username_error="this username has been taken";
            array_push($error,2);
        }
       /* if(!preg_match("[a-zA-Z0-9]", $username))
        {
            $username_error="username have to be only letters";
            array_push($error,12);
        }*/
    }
    
    if(empty($user_firstname))
    {
        $user_fname_error="this field is required";
        array_push($error,3);
    }
    
    if(empty($user_lastname))
    {
        $user_lname_error="this field is required";
        array_push($error,4);
    }
    
    if(empty($email))
    {
        $email_error="this field is required";
        array_push($error,5);
    }
    else
    {
        if($user['user_email']==$email)
        {
            $email_error="this email already used";
            array_push($error,6);
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $email_error="please enter a valid email";
            array_push($error,7);
        }
    }
    
    if(empty($password))
    {
        $password_error="this filed is required";
        array_push($error, 8);
    }
    else
    {
        if(strlen($password)<8)
        {
            $password_error="password have to be at least 8 characters";
            array_push($error, 10);
        }
    }
    
    if(empty($user_image))
    {
        $user_image_error='user image is requierd';
        array_push($error, 9);
    }
    else
    {
           
    if(!in_array($path,$ext))
    {
        $user_image_error="please choose a currect image";
        array_push($error, 11);
    }
    
    }

  
    if(count($error)==0)
    {
            $query="insert into users (username,user_firstname, user_lastname,user_email,user_password,user_image) values ('{$username}','$user_firstname','$user_lastname','{$email}','$password','{$user_image}')";
            $insert_query=mysqli_query($connection,$query);
        
        if(!$insert_query)
        {
            die("failed".mysqli_error($connection));
        }
        
            header("location: login.php");
    }
    

          
        
    }
    


?>
    
 

    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 col-xs-12">
                <div class="form-wrap">
                <h1 style="text-align:center;">Registration</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" enctype="multipart/form-data" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <span style="color:red;text-align:center;"><?php if(isset($username_error)){echo $username_error;}?></span>
                            <input type="text" name="username" id="username" class="form-control" value="<?php if(isset($username)){echo $username;} ?>" placeholder="Enter username">
                        </div>
                        
                         <div class="form-group">
                            <label for="first_name" class="sr-only">Fist Name</label>
                             <span style="color:red;text-align:center;"><?php if(isset($user_fname_error)){echo $user_fname_error;}?></span>
                            <input type="text" name="user_firstname" id="first_name" class="form-control" value="<?php if(isset($user_firstname)){echo $user_firstname;} ?>" placeholder="Enter first name">
                        </div>
                        
                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">Last Name</label>
                            <span style="color:red;text-align:center;"><?php if(isset($user_lname_error)){echo $user_lname_error;}?></span>
                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" value="<?php if(isset($user_lastname)){echo $user_lastname;} ?>" placeholder="Enther last name">
                        </div>
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                             <span style="color:red;text-align:center;"><?php if(isset($email_error)){echo $email_error;}?></span>
                            <input type="email" name="email" id="email" class="form-control" value="<?php if(isset($email)){echo $email;} ?>" placeholder="somebody@example.com">
                        </div>
                        
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                             <span style="color:red;text-align:center;"><?php if(isset($password_error)){echo $password_error;}?></span>
                            <input type="password" name="password" id="key" class="form-control" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Password">
                        </div>
                        
                        <div style="margin-bottom:13px;" class="form-gourp">
                            <label for="user_image" class="sr-only" >User Image</label>
                                <span style="color:red;text-align:center;"><?php if(isset($user_image_error)){echo $user_image_error;}?></span>
                            <input type="file" name="image" class="form-control">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-md btn-block" value="Register">
                        
                    </form>
                        
                        <a style="text-align:center; margin-left:257px; margin-top:40px; font-weight: bold; font-size: 15px;" href="login.php">Login</a>
            
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
    
   
<?php include"includes/footer.php"; ?>