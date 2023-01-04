

<div class="container">
    <div class="row"  style="margin: 50px 0px 0px 0px">
        <h2 class="page-header">List of Orders</h2>
    </div>
    <table class="table table-bordered table-hover">
                            <thead>
                                <tr> 
                                    <th>Order No.</th> 
                                    <th>Table No.</th>
                                    <th>Cater</th>
                                    <th>Status</th>
                                    <th>Add New Meal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                   $remarks = isset($_GET['rem']) ? $_GET['rem'] : "" ;
                                    $query = "SELECT * FROM `tblorders` o , `tblusers` u
                                         WHERE  o.`USERID` = u.`USERID` AND STATUS='Pending' AND u.`FULLNAME`='".$_SESSION['WAITER_FULLNAME']."'  GROUP BY ORDERNO ORDER BY ORDERID ASC ";
                                    $mydb->setQuery($query);
                                    $cur = $mydb->loadResultList();

                                    foreach ($cur as $result) { 
                                    echo '<tr>'; 
                                    echo '<td><a href="index.php?view=menu&orderno='.$result->ORDERNO.'&tableno='.$result->TABLENO.'&rem='.$result->REMARKS.'" >'.$result->ORDERNO.'</a></td>'; 
                                    echo '<td align="center">'.$result->TABLENO.'</td>';
                                    echo '<td>'.$result->FULLNAME.'</td>';
                                    echo '<td>'.$result->REMARKS.'</td>';
                                   echo   '<td><a href="addmeal.php?view=addmeal&orderno='.$result->ORDERNO.'&tableno='.$result->TABLENO.'&rem='.$result->REMARKS.'" data-toggle="lightbox" class="btn btn-xs btn-primary " data-title="<b>Add Meal</b>">Add Meal</a></td>'; 
                                    echo '</tr>';
                                 
                                    } 
                                ?> 
                            </tbody>
                        </table>
</div>

