<?php
if(isset($_GET['pond_id']))
{
    $pond_id=$_GET['pond_id'];
    $query="select * from pond where pond_id=$pond_id";
    $select_pond=mysqli_query($connection,$query);
    $pond=mysqli_fetch_assoc($select_pond);
    if(!$select_pond)
    {
        die("failed query".mysqli_error($connection));
    }
    else
    {
        $pond_name=$pond['pond_name'];
    }
    
}


?>



<!--search area start-->


<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group col-md-3">
 <label for="fish_id">Fish Name</label>
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_id_error)){echo $fish_id_error;}?></span>

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
        
        if(!select_fish)
        {
            die("query failed".mysqli_error($connection));
        }
    }
        
    ?>

    </select>

</div>
    
 <div class="form-group col-md-3" >
<!-- <label for="fish_id">Select a Option</label>-->
    <span class="error" style="color:red; text-align:center;"><?php if(isset($fish_id_error)){echo $fish_id_error;}?></span>
<label for="fcategory">Set/Sell Fish</label>
    <select name="fcategory" class="form-control form-control-sm">
        <option value="">select a option</option>
        <option value="set fish">set fish</option>
        <option value="sell fish">sell fish</option>

    </select>

</div>
     
    
    
    
<div class="form-group col-md-2" style="clear:right;">
 <label for="indate">First Date</label>
 <input type="date" name="indate" class="form-control">

</div>
    
<div class="form-group col-md-2" style="clear:right;">
 <label for="ldate">Last Date</label>
 <input type="date" name="ldate" class="form-control">

</div>
    
    <input class="btn btn-primary btn-mg" style="width: 150px; margin-top:25px; " type="submit" name="submit" value="search">
</form>


<!--search area end-->


<!-- set fish table start-->

<table class="table table-bordered table-hover">
       <br><h4 style="font-weight:bold;" >set fishes of pond <span style="color:orange;font-weight:bold;"><?php echo strtoupper($pond_name);?></span></h4>
<thead>
    <tr>
        <th>fish name</th>
        <th>fist quantity</th>
        <th>fish weight (kg)</th>
        <th>fish price (tk)</th>
    </tr>

</thead>
    
    <tbody>
    <?php
        
        if(isset($_GET['pond_id']))
        {
            $pond_id=$_GET['pond_id'];
            $query="select pond_id,fish_name,fish_set.fish_id,SUM(fish_quantity) as fish_quantitys,SUM(fish_weight) as fish_weights,SUM(fish_price)as fish_prices from fish_set inner join fish on fish_set.fish_id=fish.fish_id group by fish_set.fish_id,pond_id having pond_id=$pond_id";
            
        $select_set_fish=mysqli_query($connection,$query);
            
            if(!$select_set_fish)
            {
                die("query failed".mysqli_error($connection));
            }
     
        $total_fish_price=0;
           while($row=mysqli_fetch_assoc($select_set_fish))
           {
               $fish_name=$row['fish_name'];
               $fish_quantity=$row['fish_quantitys'];
               $fish_weight=$row['fish_weights'];
               $fish_price=$row['fish_prices'];
               
               
               $total_fish_price+=$fish_price;

        
            echo"<tr>";
            echo"<td>$fish_name</td>";
            echo"<td>$fish_quantity</td>";
            echo"<td>$fish_weight</td>";
            echo"<td>$fish_price</td>";
        
             echo"</tr>";    
               
           }
            
                
   echo"<tr>";
         echo"<td style='font-weight:bold;'>Total Amount</td>";
             echo"<td></td>";
             echo"<td></td>";
        echo"<td style='font-weight:bold;'>$total_fish_price tk </td>";
        echo"</tr>";
     }
        ?>
    
        
    
    </tbody>
    

    
    
</table>
<!--    set fish table end-->


<hr>
<!--sell fish table start-->

<table class="table table-bordered table-hover">
<h4 style="font-weight:bold;" >sell fishes of pond <span style="color:orange;font-weight:bold;"><?php echo strtoupper($pond_name);?></span></h4>

<thead>
    <tr>
        <th>fish name</th>
        <th>fist quantity</th>
        <th>fish weight (kg)</th>
        <th>fish price (tk)</th>
    </tr>
</thead>
    
    <tbody>
    <?php
        // query have to be fixed
        if(isset($_GET['pond_id']))
        {
            $pond_id=$_GET['pond_id'];
            $query="select pond_id,fish_name,fish_sell.fish_id,SUM(fish_quantity) as fish_quantitys,SUM(fish_weight) as fish_weights,SUM(fish_price)as fish_prices from fish_sell inner join fish on fish_sell.fish_id=fish.fish_id group by fish_sell.fish_id,pond_id having pond_id=$pond_id";
            
        $select_set_fish=mysqli_query($connection,$query);
            
            if(!$select_set_fish)
            {
                die("query failed".mysqli_error($connection));
            }
     
  
           $total_fish_price=0;
           while($row=mysqli_fetch_assoc($select_set_fish))
           {
               $fish_name=$row['fish_name'];
               $fish_quantity=$row['fish_quantitys'];
               $fish_weight=$row['fish_weights'];
               $fish_price=$row['fish_prices'];
               
               $total_fish_price+=$fish_price;
        
            echo"<tr>";
            echo"<td>$fish_name</td>";
            echo"<td>$fish_quantity</td>";
            echo"<td>$fish_weight</td>";
            echo"<td>$fish_price</td>";
        
             echo"</tr>";    
               
           }
            
              echo"<tr>";
         echo"<td style='font-weight:bold;'>Total Amount</td>";
             echo"<td></td>";
             echo"<td></td>";
        echo"<td style='font-weight:bold;'>$total_fish_price tk </td>";
        echo"</tr>";
     }
        ?>
        
    
    </tbody>
    
    
    
