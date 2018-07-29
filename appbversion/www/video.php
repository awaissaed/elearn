<?php include "connection.php";?>
<?php
if (isset($_POST['video'])) {

	$sr = $_POST['sr'];
	$topic = $_POST['topic'];
	$grade = $_POST['grade'];
	$subject = $_POST['subject'];
	$flag = $_POST['flag'];
}

if (isset($_POST['watch_video'])) {

	$drivePath = explode(':', getcwd());
	$drive = $drivePath[0];
	$path = $_POST['path'];
	//$sg = $grade . $subject;

	$filename = "/eLearn/" . $path;

	if (!file_exists($filename)) {

		$ab = '"file://192.168.88.1/preloaded/eLearn/' . $path . '"';
		exec('' . $drive . ':/appbversion/www/content.bat ' . $ab);

	} else {

		$ab = '"' . $drive . ':/eLearn/' . $path . '"';
		exec('' . $drive . ':/appbversion/www/content.bat ' . $ab);

	}

}
$sr = $_POST['sr'];
$topic = $_POST['topic'];
$grade = $_POST['grade'];
$subject = $_POST['subject'];
$flag = $_POST['flag'];
?>

<!DOCTYPE html>
<html>

<head>

<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.css">
	  <script defer src="libraries/fontawesome-all.js"></script>
</head>
<body>
<nav class="navbar" style="background-color: #33AD92">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" style="color: #FFF;font-size: 30px" href="index.php">eLearn content</a>
	    </div>
	  </div>
</nav>
<?php echo "<a href='content.php?t=$topic&sr=$sr&g=$grade&s=$subject&f=$flag' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>

<div class="container">
<?php echo "<h2 style='text-align:left;color:#33AD92'>$grade $subject Chapter $sr </h2>"; ?>
	<hr style="background-color: #33AD92;height:1px">
	<?php echo "<h2 style='text-align:left;color:#33AD92'>$topic </h2>"; ?>
<?php
$sql = "Select * from videos_topics where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "' And chapter='" . $sr . "'";

$result = $db->query($sql);
$sql = "Select count(video) from videos_topics where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "' And chapter='" . $sr . "' And type='Live'";
$count = ($db->querySingle($sql));
echo "<div class='col-lg-4 col-lg-offset-4'>";
echo "<h2 style='color:#33AD92'>Live Lectures</h2>
<div>";
if ($count > 0) {
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		echo "<form method='post'>";
		if ($row['type'] == 'Live') {
			$name = $row['video'];
			$ch = $row['chapter'];
			$sbj = $row['book'];
			$g = $row['class'];
			$path = "$sbj/$g$sbj/chapter$ch/videos/$name.mp4";

			echo "<input type='hidden' value='" . $path . "' name='path'>";
			echo "<input type='hidden' value='" . $sr . "' name='sr'>";
			echo "<input type='hidden' value='" . $topic . "' name='topic'>";
			echo "<input type='hidden' value='" . $grade . "' name='grade'>";
			echo "<input type='hidden' value='" . $subject . "' name='subject'>";
			echo "<input type='hidden' value='" . $flag . "' name='flag'>";
			echo "<button class='btn btn-lg btn-primary' name='watch_video' type='submit' style='margin-left:50px'>" . $row['video'] . "</button><br><br>";

		}
		echo "</form>";
	}
} else {
	echo "<h2 class='btn-primary' style='margin-left:50px;text-align:center'>No Video found</h2>";
}
echo "</div>";
echo "<h2 style='color:#33AD92'>Animated Videos</h2>
<div>";
$sql = "Select * from videos_topics where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'And chapter='" . $sr . "'";
$result = $db->query($sql);
$sql = "Select count(video) from videos_topics where book='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'And chapter='" . $sr . "' And type='Animated'";
$count1 = ($db->querySingle($sql));
if ($count1 > 0) {
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		echo "<form method='post'>";
		if ($row['type'] == 'Animated') {
			$name = $row['video'];
			$ch = $row['chapter'];
			$sbj = $row['book'];
			$g = $row['class'];
			$path = "$sbj/$g$sbj/chapter$ch/videos/$name.mp4";

			echo "<input type='hidden' value='" . $path . "' name='path'>";
			echo "<input type='hidden' value='" . $sr . "' name='sr'>";
			echo "<input type='hidden' value='" . $topic . "' name='topic'>";
			echo "<input type='hidden' value='" . $grade . "' name='grade'>";
			echo "<input type='hidden' value='" . $subject . "' name='subject'>";
			echo "<input type='hidden' value='" . $flag . "' name='flag'>";
			echo "<button class='btn btn-lg btn-primary' name='watch_video' type='submit' style='margin-left:50px'>" . $row['video'] . "</button><br><br>";

		}
		echo "</form>";
	}
} else {
	echo "<h2 class='btn-primary' style='margin-left:50px;text-align:center'>No Video found</h2>";
}
echo "</div>
</div>";
?>
</body>
</html>