<?php ob_start();?>
<?php include"includes/function.php";?>
<?php include "includes/admin_header.php";?>

    <div id="wrapper">

        <!-- Navigation -->
 <?php include"includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                 <?php if(isset($_SESSION['username'])) {
    
                    $username=$_SESSION['username'];
                    $query="select * from users where username='$username' Limit 1";
                    $select_query=mysqli_query($connection, $query);
                    $user=mysqli_fetch_assoc($select_query);
    
    
    
                        }?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                             <small><?php echo $user['username'];?></small>
                        </h1>
                       
                        
                        <?php
                        if(isset($_GET['source']))
                        {
                            $source=$_GET['source'];
                        }
                        else
                        {
                            $source="";
                        }
                        
                        switch($source)
                        {
                            case 'add_sell_fish':
                                include"includes/add_sell_fish.php";
                                break;
                                
                            case 'edit_sell_fish':
                                include"includes/edit_sell_fish.php";
                                break;
                            default:
                                include"includes/view_all_sell_fish.php";
                                break;
                        }
                        
                        
                        
                        
                        ?>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include"includes/admin_footer.php";?>