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
                        <div class="row">
                            
<!--        pond details-->
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        if(isset($_SESSION['username']))
                        {
                            
                            $username=$_SESSION['username'];
                            
                            $user_query="select * from users where username='$username'limit 1";
                            $select_user=mysqli_query($connection,$user_query);
                            $user=mysqli_fetch_assoc($select_user);
                            $user_id=$user['user_id'];
                            
                            $query="select * from pond where user_id=$user_id";
                            $select_query=mysqli_query($connection,$query);
                            if(!$select_query)
                            {
                                die("failed query".mysqli_error($connection));
                            }
                            $number_pond=mysqli_num_rows($select_query);
                             echo " <div class='huge'>$number_pond</div>";
                            
                        }
                        
                        
                        ?>
        
                        <div>Pond</div>
                    </div>
                </div>
            </div>
            <a href="ponds.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
<!--         set fish details                   -->
     <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        if(isset($_SESSION['username']))
                        {
                            
                            $username=$_SESSION['username'];
                            
                            $user_query="select * from users where username='$username'limit 1";
                            $select_user=mysqli_query($connection,$user_query);
                            $user=mysqli_fetch_assoc($select_user);
                            $user_id=$user['user_id'];
                            
                            $query="select user_id,fish_id,sum(fish_quantity) as fish_q from fish_set group by fish_id having user_id=$user_id";
                            $select_query=mysqli_query($connection,$query);
                            if(!$select_query)
                            {
                                die("failed query".mysqli_error($connection));
                            }
                            $number_fish=mysqli_fetch_assoc($select_query);
                            $fish=$number_fish['fish_q'];
                             echo " <div class='huge'>$fish</div>";
                            
                        }
                                                
                        ?>
        
                        <div>Set Fish</div>
                    </div>
                </div>
            </div>
            <a href="set_fishs.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
               
                            
                            
                            
    <!--        sell fish details                   -->
     <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        if(isset($_SESSION['username']))
                        {
                            
                            $username=$_SESSION['username'];
                            
                            $user_query="select * from users where username='$username'limit 1";
                            $select_user=mysqli_query($connection,$user_query);
                            $user=mysqli_fetch_assoc($select_user);
                            $user_id=$user['user_id'];
                            
                             $query="select user_id,fish_id,sum(fish_quantity) as fish_q from fish_sell group by fish_id having user_id=$user_id";
                            $select_query=mysqli_query($connection,$query);
                            if(!$select_query)
                            {
                                die("failed query".mysqli_error($connection));
                            }
                            $number_fish=mysqli_fetch_assoc($select_query);
                            $fish=$number_fish['fish_q'];
                             echo " <div class='huge'>$fish</div>";
                            
                        }
                                                
                        ?>
        
                        <div>Sell Fish</div>
                    </div>
                </div>
            </div>
            <a href="sell_fishs.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>                        
                            
                         
                         
<!--    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <?php
                        
                        $query="select * from comments";
                        $comment_select=mysqli_query($connection,$query);
                         $number_comment=mysqli_num_rows($comment_select);
                        
                        echo " <div class='huge'>$number_comment</div>";
                        
                        ?> 
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>-->
                            
        <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
            $pond_query="select * from pond where user_id=$user_id";
           $select_pond=mysqli_query($connection,$pond_query);
           $pond_count=mysqli_num_rows($select_pond);
           
                $query="select p.user_id,p.pond_id as pond_i,p.pond_name as pond_n,setf.fish_quantitys as set_fish_quantity,setf.fish_weights as set_fish_weight,setf.fish_prices as set_fish_price,sellf.fish_quantityl as sell_fish_quantity,sellf.fish_weightl as sell_fish_weight,sellf.fish_pricel as sell_fish_price from pond as p left join (select pond_id,SUM(fish_quantity)as fish_quantitys,SUM(fish_weight) as fish_weights,SUM(fish_price) as fish_prices from fish_set group by pond_id) as setf on p.pond_id=setf.pond_id left join(select pond_id,SUM(fish_quantity) as fish_quantityl,SUM(fish_weight) as fish_weightl,SUM(fish_price) as fish_pricel from fish_sell group by pond_id) as sellf on p.pond_id=sellf.pond_id where p.user_id=$user_id";
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
         
           
           while($row=mysqli_fetch_assoc($select_query))
           {
               $pond_name=$row['pond_n'];
               $pond_id=$row['pond_i'];
               $total_set_fish_quantity=$row['set_fish_quantity'];
               $total_set_fish_weight=$row['set_fish_weight'];
               $total_set_fish_price=$row['set_fish_price'];
               $total_sell_fish_quantity=$row['sell_fish_quantity'];
               $total_sell_fish_weight=$row['sell_fish_weight'];
               $total_sell_fish_price=$row['sell_fish_price'];
               
           }
           
         
           
           
     } ?>
                             
                        
                        
                        
                        
                        
       <div class="row">
           
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
        <?php
            
            $element_text=['total pond','total fish','total sell fish','total cost','total sell amount','fish set weight','fish sell weight'];
            $element_count=[$pond_count,$total_set_fish_quantity,$total_sell_fish_quantity,$total_set_fish_price,$total_sell_fish_price,set_fish_weight,$total_sell_fish_weight];
            
            for($i=0;$i<7;$i++)
            {
                echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
            }
            
       ?>    
            
       
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
           
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>   
                                                
                            
                            
                            
                            
                            
                        </div>
                        
                        

                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
 </div>
   <?php include"includes/admin_footer.php";?>