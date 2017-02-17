<?php
    session_start();

    if(isset($_SESSION['id'])) {
        $username = $_SESSION['email'];
        $userId = $_SESSION['id'];
        $dbUserFname = $_SESSION['fname'];
        $role = $_SESSION['role'];
        include("connection.php"); //connection.php
    } else {
        header('Location: index.php');
        die();
    }

?>
<?php include("header.php"); ?>
<body class="dashboard">
<?php include("headerInner.php"); ?>
<?php include "nav.php"; ?>
    <main>
        <h1>Dashboard</h1>
        <script type="text/javascript"><?php echo "var userID = $userId;";?></script>  
        <div class="table-responsive">
        <div class="panel panel-default weekly">
            <div class="panel-heading">Weekly Schedule
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li class="dropdown-header">Export as:</li>
                        <li><a href="#">PDF</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" contenteditable="false">
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
                                $nextWeek = date("W")+1;
                                $nextWeek = (int)$nextWeek;
                                $preWeek  = (int)(date("W")-1);
                                // var_dump($preWeek);die;
                                $sqlShifts = "SELECT * FROM shifts";
                                $sqlConst = 'SELECT c.id,c.week_id,c.day_id,c.user_id,c.shift_id,c.status,c.published, u.id ,u.f_name,u.l_name FROM const as c LEFT JOIN users as u on u.id = c.user_id WHERE c.week_id='.$nextWeek.' AND c.published = 1 group by c.shift_id asc ,c.day_id ASC';
                                $sqlResConst = mysqli_query($dbCon, $sqlConst);
                                // var_dump($sqlResConst->num_rows);die;
                                if($sqlResConst->num_rows < 1){
                                    // $sqlConst = 'SELECT c.id,c.week_id,c.day_id,c.user_id,c.shift_id,c.status,c.published, u.id ,u.f_name,u.l_name FROM const as c LEFT JOIN users as u on u.id = c.user_id WHERE c.week_id='.$preWeek.' AND c.published = 1';
                                    // $sqlResConst = mysqli_query($dbCon, $sqlConst);
                                    // if (!$sqlResConst->num_rows < 1) {
                                        echo "No Shift published yet!";
                                        // return;
                                    // }
                                }else{
                                    $query = mysqli_query($dbCon, $sqlShifts); 
                                $matrix = [];
                                $shiftsarr = [];
                                while ($row = $query->fetch_assoc()) {
                                    $shiftsarr[$row["id"]] = $row["title"];
                                }
                                    while ($sqlResConstRow = $sqlResConst->fetch_assoc()) {
                                        // print_r($sqlResConstRow);die;
                                        $matrix[$sqlResConstRow["shift_id"]][$sqlResConstRow["day_id"]] = $sqlResConstRow["f_name"].' '.$sqlResConstRow["l_name"];

                                    }
                                    ksort($matrix);
                                    // print_r($matrix);die;
                                     foreach ($matrix as $number_line => $line_data) {
                                        // ksort($number_line);
                                        echo '<tr>';
                                        echo '<td><b>'.$shiftsarr[$number_line].'</b></td>';

                                        foreach ($line_data as $col => $status) {
                                            // var_dump($status);die;
                                            echo  '<td>'.$status.'</td>';
                                            
                                                
                                        }
                                        echo '</tr>';
                                     }
                                }
                                
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <?php if($role == "mgr"){?>

            <div class="panel panel-default manager">
            <div class="panel-heading">Manager Actions</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><p id="trigger">Trigger Ultimate Scheduler algorithm</p>
                            <?php
                                $nextWeek = date("W")+1;
                                $nextWeek = (int)$nextWeek;
                                $sqlUsersConst = 'SELECT c.id,c.week_id,c.day_id,c.user_id,c.shift_id,c.status,c.published, u.id ,u.f_name,u.l_name FROM const as c LEFT JOIN users as u on u.id = c.user_id WHERE c.week_id='.$nextWeek.' AND c.published = 3';
                                    $sqlUsersConstRes = mysqli_query($dbCon,$sqlUsersConst);
                                    if ($sqlUsersConstRes->num_rows == 147) {
                                        echo '<button id="automaticAlgo" data-week='.$nextWeek.' type="button" class="btn btn-md start">Start</button>';
                                    }
                                    else{
                                        echo '<button id="automaticAlgo" data-week='.$nextWeek.' type="button" class="btn btn-md  disabled">Start</button>';
                                    }
                                    // var_dump($sqlUsersConstRes);die;
                                while ($sqlUsersConstRows = $sqlUsersConstRes->fetch_assoc()) {

                                }

                             ?>
                                
                                <div class="progress">
                                    <div id="myBar" class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><div id="currentProgress">1%</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="change"><p>Perform changes manually</p><button type="button" class="btn btn-md change">Change</button></td>
                        </tr>
                        <tr>
                            <td id="publish"><p>Publish shifts</p><button type="button" class="btn btn-md publish">Publish</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


          <?php  } ?>
        
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <p>Ultimate Scheduler generated next week shifts</p>
        </div>
    </main>

<?php include("footer.php"); ?>
