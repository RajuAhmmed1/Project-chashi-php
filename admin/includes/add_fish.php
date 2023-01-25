<?php
if(isset($current_user_id))
{
    $user_id=$current_user_id;
    
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
            $query="insert into fish(fish_name,user_id,date)values('$fish_name',$user_id,now())";
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
    <input type="text" name="fish_name" class="form-control" value="<?php if(isset($fish_name)){echo $fish_name;}?>">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="submit">
        <a class="btn btn-default" href="fishs.php">cancel</a>
    </div>
<button type="print"></button>

</form>