<a style="margin-bottom:20px;" class="btn btn-primary" href="set_foods.php?source=add_set_food">add new</a>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>set food id</th>
        <th>pond name</th>
        <th>food name</th>
        <th>client name</th>
        <th>food quanity</th>
        <th>food price (tk)</th>
        <th>date</th>
        <th>action</th>
    </tr>
</thead>
    
    <tbody>
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           
           
           
           $query="select f.food_set_id as food_set_id,f.client as food_client_name,f.food_quantity as food_quantity, f.food_price as food_price,p.pond_name,p.pond_id,ff.food_id,ff.food_name as food_name,f.user_id,f.date as date from food_set as f inner join pond as p on f.pond_id=p.pond_id inner join foods as ff on f.food_id=ff.food_id where f.user_id=$user_id";
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $food_set_id=$row['food_set_id'];
               $food_name=$row['food_name'];
               $pond_name=$row['pond_name'];
               $food_provider_name=$row['food_client_name'];
               $food_quantity=$row['food_quantity'];
               $food_price=$row['food_price'];
               $date=$row['date'];
          
        
            echo"<tr>";
            echo"<td>$food_set_id</td>";
            echo"<td>$pond_name</td>";
            echo"<td>$food_name</td>";
            echo"<td>$food_provider_name</td>";
            echo"<td>$food_quantity</td>";
            echo"<td>$food_price</td>";    
            echo"<td>$date</td>";
               
            echo" <td><a href='set_foods.php?source=edit_set_food&food_set_id={$food_set_id}'>edit</a> 
                <a href='set_foods.php?delete= $food_set_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        
            <!--delete query-->
        <?php
        if(isset($_GET['delete']))
        {
            $fish_set_id=$_GET['delete'];
            $query="delete from food_set where food_set_id=$food_set_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: set_foods.php");
        }

        ?>
    
    
    </tbody>
    
    
    
</table>