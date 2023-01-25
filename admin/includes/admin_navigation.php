       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CH Admin</a>
            </div>
           <?php
           
           if(isset($_SESSION['username']))
           {
               $username=$_SESSION['username'];
               
               
               $query="select * from users where username='$username'";
               $select_user_query=mysqli_query($connection,$query);
               
               if(!$select_user_query)
               {
                   die("query failed".mysqli_error($connection));
               }
               
               
               while($row=mysqli_fetch_assoc($select_user_query))
               {
                   $current_username=$row['username'];
                   $user_image=$row['user_image'];
                   $current_user_id=$row['user_id'];
               }
           }
           
           
           
           
           
           ?>
           
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
          
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img style="border-radius:5px" width="50" src="../images/<?php echo $user_image?>"> <?php echo $_SESSION['username']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                   
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pond"><i class="fa fa-fw fa-arrows-v"></i> Ponds <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pond" class="collapse">
                            <li>
                                <a href="ponds.php?source=add_pond">add new</a>
                            </li>
                            <li>
                                <a href="ponds.php?source=view_all_pond">view all pond</a>
                            </li>
                        </ul>
                    </li>
                    
                      <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#fish"><i class="fa fa-fw fa-arrows-v"></i> Fishs <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="fish" class="collapse">
                            <li>
                                <a href="fishs.php?source=add_fish">add new</a>
                            </li>
                            <li>
                                <a href="fishs.php?source=view_all_fish">view all fish</a>
                            </li>
                        </ul>
                    </li>
                    
                      <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#foods"><i class="fa fa-fw fa-arrows-v"></i> Foods <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="foods" class="collapse">
                            <li>
                                <a href="foods.php?source=add_food">add new</a>
                            </li>
                            <li>
                                <a href="foods.php?source=view_all_food">view all food</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                      <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#costs"><i class="fa fa-fw fa-arrows-v"></i> Costs <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="costs" class="collapse">
                            <li>
                                <a href="costs.php?source=add_cost">add new</a>
                            </li>
                            <li>
                                <a href="costs.php?source=view_all_cost">view all cost</a>
                            </li>
                        </ul>
                    </li>
                    
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#setfish"><i class="fa fa-fw fa-arrows-v"></i> Set Fish <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="setfish" class="collapse">
                            <li>
                                <a href="set_fishs.php?source=add_set_fish">add new</a>
                            </li>
                            <li>
                                <a href="set_fishs.php?source=view_all_set_fish">view all set fish</a>
                            </li>
                        </ul>
                    </li>
                    
                          <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#sellfish"><i class="fa fa-fw fa-arrows-v"></i> Sell Fish <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="sellfish" class="collapse">
                            <li>
                                <a href="sell_fishs.php?source=add_sell_fish">add new</a>
                            </li>
                            <li>
                                <a href="sell_fishs.php?source=view_all_sell_fish">view all sell fish</a>
                            </li>
                        </ul>
                    </li>
                    
                               <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#setfood"><i class="fa fa-fw fa-arrows-v"></i> Set Foods <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="setfood" class="collapse">
                            <li>
                                <a href="set_foods.php?source=add_set_food">add new</a>
                            </li>
                            <li>
                                <a href="set_foods.php?source=view_all_sell_food">view all sell food</a>
                            </li>
                        </ul>
                    </li>
                    
 
                      <li>
                        <a href="pond_details.php"><i class="fa fa-fw fa-info-circle"></i>  Pond Details</a>
                    </li>
                   
                
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-pencil"></i>  Elements</a>
                    </li>
                   
                   
                 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>