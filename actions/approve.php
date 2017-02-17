<?php
require_once('../connection.php');
if (isset($_POST["user"])&&isset($_POST["week"])) {
		$updateStatusApplySql = 'UPDATE const SET published=3 WHERE user_id='.strip_tags($_POST["user"]).' AND week_id='.strip_tags($_POST["week"]);
		$updateStatusApplyRes = mysqli_query($dbCon, $updateStatusApplySql);
		 if ($updateStatusApplyRes) {
		 	$updateMsgSql = 'INSERT INTO `messages` (`id`, `send_to`, `msg`, `view`) VALUES (NULL, '.strip_tags($_POST["user"]).',"shifts approved by your manager!", 0)';
			$updateMsgRes = mysqli_query($dbCon, $updateMsgSql);
			if ($updateMsgRes) {
				echo "shifts approved!";
			}
			
		}else{
			echo "Can't update";
		}
	}
?>