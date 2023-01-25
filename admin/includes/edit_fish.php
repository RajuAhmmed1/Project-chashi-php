<?php

if(isset($_GET['fish_id']))
{
    $fish_id=$_GET['fish_id'];
    
    $query="select * from fish where fish_id=$fish_id limit 1";
    $select_fish=mysqli_query($connection, $query);
    
    $fish=mysqli_fetch_assoc($select_fish);
    
    $fish_name=$fish['fish_name'];
    $user_id=$fish['user_id'];
    
    if(isset($_POST['submit']))
    {
        $fish_name=$_POST['fish_name'];
        $count_error=array();
        $fish_name=mysqli_real_escape_string($connection, trim($fish_name));
        if(empty($fish_name))
        {
            $fish_name_error="fish name is required";
            array_push($count_error,1);
            
        }
     
        if(count($count_error)==0)
        {
            $query="update fish set fish_name='$fish_name',user_id=$user_id,date=now() where fish_id=$fish_id";
            $insert_query=mysqli_query($connection, $query);
            if(!$insert_query)
            {
                die("failed query".mysqli_error($connection));
            }
            header("location: fishs.php");
        }

    }
    
}


?>


<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
    <label for="fish_name">Fish Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_name_error)){echo $fish_name_error;}?></span>
    <input type="text" name="fish_name" value="<?php echo $fish_name;?>" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="update">
        <a class="btn btn-default" href="fishs.php">cancel</a>
    </div>


</form>