<a style="margin-bottom:20px;" class="btn btn-primary" href="set_fishs.php?source=add_set_fish">add new</a>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>set fish id</th>
        <th>pond name</th>
        <th>fish name</th>
        <th>fish provider name</th>
        <th>fish quanity</th>
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
           
           
           
           
           $query="select fish_set_id,fish.fish_name,pond.pond_name,fish_provider_name,fish_quantity,fish_price,fish_set.date,fish_weight from fish_set inner join pond on fish_set.pond_id=pond.pond_id inner join fish on fish_set.fish_id=fish.fish_id where fish_set.user_id=$user_id" ;
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $fish_set_id=$row['fish_set_id'];
               $fish_name=$row['fish_name'];
               $pond_name=$row['pond_name'];
               $fish_provider_name=$row['fish_provider_name'];
               $fish_quantity=$row['fish_quantity'];
               $fish_price=$row['fish_price'];
               $fish_weight=$row['fish_weight'];
               $date=$row['date'];
          
        
            echo"<tr>";
            echo"<td>$fish_set_id</td>";
            echo"<td>$pond_name</td>";
            echo"<td>$fish_name</td>";
            echo"<td>$fish_provider_name</td>";
            echo"<td>$fish_quantity</td>";
            echo"<td>$fish_weight</td>";  
            echo"<td>$fish_price</td>";     
            echo"<td>$date</td>";
               
            echo" <td><a href='set_fishs.php?source=edit_set_fish&fish_set_id={$fish_set_id}'>edit</a> 
                <a href='set_fishs.php?delete= $fish_set_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        
            <!--delete query-->
        <?php
        if(isset($_GET['delete']))
        {
            $fish_set_id=$_GET['delete'];
            $query="delete from fish_set where fish_set_id=$fish_set_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: set_fishs.php");
        }

        ?>
    
    
    </tbody>
    
    
    
</table>