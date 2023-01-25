<?php
if(isset($current_user_id))
{
    $user_id=$current_user_id;
    
    if(isset($_POST['submit']))
    {
        $fish_id=$_POST['fish_id'];
        $pond_id=$_POST['pond_id'];
        $fish_provider_name=$_POST['fish_provider_name'];
        $fish_quantity=$_POST['fish_quantity'];
        $fish_price=$_POST['fish_price'];
        $fish_weight=$_POST['fish_weight'];
        
        $fish_provider_name=mysqli_real_escape_string($connection, trim($fish_provider_name));
        $fish_quantity=mysqli_real_escape_string($connection, trim($fish_quantity));
        $fish_price=mysqli_real_escape_string($connection, trim($fish_price));
        $fish_weight=mysqli_real_escape_string($connection, trim($fish_weight));
        
        
        $count_error=array();
        
        if(empty($fish_provider_name))
        {
            $fish_provider_name_error="this field is required";
            array_push($count_error,1);
            
        }
         if(empty($fish_weight))
        {
            $fish_weight_error="this field is required";
            array_push($count_error,1);
            
        }
        
        if(empty($fish_quantity))
        {
            $fish_quantity_error="this field is required";
            array_push($count_error,2);
        }
        
        if(empty($fish_price))
        {
            $fish_price_error="this field is required";
            array_push($count_error,3);
        }
         if(empty($fish_id))
        {
            $fish_name_error="this field is required";
            array_push($count_error,3);
        }
         if(empty($pond_id))
        {
            $pond_name_error="this field is required";
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
            $query="insert into fish_set(fish_id,pond_id,fish_provider_name,fish_quantity,fish_price,fish_weight,user_id,date)values($fish_id,$pond_id,'$fish_provider_name',$fish_quantity,$fish_price,$fish_weight,$user_id,now())";
            $insert_query=mysqli_query($connection, $query);
            if(!$insert_query)
            {
                die("failed query".mysqli_error($connection));
            }
            header("location: set_fishs.php");
        }

    }
}


?>


<form method="post" action="" enctype="multipart/form-data">
    
    <div class="form-group ">
    <label for="fish_id">Fish Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_name_error)){echo $fish_name_error;}?></span>

    <select name="fish_id" class="form-control form-control-sm">
        <option value="">select fish</option>
 <?php 
    if(isset($current_user_id))
    {
        $user_id=$current_user_id;
        
        $query="select * from fish where user_id=$user_id";
        $select_fish=mysqli_query($connection, $query);
        
        while($row=mysqli_fetch_assoc($select_fish))
        {
            $fish_id=$row['fish_id'];
            $fish_name=$row['fish_name'];
            
            echo "<option value='$fish_id'>$fish_name</option>";
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
    <label for="pond_id">Pond Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($pond_name_error)){echo $pond_name_error;}?></span>

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
    
    
    
    
<div class="form-group">
    <label for="fish_provider_name">Fish Provider Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_provider_name_error)){echo $fish_provider_name_error;}?></span>
    <input type="text" name="fish_provider_name" class="form-control" value="<?php if(isset($fish_provider_name)){echo $fish_provider_name;}?>">
    </div>
    

    
    <div class="form-group">
    <label for="fish_quantity">Fish Quantity</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_quantity_error)){echo $fish_quantity_error;}?></span>
    <input type="text" name="fish_quantity" class="form-control" value="<?php if(isset($fish_quantity)){echo $fish_quantity;}?>">
    </div>
    
    
      
    <div class="form-group">
    <label for="fish_weight">Fish Weight (KG)</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_weight_error)){echo $fish_weight_error;}?></span>
    <input type="text" name="fish_weight" class="form-control" value="<?php if(isset($fish_weight)){echo $fish_weight;}?>">
    </div>
    
       
    <div class="form-group">
    <label for="fish_price">Fish Price (TK)</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_price_error)){echo $fish_price_error;}?></span>
    <input type="text" name="fish_price" class="form-control" value="<?php if(isset($fish_price)){echo $fish_price;}?>">
    </div>

    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="submit">
        <a class="btn btn-default" href="set_fishs.php">cancel</a>
    </div>


</form>







