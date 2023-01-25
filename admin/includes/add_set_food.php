<?php
if(isset($current_user_id))
{
    $user_id=$current_user_id;
    
    if(isset($_POST['submit']))
    {
        $food_id=$_POST['food_id'];
        $pond_id=$_POST['pond_id'];
        $food_provider_name=$_POST['food_provider_name'];
        $food_quantity=$_POST['food_quantity'];
        $food_price=$_POST['food_price'];

        
        $food_provider_name=mysqli_real_escape_string($connection, trim($food_provider_name));
        $food_quantity=mysqli_real_escape_string($connection, trim($food_quantity));
        $food_price=mysqli_real_escape_string($connection, trim($food_price));
        
        
        $count_error=array();
        
        if(empty($food_provider_name))
        {
            $food_provider_name_error="this field is required";
            array_push($count_error,1);
            
        }
         if(empty($food_quantity))
        {
            $food_quantity_error="this field is required";
            array_push($count_error,1);
            
        }
        
        if(empty($food_price))
        {
            $food_price_error="this field is required";
            array_push($count_error,2);
        }
        
        if(empty($pond_id))
        {
            $pond_id_error="this field is required";
            array_push($count_error,3);
        }
         if(empty($food_id))
        {
            $food_id_error="this field is required";
            array_push($count_error,3);
        }
         
       /* else
        {
            if(!preg_match('.[0-9]',$cost_amount))
            {
                $cost_amount_error="please enter a valid number";
                array_push($count_error,4);
            }
        }
     */
        if(count($count_error)==0)
        {
            $query="insert into food_set(food_id,pond_id,client,food_quantity,food_price,user_id,date)values($food_id,$pond_id,'$food_provider_name',$food_quantity,$food_price,$user_id,now())";
            $insert_query=mysqli_query($connection, $query);
            if(!$insert_query)
            {
                die("failed query".mysqli_error($connection));
            }
            header("location: set_foods.php");
        }

    }
}


?>


<form method="post" action="" enctype="multipart/form-data">
    
   <div class="form-group ">
    <label for="pond_id">Pond Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($pond_id_error)){echo $pond_id_error;}?></span>

    <select name="pond_id" class="form-control form-control-sm">
        <option value="">select pond</option>
 <?php 
    if(isset($current_user_id))
    {
        $user_id=$current_user_id;
        
        $query="select * from pond where user_id=$user_id";
        $select_pond=mysqli_query($connection, $query);
        
        while($row=mysqli_fetch_assoc($select_pond))
        {
            $pond_id=$row['pond_id'];
            $pond_name=$row['pond_name'];
            
            echo "<option value='$pond_id'>$pond_name</option>";
        }
        
        if(!select_pond)
        {
            die("query failed".mysqli_error($connection));
        }
    }
    
    
    ?>
    </select>
    </div>
     
    
    
    
    
    
    <div class="form-group ">
    <label for="food_id">Food Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_id_error)){echo $food_id_error;}?></span>

    <select name="food_id" class="form-control form-control-sm">
        <option value="">select food</option>
 <?php 
    if(isset($current_user_id))
    {
        $user_id=$current_user_id;
        
        $query="select * from foods where user_id=$user_id";
        $select_food=mysqli_query($connection, $query);
        
        while($row=mysqli_fetch_assoc($select_food))
        {
            $food_id=$row['food_id'];
            $food_name=$row['food_name'];
            
            echo "<option value='$food_id'>$food_name</option>";
        }
        
        if(!select_food)
        {
            die("query failed".mysqli_error($connection));
        }
    }
    
    
    ?>
        
       
    </select>
    </div>
    
    

    
    
    
    
<div class="form-group">
    <label for="food_provider_name">Food provider</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_provider_name_error)){echo $food_provider_name_error;}?></span>
    <input type="text" name="food_provider_name" class="form-control" value="<?php if(isset($food_provider_name)){echo $food_provider_name;}?>">
    </div>
    

    
    <div class="form-group">
    <label for="food_quantity">Food Quantity</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_quantity_error)){echo $food_quantity_error;}?></span>
    <input type="number" name="food_quantity" class="form-control" value="<?php if(isset($food_quantity)){echo $food_quantity;}?>">
    </div>
    
    
    
       
    <div class="form-group">
    <label for="food_price">Food Price (TK)</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($food_price_error)){echo $food_price_error;}?></span>
    <input type="text" name="food_price" class="form-control" value="<?php if(isset($food_price)){echo $food_price;}?>">
    </div>

    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="submit">
        <a class="btn btn-default" href="set_foods.php">cancel</a>
    </div>


</form>







