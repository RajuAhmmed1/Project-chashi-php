<a style="margin-bottom:20px;" class="btn btn-primary" href="fishs.php?source=add_fish">add new</a>
<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>fish id</th>
        <th>fish name</th>
        <th>action</th>
    </tr>
</thead>
    
    <tbody>
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           $query="select * from fish where user_id=$user_id";
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $fish_id=$row['fish_id'];
               $fish_name=$row['fish_name'];
               
          
        
            echo"<tr>";
            echo"<td>$fish_id</td>";
            echo"<td>$fish_name</td>";
            echo" <td><a href='fishs.php?source=edit_fish&fish_id={$fish_id}'>edit</a> 
                <a href='fishs.php?delete= $fish_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        <?php
        if(isset($_GET['delete']))
        {
            $fish_id=$_GET['delete'];
            $query="delete from fish where fish_id=$fish_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: fishs.php");
        }
        
        
        
        ?>
    
    
    </tbody>
    
    
    
</table>