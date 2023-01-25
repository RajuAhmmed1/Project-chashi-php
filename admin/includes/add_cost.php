<?php
if(isset($current_user_id))
{
    $user_id=$current_user_id;
    
    if(isset($_POST['submit']))
    {
        $cost_name=$_POST['cost_name'];
        $pond_id=$_POST['pond_id'];
        $cost_amount=$_POST['cost_amount'];
        
        $cost_name=mysqli_real_escape_string($connection, trim($cost_name));
        $cost_amount=mysqli_real_escape_string($connection, trim($cost_amount));
        $pond_id=mysqli_real_escape_string($connection, trim($pond_id));
        
        $count_error=array();
        
        if(empty($cost_name))
        {
            $cost_name_error="cost name is required";
            array_push($count_error,1);
            
        }
        
        if(empty($pond_id))
        {
            $pond_name_error="pond name is required";
            array_push($count_error,2);
        }
        
        if(empty($cost_amount))
        {
            $cost_amount_error="amount is required";
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
            $query="insert into cost(cost_name,pond_id,cost_amount,user_id,date)values('$cost_name',$pond_id,$cost_amount,$user_id,now())";
            $insert_query=mysqli_query($connection, $query);
            if(!$insert_query)
            {
                die("failed query".mysqli_error($connection));
            }
            header("location: costs.php");
        }

    }
}


?>


<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
    <label for="cost_name">Cost Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($cost_name_error)){echo $cost_name_error;}?></span>
    <input type="text" name="cost_name" class="form-control" value="<?php if(isset($cost_name)){echo $cost_name;}?>">
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
    <label for="cost_amount">Cost Amount</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($cost_amount_error)){echo $cost_amount_error;}?></span>
    <input type="text" name="cost_amount" class="form-control" value="<?php if(isset($cost_amount)){echo $cost_amount;}?>">
    </div>

    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="submit">
        <a class="btn btn-default" href="costs.php">cancel</a>
    </div>


</form>







