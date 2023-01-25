<?php
session_start();
?>

<?php
if(!isset($_SESSION['username']))
{
    header("Location:login.php"); 
}
else
{
    header("Location:admin");
}

?>

<?php include"includes/header.php"; ?>


    <!-- Navigation -->
  <?php include"includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        
        
        
        
        
        
        </div>

  
    
        <!-- /.row -->
<?php include"includes/footer.php"; ?>

      