<table class="table table-bordered table-hover">
<thead>
    <tr>
        <th>pond name</th>
        <th>total set fish</th>
        <th>total sell fish</th>
        <th>total set fish weight</th>
        <th>total sell fish weight</th>
          <th>total set cost amount (tk)</th>
        <th>total sell amount (tk)</th>
<!--        <th>total cost (tk)</th>-->
      
        <th>action</th>
    </tr>
</thead>
    
    <tbody>
    <?php
       if(isset($current_user_id))
       {
           $user_id=$current_user_id;
           
           
           
                $query="select p.user_id,p.pond_id as pond_i,c.cost_name,c.cost_amounts as cost_amount,p.pond_name as pond_n,setf.fish_quantitys as set_fish_quantity,setf.fish_weights as set_fish_weight,setf.fish_prices as set_fish_price,sellf.fish_quantityl as sell_fish_quantity,sellf.fish_weightl as sell_fish_weight,sellf.fish_pricel as sell_fish_price from pond as p left join (select pond_id,SUM(fish_quantity)as fish_quantitys,SUM(fish_weight) as fish_weights,SUM(fish_price) as fish_prices from fish_set group by pond_id) as setf on p.pond_id=setf.pond_id left join(select pond_id,SUM(fish_quantity) as fish_quantityl,SUM(fish_weight) as fish_weightl,SUM(fish_price) as fish_pricel from fish_sell group by pond_id) as sellf on p.pond_id=sellf.pond_id left join (select pond_id,cost_name,sum(cost_amount) as cost_amounts from cost group by pond_id)as c on p.pond_id=c.pond_id  where p.user_id=$user_id";
           
           
           $select_query=mysqli_query($connection, $query);
           if(!$select_query)
           {
               die("query failed".mysqli_error($connection));
           }
          $count_pond_detail=mysqli_num_rows($select_query);
           $t_cost=0;
           $t_los=0;
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
               $total_cost=$row['cost_amount'];
               
               $t_cost=$total_cost+$total_set_fish_price;
              
          

            echo"<tr>";
            echo"<td>$pond_name</td>";
            echo"<td>$total_set_fish_quantity</td>";
            echo"<td>$total_sell_fish_quantity</td>";
            echo"<td>$total_set_fish_weight</td>";
            echo"<td>$total_sell_fish_weight</td>";
            echo"<td>$total_set_fish_price</td>";  
            echo"<td>$total_sell_fish_price</td>";
//             echo"<td>$t_cost</td>";
               
               
            echo" <td><a href='pond_details.php?source=view_pond_details&pond_id={$pond_id}'>view details</a> </td>";
        
             echo"</tr>";    
                             
          /*  $insert_query="insert into pond_detail(pond_id,user_id,total_set_fish,total_sell_fish,total_set_fish_weight,total_sell_fish_weight,total_income,total_cost) values($pond_id,$user_id,$total_set_fish_quantity,$total_sell_fish_quantity,$total_set_fish_weight,$total_sell_fish_weight,$total_sell_fish_price,$total_set_fish_price)";
               $pond_details_query=mysqli_query($connection,$insert_query);
               
               if(!$pond_details_query)
               {
                   die("query failed".mysqli_error($connection));
               }*/
               
               
               
           }
         /*  
           $count=0;
           
           while($count_pond_detail>$count){
           if(isset($select_query)){
               $insert_query="insert into pond_detail(pond_id,user_id,total_set_fish,total_sell_fish,total_cost,total_income,total_sell_fish_weight,total_set_fish_weight) values($pond_id,$user_id,$total_set_fish_quantity,$total_sell_fish_quantity,$total_set_fish_price,$total_sell_fish_price,$total_sell_fish_weight,$total_set_fish_weight)";
               
               $insert_query_pond_detail=mysqli_query($connection,$insert_query);
               if(!$insert_query_pond_detail)
               {
                   die("failed query".mysqli_error($connection));
               }
              
               }
               
           $count++;
           }
           
           */
     } ?>
        
    
    
    </tbody>
    
    
    
</table>