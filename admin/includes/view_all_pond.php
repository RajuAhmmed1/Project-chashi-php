<a style="margin-bottom:20px;" class="btn btn-primary" href="ponds.php?source=add_pond">add new</a>

<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                         <th>Pond Name</th>
                         <th>Pond Size</th>
                         <th>Pond Location</th>
                         <th>Date</th>
                         <th>Action</th>
                    </tr>

                </thead>
               

                <tbody>
                    
                <?php
                if(isset($_SESSION['username']))
                {
                    $username=$_SESSION['username'];
                    $query="select * from users where username='$username'";
                    $select_users=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_users))
                    {
                        $user_id=$row['user_id'];
                    }
                }
                
                $query="select * from pond where user_id=$user_id ";
                $select_pond=mysqli_query($connection,$query);
                
               while($row=mysqli_fetch_assoc($select_pond))
                {
                    $pond_id=$row['pond_id'];
                    $pond_name=$row['pond_name'];
                    $pond_size=$row['pond_size'];
                    $pond_location=$row['pond_location'];
                    $pond_date=$row['date'];

                    
                   
                    
                     echo "<tr>";
                    
                     echo "<td>$pond_id</td>";
                     echo "<td>$pond_name</td>";
                     echo "<td> $pond_size</td>";
                     echo "<td>$pond_location</td>";
                     echo "<td>$pond_date</td>";
                     echo "<td><a href='ponds.php?source=edit_pond&pond_id={$pond_id}'>Edit |</a>
                               <a href='ponds.php?delete={$pond_id}'> Delete</a></td>";
                
                    
                     echo "</tr>";
                    
                    
                    
                }
             
                
                
                
                ?>


                </tbody>
            </table>

  <?php

    
    if(isset($_GET['delete']))
    {
        $pond_id=$_GET['delete'];
        $query="delete from pond where pond_id=$pond_id and user_id=$user_id";
        $delete_query=mysqli_query($connection,$query);
        header("Location: ponds.php");
    }



?>