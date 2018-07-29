<!DOCTYPE html>
<?php include "connection.php";?>
<html>
<?php
$sr = $_REQUEST['sr'];
$grade = $_REQUEST['g'];
$subject = $_REQUEST['s'];

?>
<head>
	<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="libraries/bootstrap.min.css">
  <script src="libraries/jquery-3.3.1.min.js"></script>
<script src="libraries/bootstrap.min.js"></script>

  <script defer src="libraries/fontawesome-all.js"></script>
  <style type="text/css">
  	.dropdown-menu {
  top: 0;
  left: 100%;

}

  </style>
</head>

<body>
	<nav class="navbar" style="background-color: #33AD92">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" style="color: #FFF;font-size: 30px" href="index.php">eLearn content</a>
	    </div>
	  </div>
	</nav>
<?php echo "<a href='chapters.php?g=$grade&s=$subject' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>

<div class="container">
<?php echo "<h2> $grade $subject -$sr Topics </h2>"; ?>
	<hr style="background-color: #33AD92;height:1px">
	<div class="col-lg-4 col-lg-offset-4"><br>
		<?php
$sql = "Select * from chapter_topics where book='" . $subject . "' And class='" . $grade . "' And chapter='" . $sr . "'";
$result = $db->query($sql);
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
	$topic = $row['topic'];

	$sql1 = "Select distinct sub_topics from topic_sub_topics where book='" . $subject . "' And class='" . $grade . "' And chapter='" . $sr . "' And topic='" . $topic . "'";
	$string = ($db->querySingle($sql1));
	if ($string != '') {
		//drop down with main topic and subtopics
		$flag = true;
		echo "<ul class='nav nav-stacked'>
			<li>";
		echo "<div class='btn-group'>";
		echo "<a class='btn btn-lg btn-primary dropdown-toggle' data-toggle='dropdown' href='#'>" . $row['topic'] . "<i class='fas fa-caret-right' style='margin-left:7px;'></i></a>";
		echo "<ul class='dropdown-menu'>";
		//$main = explode(" ", $topic);

		echo "<li><a href='content.php?g=$grade&s=$subject&t=$topic&f=$flag&sr=$sr'>" . $topic . "</a></li>";

		$sql2 = "Select distinct topic,sub_topics from topic_sub_topics where book='" . $subject . "' And class='" . $grade . "' And chapter='" . $sr . "' And topic='" . $topic . "'";
		$result1 = $db->query($sql2);

		while ($row1 = $result1->fetchArray()) {
			$flag = false;
			$stopic = $row1['sub_topics'];
			
			echo "<li><a href='content.php?g=$grade&s=$subject&t=$stopic&f=$flag&sr=$sr'>" . $row1['sub_topics'] . "</a></li>";

		}

		echo "</ul>";
		echo "</div>
			</li>
			</ul><br>";

	} else {
		//only main topic
		$flag = true;
		echo "<a href='content.php?g=$grade&s=$subject&t=$topic&f=$flag&sr=$sr'><button  id='subtopic' class='btn btn-lg btn-primary' style='margin-bottom:20px;text-align:left'>" . $row['topic'] . "</button></a><br>";

	}

}

//}

?>
	</div>
</div>

</body>
</html>