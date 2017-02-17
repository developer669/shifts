<?php
    session_start();

    if(isset($_SESSION['id'])) {
        $username = $_SESSION['email'];
        $userId = $_SESSION['id'];
        //var_dump($userId);die;
        $dbUserFname = $_SESSION['fname'];
        $role = $_SESSION['role'];
        $dbUserLname = $_SESSION['lname'];
        include("connection.php"); //connection.php
    } else {
        header('Location: index.php');
        die();
    }

?>

<?php include("header.php"); ?>
<script src="includes/main.js"></script>
<body class="constrains">
<?php include("headerInner.php"); ?>
<?php include ("nav.php"); ?>
    <main>
        <h1>Constrains</h1>
        
        <script type="text/javascript"><?php echo "var userID = $userId;";?></script>     
        <?php if($role === "mgr"){

            $nextWeek = date("W")+1;
            $nextWeek = (int)$nextWeek;
            $sqlUsersConst = 'SELECT c.id,c.week_id,c.day_id,c.user_id,c.shift_id,c.status,c.published, u.id ,u.f_name,u.l_name FROM const as c LEFT JOIN users as u on u.id = c.user_id WHERE c.week_id='.$nextWeek.' AND c.published = 2 OR c.published = 3 GROUP BY c.user_id';
                $sqlUsersConstRes = mysqli_query($dbCon,$sqlUsersConst);
            while ($sqlUsersConstRows = $sqlUsersConstRes->fetch_assoc()) {
                // print_r($sqlUsersConstRows);die;
            ?>
            
            <div class="panel panel-default weekly">
                <div class="panel-heading">
                    <?php echo $sqlUsersConstRows['f_name']." ".$sqlUsersConstRows['l_name']; ?>
                    <?php if ($sqlUsersConstRows['published'] == "3") {
                            echo '<span class="glyphicon glyphicon-ok-sign"></span>';
                            // echo '<button type="button" class="btn btn-md decline">Decline</button>';
                    }?>
                    <?php if ($sqlUsersConstRows['published'] !== "3") {
                        echo '<span class="glyphicon glyphicon-question-sign"></span>';
                        echo '<div class="dropdown">';
                        echo '<button id="sendFinalShifts'.$userId.'" data-week="'.$sqlUsersConstRows['week_id'].'" data-user="'.$sqlUsersConstRows['user_id'].'" type="button" class="btn btn-md approve">Approve</button>';
                        echo '</div>';
                        echo '<button data-week="'.$sqlUsersConstRows['week_id'].'" data-user="'.$sqlUsersConstRows['user_id'].'" type="button" class="btn btn-md decline">Decline</button>';
                    }?>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php 
                                
                                $sqlShifts = "SELECT * FROM shifts";
                                $sqlConst = "SELECT * FROM const where week_id=".$sqlUsersConstRows['week_id']." AND published=2 OR published = 3 AND user_id=".$sqlUsersConstRows['user_id'];
                                $sqlResConst = mysqli_query($dbCon, $sqlConst);
                                $query = mysqli_query($dbCon, $sqlShifts); 
                                $matrix = [];
                                $shiftsarr = [];
                                while ($row = $query->fetch_assoc()) {
                                    $shiftsarr[$row["id"]] = $row["title"];
                                }
                                    while ($sqlResConstRow = $sqlResConst->fetch_assoc()) {
                                        $matrix[$sqlResConstRow["shift_id"]][$sqlResConstRow["day_id"]] = $sqlResConstRow["status"];
                                    }

                                     foreach ($matrix as $number_line => $line_data) {
                                        echo '<tr>';
                                        echo '<td><b>'.$shiftsarr[$number_line].'</b></td>';
                                        foreach ($line_data as $col => $status) {
                                                if ($status == 1) {
                                                    $ok = "ok";
                                                    echo  '<td><span id="status" data-user="'.$sqlUsersConstRows['user_id'].'"  data-week="'.$sqlUsersConstRows['week_id'].'" data-day="'.$col.'" data-shift="'.$number_line.'" data-status="'.$sqlUsersConstRows['status'].'" class="glyphicon glyphicon-'.$ok.'-circle"></span></td>';
                                                }
                                                else{
                                                    echo  '<td><span id="status" data-user="'.$sqlUsersConstRows['user_id'].'"  data-week="'.$sqlUsersConstRows['week_id'].'" data-day="'.$col.'" data-shift="'.$number_line.'"  data-status="'.$sqlUsersConstRows['status'].'" class="glyphicon glyphicon-ban-circle"></span></td>';
                                                }
                                        }
                                        echo '</tr>';
                                     }
                             ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php }?> 
            
        <?php }else{
            $nextWeek = date("W")+1;
            $nextWeek = (int)$nextWeek;
            ?>
            
            <div class="panel panel-default weekly">
                <div class="panel-heading"><?php echo $dbUserFname." ".$dbUserLname; ?><span class="glyphicon glyphicon-ok-sign"></span>
                    <span class="glyphicon glyphicon-pencil" aria-disabled="true"></span>
                    <div class="dropdown">
                        <?php

                        $sqlConstIfNoConst = "SELECT count(*) as amount FROM const where week_id=".$nextWeek." AND published=2 AND user_id=".$userId;
                        $sqlConstIfNoConstRes = mysqli_query($dbCon, $sqlConstIfNoConst);
                        $amountPublished = $sqlConstIfNoConstRes->fetch_assoc();
                        $amountPublished = (int)$amountPublished['amount'];
                        if ($amountPublished == 21) {
                            echo '<button id="sendRequest" data-week="'.$nextWeek.'" data-user="'.$userId.'" type="button" class="btn btn-md disabled">Send</button>';
                            
                        }
                        else{
                            echo '<button id="sendRequest" data-week="'.$nextWeek.'" data-user="'.$userId.'" type="button" class="btn btn-md">Send</button>';
                            // echo '<button type="button" data-week="'.$nextWeek.'" data-user="'.$userId.'" class="btn btn-md decline returnToEmp">Decline</button>';
                        }

                         ?>
                        
                        <!-- <button type="button" class="btn btn-md decline">Decline</button> -->
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php 
                                
                                $sqlShifts = "SELECT * FROM shifts";
                                $sqlConst = "SELECT * FROM const where week_id=".$nextWeek." AND published=0 AND user_id=".$userId;
                                $sqlResConst = mysqli_query($dbCon, $sqlConst);
                                $query = mysqli_query($dbCon, $sqlShifts); 
                                $matrix = [];
                                $shiftsarr = [];
                                while ($row = $query->fetch_assoc()) {
                                    $shiftsarr[$row["id"]] = $row["title"];
                                }
                                    while ($sqlResConstRow = $sqlResConst->fetch_assoc()) {
                                        $matrix[$sqlResConstRow["shift_id"]][$sqlResConstRow["day_id"]] = $sqlResConstRow["status"];

                                    }

                                     foreach ($matrix as $number_line => $line_data) {
                                        echo '<tr>';
                                        echo '<td><b>'.$shiftsarr[$number_line].'</b></td>';
                                        foreach ($line_data as $col => $status) {
                                                if ($status == 1) {
                                                    $ok = "ok";
                                                    echo  '<td><span id="status" data-user="'.$userId.'"  data-week="'.$nextWeek.'" data-day="'.$col.'" data-shift="'.$number_line.'" data-status="'.$status.'" class="glyphicon glyphicon-'.$ok.'-circle"></span></td>';
                                                }
                                                else{
                                                    echo  '<td><span id="status" data-user="'.$userId.'"  data-week="'.$nextWeek.'" data-day="'.$col.'" data-shift="'.$number_line.'"  data-status="'.$status.'" class="glyphicon glyphicon-ban-circle"></span></td>';
                                                }
                                        }
                                        echo '</tr>';
                                     }
                             ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
     
        
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Thank You!</strong>  Your shifts request have sent to manager!
        </div>
    </main>
<?php include ("footer.php");?>