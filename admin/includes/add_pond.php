<?php
if(isset($_POST['submit']))
{
    $pond_name=$_POST['pond_name'];
    $pond_size=$_POST['pond_size'];
    $pond_location=$_POST['pond_location'];
    $pond_date=date(d-m-y);

   
    if(empty($pond_name && $pond_size && $pond_location))
    {
        echo "Empty field not allow";
    }
    
   else
   {
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
       $query="insert into pond(pond_name,pond_size,pond_location,date,user_id)values('$pond_name','$pond_size','$pond_location',now(),'$user_id') ";
       $pond_insert_query=mysqli_query($connection,$query);
       header("Location:ponds.php");
       
   }
    
    
    
}



?>

<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="pond_name">Pond Name</label>
          <input type="text" class="form-control" name="pond_name" value="<?php if(isset($pond_name)){echo $pond_name;}?>">
      </div>
        
        
    <div class="form-group">
         <label for="pond_size">Pond size</label>
          <input type="text" class="form-control" name="pond_size" value="<?php if(isset($pond_size)){echo $pond_size;}?>"> 
      </div>
      
    <div class="form-group">
         <label for="pond_location">Pond Location</label>
          <input type="text" class="form-control" name="pond_location" value="<?php if(isset($pond_location)){echo $pond_location;}?>">
      </div>

      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="submit" value="submit">
           <a class="btn btn-default" href="ponds.php?source=view_all_pond">Cancel</a>
      </div>


</form>