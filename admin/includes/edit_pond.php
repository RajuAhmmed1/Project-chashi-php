<?php

if(isset($_GET['pond_id']))
{
    $pond_id=$_GET['pond_id'];
    $query="select * from pond where pond_id=$pond_id";
    $select_pond=mysqli_query($connection,$query);
    if(!$select_pond)
    {
        die("failed".mysqli_error($connection));
    }
    
    while($row=mysqli_fetch_assoc($select_pond))
    {
        $pond_id=$row['pond_id'];
        $user_id=$row['user_id'];
        $pond_name=$row['pond_name'];
        $pond_size=$row['pond_size'];
        $pond_location=$row['pond_location'];
    }
    
    
}

if(isset($_POST['submit']))
{
    $pond_name=$_POST['pond_name'];
    $pond_size=$_POST['pond_size'];
    $pond_location=$_POST['pond_location'];
    
    $pond_name=mysqli_real_escape_string($connection,trim($pond_name));
    $pond_size=mysqli_real_escape_string($connection,trim($pond_size));
    $pond_location=mysqli_real_escape_string($connection,trim($pond_location));
    
    $count=array();
    
    if(empty($pond_name))
    {
        $pond_name_error="pond name is required";
         array_push($count,1);
    }
    if(empty($pond_size))
    {
        $pond_size_error="pond size is required";
         array_push($count,2);
    }
    if(empty($pond_location))
    {
        $pond_location_error="pond location is required";
         array_push($count,3);
    }
    
    if(count($count)==0)
    {
        $query="update pond set pond_name='$pond_name',pond_size='$pond_size',pond_location='$pond_location' ,user_id=$user_id,date=now() where pond_id=$pond_id";
        $insert_query=mysqli_query($connection, $query);
        if(!$insert_query)
        {
            die("failed query".mysqli_error($connection));
        }
        header("location:ponds.php");
    }
    

    
}


?>



<form method="post" action="" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="pond_name">Pond Name</label>
        <span class="error" style="color:red; text-align:center;"><?php if(isset($pond_name_error)){echo $pond_name_error;}?></span>
         <input type="text" class="form-control" name="pond_name" value="<?php echo $pond_name;?>">
    </div>
    
   <div class="form-group">
        <label for="pond_size">Pond Size (ACRE)</label>
        <span class="error" style="color:red; text-align:center;"><?php if(isset($pond_size_error)){echo $pond_size_error;}?></span>
         <input type="text" class="form-control" name="pond_size" value="<?php echo $pond_size;?>">
    </div>
    
        <div class="form-group">
        <label for="pond_location">Pond Location</label>
        <span class="error" style="color:red; text-align:center;"><?php if(isset($pond_location_error)){echo $pond_location_error;}?></span>
         <input type="text" class="form-control" name="pond_location" value="<?php echo $pond_location;?>">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" value="update">
    <a class="btn btn-default" href="ponds.php?source=view_all_pond">cancel</a>

</form>