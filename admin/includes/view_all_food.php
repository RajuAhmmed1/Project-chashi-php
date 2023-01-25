<style>
    #table_head tr th,.table_body{
        text-align: center;
    }

</style>

<a style="margin-bottom:20px;" class="btn btn-primary" href="foods.php?source=add_food">add new</a>
<table class="table table-bordered table-hover" id="food">
<thead id="table_head">
    <tr>
        <th>food id</th>
        <th>food name</th>
        <th>food type</th>
        <th>action</th>
    </tr>
</thead>
    
    <tbody class="table_body">
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           $query="select * from foods where user_id=$user_id";
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $food_id=$row['food_id'];
               $food_name=$row['food_name'];
               $food_type=$row['food_type'];
               
          
        
            echo"<tr>";
            echo"<td>$food_id</td>";
            echo"<td>$food_name</td>";
            echo"<td>$food_type</td>";
            echo" <td><a  href='foods.php?source=edit_food&food_id={$food_id}'>edit</a> 
                 <a  href='foods.php?delete= $food_id'>delete</a></td>";
        
             echo"</tr>";    
               
           }
     } ?>
        
        <?php
        if(isset($_GET['delete']))
        {
            $food_id=$_GET['delete'];
            $query="delete from foods where food_id=$food_id";
            $delete_query=mysqli_query($connection, $query);
            if(!$delete_query)
            {
                die("query failed".mysqli_error($connection));
            }
            header("location: foods.php");
        }
        
        
        
        ?>
    
    
    </tbody>
    
    
    
</table>

       
 <script type="text/javascript">

$(document).ready( function () {
    $('#food').DataTable();
} );


</script>