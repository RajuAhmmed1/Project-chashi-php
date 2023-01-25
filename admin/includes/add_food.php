<?php
if(isset($current_user_id))
{
    $user_id=$current_user_id;
    
    if(isset($_POST['submit']))
    {
        $food_name=$_POST['food_name'];
        $food_type=$_POST['food_type'];
        
        $food_name=mysqli_real_escape_string($connection, trim($food_name));
        $food_type=mysqli_real_escape_string($connection, trim($food_type));
        
        $count_error=array();
        
        if(empty($food_name))
        {
            $food_name_error="food name is required";
            array_push($count_error,1);
            
        }
        
        if(empty($food_type))
        {
            $food_type_error="food type is required";
            array_push($count_error,2);
        }
     
        if(count($count_error)==0)
        {
            $query="insert into foods(food_name,food_type,user_id,date)values('$food_name','$food_type',$user_id,now())";
            $insert_query=mysqli_query($connection, $query);
            if(!$insert_query)
            {
                die("failed query".mysqli_error($connection));
            }
            header("location: foods.php");
        }

    }
}


?>


<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
    <label for="food_name">Food Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_name_error)){echo $food_name_error;}?></span>
    <input type="text" name="food_name" class="form-control" value="<?php if(isset($food_name)){echo $food_name;}?>">
    </div>
    
<div class="form-group ">
    <label for="fodo_type">Food Type</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_type_error)){echo $food_type_error;}?></span>
    <select name="food_type" class="form-control form-control-sm">
        <option value="">select food type</option>
        <option value="natural food">natural food</option>
        <option value="supplementary feeds">supplementary feeds</option>
        <option value="complete feeds">complete feeds</option>
    </select>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="submit">
        <a class="btn btn-default" href="foods.php">cancel</a>
    </div>


</form>