</table>

<!--sell fish table end-->



<hr>
<!--cost table start-->

<table class="table table-bordered table-hover">
<h4 style="font-weight:bold;" >cost of pond <span style="color:orange;font-weight:bold;"><?php echo strtoupper($pond_name);?></span></h4>

<thead>
    <tr>
        <th>cost name</th>
        <th>cost amount</th>
        <th>food name</th>
        <th>total food cost</th>
        <th>total sack</th>
    </tr>
</thead>
    
    <tbody>
    <?php
        
        if(isset($_GET['pond_id']))
        {
            $pond_id=$_GET['pond_id'];
            $query="select ff.food_name as f_name,ff.food_id,f.pond_id,f.food_id,SUM(f.food_price) as f_price,SUM(f.food_quantity) as f_quantity,c.pond_id,c.cost_name as c_name,SUM(c.cost_amount) as c_amount from food_set as f inner join cost as c on f.pond_id=c.pond_id inner join foods as ff on f.food_id=ff.food_id group by f.food_id,c_name having f.pond_id=$pond_id";
            
        $select_cost=mysqli_query($connection,$query);
            
            if(!$select_cost)
            {
                die("query failed".mysqli_error($connection));
            }
     
           while($row=mysqli_fetch_assoc($select_cost))
           {
               $food_price=$row['f_price'];
               $food_quantity=$row['f_quantity'];
               $cost_name=$row['c_name'];
               $cost_amount=$row['c_amount'];
               $food_name=$row['f_name'];
        
            echo"<tr>";
            echo"<td>$cost_name</td>";
            echo"<td>$cost_amount</td>";
            echo"<td>$food_name</td>";   
          
            echo"<td>$food_price</td>";
            echo"<td>$food_quantity</td>";
        
             echo"</tr>";    
               
           }
            
         /*     echo"<tr>";
         echo"<td style='font-weight:bold;'>Total Amount</td>";
             echo"<td></td>";
             echo"<td></td>";
        echo"<td style='font-weight:bold;'>$total_fish_price tk </td>";
        echo"</tr>";*/
     }
        ?>
        
    
    </tbody>
    
    
    
</table>



<!--cost table end-->





<hr>

<table class="table table-bordered table-hover">
<h4 style="font-weight:bold;" >result of <span style="color:orange;font-weight:bold;"><?php echo strtoupper($pond_name);?></span></h4>

<thead>
    <tr>
        <th>total cost</th>
        <th>total income</th>
         <th>profit amount (tk)</th>
        <th>lose amount (tk)</th>
       
    </tr>
</thead>
    
    <tbody>
    <?php
        
        if(isset($_GET['pond_id']))
        {
            $pond_id=$_GET['pond_id'];
           $query="select p.user_id,p.pond_id as pond_i,c.cost_name,c.cost_amounts as cost_amount,p.pond_name as pond_n,setf.fish_quantitys as set_fish_quantity,setf.fish_weights as set_fish_weight,setf.fish_prices as set_fish_price,sellf.fish_quantityl as sell_fish_quantity,sellf.fish_weightl as sell_fish_weight,sellf.fish_pricel as sell_fish_price,fd.f_price as food_prices,fd.f_quantity as food_quantitys from pond as p left join (select pond_id,SUM(fish_quantity)as fish_quantitys,SUM(fish_weight) as fish_weights,SUM(fish_price) as fish_prices from fish_set group by pond_id) as setf on p.pond_id=setf.pond_id left join(select pond_id,SUM(fish_quantity) as fish_quantityl,SUM(fish_weight) as fish_weightl,SUM(fish_price) as fish_pricel from fish_sell group by pond_id) as sellf on p.pond_id=sellf.pond_id left join (select pond_id,cost_name,sum(cost_amount) as cost_amounts from cost group by pond_id)as c on p.pond_id=c.pond_id left join(select pond_id,SUM(food_quantity) as f_quantity,SUM(food_price) as f_price from food_set group by pond_id) as fd on p.pond_id=fd.pond_id where p.pond_id=$pond_id limit 1";
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
          $count_pond_detail=mysqli_num_rows($select_query);
           $t_cost=0;
           $result=0;
           $t_prof=0;
            $t_income=0;
           while($row=mysqli_fetch_assoc($select_query))
           {
               $pond_name=$row['pond_n'];
               $pond_id=$row['pond_i'];
               $total_set_fish_quantity=$row['set_fish_quantity'];
               $total_set_fish_weight=$row['set_fish_weight'];
               $total_set_fish_price=$row['set_fish_price'];
               $total_sell_fish_quantity=$row['sell_fish_quantity'];
               $total_sell_fish_weight=$row['sell_fish_weight'];
               $total_sell_fish_price=$row['sell_fish_price'];
               $total_cost=$row['cost_amount'];
               $total_food_cost=$row['food_prices'];
               $total_food_quantity=$row['food_quantitys'];
               
               $t_cost=$total_cost+$total_set_fish_price+$total_food_cost;
               $t_income+=$total_sell_fish_price;
               
               $result=$t_income - $t_cost;

        
            echo"<tr>";
            echo"<td>$t_cost</td>";
            echo"<td>$t_income</td>";
               if($result >=0)
               {
                   
                    echo"<td>$result</td>";
               }
               else
               {
                   $profit=0;
                   echo"<td>$profit</td>";
               }
               
               if($result<0)
               {
                   $result=$result*(-1);
                    echo"<td style='font-weight:bold;'>$result</td>";
               }
               else
               {
                     $lose=0;
                   echo"<td >$lose</td>";
               }
           
        
        
             echo"</tr>";    
               
           }
            
     }
        ?>
        
    
    </tbody>
    
    
    
</table>