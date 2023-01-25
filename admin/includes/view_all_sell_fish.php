<a style="margin-bottom:20px;" class="btn btn-primary" href="sell_fishs.php?source=add_sell_fish">add new</a>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>sell fish id</th>
        <th>pond name</th>
        <th>fish name</th>
        <th>client name</th>
        <th>fish quanity name</th>
        <th>fish weight (kg)</th>
        <th>fish price (tk)</th>
        <th>date</th>
        <th>action</th>
    </tr>
</thead>
    
    <tbody>
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           
           
           
           $query="select fish_sell_id,fish.fish_name,pond.pond_name,fish_client_name,fish_quantity,fish_price,fish_sell.date,fish_weight from fish_sell inner join pond on fish_sell.pond_id=pond.pond_id inner join fish on fish_sell.fish_id=fish.fish_id where fish_sell.user_id=$user_id" ;
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $fish_sell_id=$row['fish_sell_id'];
               $fish_name=$row['fish_name'];
               $pond_name=$row['pond_name'];
               $fish_client_name=$row['fish_client_name'];
               $fish_quantity=$row['fish_quantity'];
               $fish_price=$row['fish_price'];
               $fish_weight=$row['fish_weight'];
               $date=$row['date'];
          
        
            echo"<tr>";
            echo"<td>$fish_sell_id</td>";
            echo"<td>$pond_name</td>";
            echo"<td>$fish_name</td>";
            echo"<td>$fish_client_name</td>";
            echo"<td>$fish_quantity</td>";
            echo"<td>$fish_weight</td>";  
            echo"<td>$fish_price</td>";     
            echo"<td>$date</td>";
               
            echo" <td><a href='sell_fishs.php?source=edit_sell_fish&fish_sell_id={$fish_sell_id}'>edit</a> 
                <a href='sell_fishs.php?delete= $fish_sell_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        
            <!--delete query-->
        <?php
        if(isset($_GET['delete']))
        {
            $fish_sell_id=$_GET['delete'];
            $query="delete from fish_sell where fish_sell_id=$fish_sell_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: sell_fishs.php");
        }

        ?>
    
    
    </tbody>
    
    
    
</table>