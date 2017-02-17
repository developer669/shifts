<?php 
	require_once('../connection.php');
	if (isset($_POST["user"])&&isset($_POST["week"])&&isset($_POST["day"])&&isset($_POST["shift"])&&isset($_POST["status"])) {
		$updateSlotSql = 'UPDATE const SET status='.strip_tags($_POST["status"]).' WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]).' AND day_id='.strip_tags($_POST["day"]).' AND shift_id='.strip_tags($_POST["shift"]);
		$updateSlotRes = mysqli_query($dbCon, $updateSlotSql);

		if ($updateSlotRes) {
			echo "The slot has been updated!";
		}else{
			echo "Can't update";
		}
	}
	elseif (isset($_POST["user"])&&isset($_POST["week"])) {
		$updateStatusApplySql = 'UPDATE const SET published=2 WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]);
		$updateStatusApplyRes = mysqli_query($dbCon, $updateStatusApplySql);
		// if (mysqli_affected_rows($dbCon) === 0) {
		// 	echo json_encode(false);
		// }
		 if ($updateStatusApplyRes) {
			echo json_encode(array("msg"=>"applied the shifts waitting for manager!","code"=>1));
		}else{
			echo "Can't update";
		}
	}

	

?>