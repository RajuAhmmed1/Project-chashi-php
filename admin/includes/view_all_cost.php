<a style="margin-bottom:20px;" class="btn btn-primary" href="costs.php?source=add_cost">add new</a>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>cost id</th>
        <th>cost name</th>
        <th>pond name</th>
        <th>cost amount</th>
        <th>date</th>
        <th>action</th>
    </tr>
</thead>
    
    <tbody>
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           
           
           
           $query="select pond_name,cost_id,pond.pond_id,cost_name,cost_amount,cost.date from cost inner join pond on cost.user_id=$user_id and cost.pond_id=pond.pond_id" ;
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $cost_id=$row['cost_id'];
               $cost_name=$row['cost_name'];
               $pond_name=$row['pond_name'];
               $cost_amount=$row['cost_amount'];
               $date=$row['date'];
          
        
            echo"<tr>";
            echo"<td>$cost_id</td>";
            echo"<td>$cost_name</td>";
            echo"<td>$pond_name</td>";
            echo"<td>$cost_amount</td>";
            echo"<td>$date</td>";
            echo" <td><a href='costs.php?source=edit_cost&cost_id={$cost_id}'>edit</a> 
                <a href='costs.php?delete= $cost_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        
            <!--delete query-->
        <?php
        if(isset($_GET['delete']))
        {
            $fish_id=$_GET['delete'];
            $query="delete from cost where cost_id=$cost_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: costs.php");
        }

        ?>
    
    
    </tbody>
    
    
    
</table>