<?php
require_once('../connection.php');
	if (isset($_POST["week"])) {
		$nextWeek = date("W")+1;
	    $nextWeek = (int)$nextWeek;
	    // $sqlUsersConst = 'SELECT c.id,c.week_id,c.day_id,c.user_id,c.shift_id,c.status,c.published, u.id ,u.f_name,u.l_name FROM const as c LEFT JOIN users as u on u.id = c.user_id WHERE c.week_id='.$nextWeek.' AND c.published = 2';
	        // $sqlUsersConstRes = mysqli_query($dbCon,$sqlUsersConst);
	    $sqlUpdatePublishedAlgo = 'UPDATE const SET published = 1 WHERE week_id='.$_POST["week"].' AND status =1';
	    $sqlUpdatePublishedAlgoRes = mysqli_query($dbCon,$sqlUpdatePublishedAlgo);
	    if($sqlUpdatePublishedAlgoRes){
	    	echo 'Shifts are published with great success !';
	    }
	    else{
	    	echo "Opps!";
	    }
    }
?>