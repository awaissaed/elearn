<!DOCTYPE html>
<html>
<?php include "connection.php";?>
<head>
	<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="libraries/bootstrap.min.css">
  	<script src="libraries/jquery-3.3.1.min.js"></script>
	<script src="libraries/bootstrap.min.js"></script>
  <script src="libraries/fontawesome-all.js"></script>
</head>
<?php
$sr = $_REQUEST['sr'];
$topic = $_REQUEST['t'];
$grade = $_REQUEST['g'];
$subject = $_REQUEST['s'];
$flag = $_REQUEST['f'];
?>
<?php
if(isset($_POST['sync'])){

	$sql = "Select * from contant_usage where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'And chapter='" . $sr . "'";
	$result=$db1->query($sql);
	$rows = array();
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		 $rows[] = $row;

	}
echo json_encode($rows);


}
?>
<?php

if (isset($_POST['contant'])) {
	if ($flag) {
		$sql = "Select content_address from chapter_topics where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'And chapter='" . $sr . "'";
		$result = ($db->querySingle($sql));
		//echo "$result";

	} else {

		$sql = "Select address from topic_sub_topics where book='" . $subject . "' And class='" . $grade . "' And sub_topics='" . $topic . "'And chapter='" . $sr . "'";
		$result = ($db->querySingle($sql));

	}
	$sg = $grade . $subject;
	$filename = "/eLearn/" . $subject . "/" . $sg . "/chapter" . $sr . "/content/mobile/index.html";

	$drivePath = explode(':', getcwd());
	$drive = $drivePath[0];

	if (!file_exists($filename)) {

		$r = '"file://192.168.88.1/preloaded/eLearn/' . $result . '"';
		exec('' . $drive . ':/appbversion/www/exp.bat ' . $r);

	} else {
		$insert="insert into contant_usage(mac_address,date_time,class,book,chapter,topic,content,simulation)Values('abc','12/4','$grade','$subject','$sr','$topic','yes','no')";
		$r = $db1->query($insert);

		$r = '"file:///' . $drive . ':/eLearn/' . $result . '"';
		exec('' . $drive . ':/appbversion/www/exp.bat ' . $r);
	}

}

?>
<body>
<nav class="navbar" style="background-color: #33AD92">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" style="color: #FFF;font-size: 30px" href="index.php">eLearn content</a>
	    </div>
	  </div>
	</nav>

<?php echo "<a href='topic.php?sr=$sr&g=$grade&s=$subject' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>
<form method="post">
	<button type="submit" class="btn btn-sm btn-primary" name="sync">sync</button>
</form>
<div class="container">
<?php echo "<h2 style='text-align:center'>$topic</h2>"; ?>
	<hr style="background-color: #33AD92;height:1px">
	<div class="col-lg-4 col-lg-offset-4"><br>
		<form method="post" class="col-lg-4">
			<button type="submit" name="contant" style="padding: 0; border: none;"><img src="images/content.png" /></button>
			<?php

			?>
		</form>

		<form action="video.php" method="post"  class="col-lg-4" style="margin-left: 110px" >
			<input type="hidden" name="sr" value="<?php echo $sr; ?>">
			<input type="hidden" name="grade" value="<?php echo $grade; ?>">
			<input type="hidden" name="subject" value="<?php echo $subject; ?>">
			<input type="hidden" name="topic" value="<?php echo $topic; ?>">
			<input type="hidden" name="flag" value="<?php echo $flag; ?>">
			<button type="submit" name="video" style="padding: 0; border: none;"><img src="images/videos.png" /></button>
		</form>
		<form action="simulations.php" method='post' class="col-lg-4" style="margin-top: 40px">
			<input type="hidden" name="sr" value="<?php echo $sr; ?>">
			<input type="hidden" name="grade" value="<?php echo $grade; ?>">
			<input type="hidden" name="subject" value="<?php echo $subject; ?>">
			<input type="hidden" name="topic" value="<?php echo $topic; ?>">
			<input type="hidden" name="flag" value="<?php echo $flag; ?>">
			<button type="submit" name="simulations" style="padding: 0; border: none;"><img src="images/simulations.png" /></button>
		</form>
		<form action="quiz.php" method="post" class="col-lg-4" style="margin-top: 40px">
			<input type="hidden" name="sr" value="<?php echo $sr; ?>">
			<input type="hidden" name="grade" value="<?php echo $grade; ?>">
			<input type="hidden" name="subject" value="<?php echo $subject; ?>">
			<input type="hidden" name="topic" value="<?php echo $topic; ?>">
			<input type="hidden" name="flag" value="<?php echo $flag; ?>">
			<button type="submit" name="quiz" style="padding: 0; border: none;margin-left: 110px"><img src="images/quiz.png" /></button>
		</form>

	</div>
</body>
</html>
