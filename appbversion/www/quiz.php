<?php include "connection.php";?>
<?php

if (isset($_POST['quiz'])) {

	$sr = $_POST['sr'];
	$topic = $_POST['topic'];
	$grade = $_POST['grade'];
	$subject = $_POST['subject'];
	$flag = $_POST['flag'];
}

$topic = $_REQUEST['topic'];
$grade = $_REQUEST['grade'];
$subject = $_REQUEST['subject'];
$flag = $_REQUEST['flag'];
$sr = $_REQUEST['sr'];

if ($flag) {

	$sql = "Select question from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'";

	$result = $db->query($sql);
	$sql1 = "Select count(question) from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "'";

} else {

	$sql = "Select question from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And subtopic='" . $topic . "'";

	$result = $db->query($sql);
	$sql1 = "Select count(question)  from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And subtopic='" . $topic . "'";

}
$count = ($db->querySingle($sql1));
$questionNo = array();

//echo "$questionNo[$i]";
?>
<!DOCTYPE html>
<html>
<head>
	<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custome/index.css">
	<script type="text/javascript" src="libraries/bootstrap.js"></script>
	<script type="text/javascript" src="libraries/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>
	 <script defer src="libraries/fontawesome-all.js"></script>
	<style type="text/css">
.fixed{
	position: fixed;
	left: 0;
   bottom: 0;
   width: 100%;
   background-color: #33AD92;
   color: #FFF;
   text-align: center;
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

<?php echo "<a href='content.php?t=$topic&sr=$sr&g=$grade&s=$subject&f=$flag' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>
	<div class="container">
<div class="container">
<?php echo "<h2 style='text-align:left;color:#33AD92'>$grade $subject Chapter $sr </h2>"; ?>
	<hr style="background-color: #33AD92;height:1px">
	<?php echo "<h2 style='text-align:center;color:#33AD92'>$topic </h2>"; ?>

	<div class='' style="margin-top:40px;margin-bottom:40px;">

		<?php
if ($count > 0) {
	$i = 0;
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		$questionNo[$i] = $i + 1;
		$q = $row['question'];
		echo "<a  type='button' href='question.php?question=$q&grade=$grade&subject=$subject&topic=$topic&flag=$flag&sr=$sr' class='btn btn-lg btn-primary' >Q$questionNo[$i]. " . $row['question'] . "</a><br><br>";
		$i++;

	}
} else {
	echo "<h1 style='color:#33AD92;margin-left:60px'> No data found</h1>";
}
?>

	</form>
	</div>
</div>
<footer class="fixed">
	<p>elearn punjab</p>
</footer>
</body>
</html>