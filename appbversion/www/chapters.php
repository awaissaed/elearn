<!DOCTYPE html>
<?php include "connection.php";?>
<html>
<head>
	<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.css">
 <script defer src="libraries/fontawesome-all.js"></script>
	<style type="text/css">

	</style>
</head>
<?php

$g = $_REQUEST['g'];
$s = $_REQUEST['s'];

$sql = "Select * from books where book='" . $s . "' And class='" . $g . "'";
$result = $db->query($sql);

?>
<?php
$imageArray = array();
if ($g == 8 && $s == 'Math') {
	$dir = "images/math/8th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}

if ($g == 6 && $s == 'Math') {
	$dir = "images/math/6th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 7 && $s == 'Math') {
	$dir = "images/math/7th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 9 && $s == 'Math') {
	$dir = "images/math/9th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 10 && $s == 'Math') {
	$dir = "images/math/10th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 8 && $s == 'Science') {

	$dir = "images/science/8th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 6 && $s == 'Science') {

	$dir = "images/science/6th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 11 && $s == 'Physics') {
	$dir = "images/physics/11th/*.jpg"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 9 && $s == 'Chemistry') {
	$dir = "images/Chemistry/9th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 10 && $s == 'Chemistry') {
	$dir = "images/Chemistry/9th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 10 && $s == 'Physics') {
	$dir = "images/Physics/10th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 9 && $s == 'Physics') {
	$dir = "images/Physics/9th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 10 && $s == 'Biology') {
	$dir = "images/Biology/10th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
	}
}
if ($g == 9 && $s == 'Biology') {
	$dir = "images/Biology/10th/*.png"; //get the list of all files with .png
	$images = glob($dir);

	for ($i = 0; $i < count($images); $i++) {
		$imageArray[$i] = $images[$i];
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
<?php echo "<a href='grade.php?g=$g' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
	<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>
	<div class="container">

		<?php echo "<h2>$s Grade $g </h2>"; ?>
		<hr style="background-color: #33AD92;height:1px">
	<div class="gallery">

<?php

$i = 0;
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
	echo "<div class='col-lg-4 thumbnail' >";
	$c = $row['chapters'];
	$part = explode(".", $c);
	$sr = $part[0];
	echo "<a href='topic.php?g=$g&s=$s&sr=$sr'>
	<figure>
		<img  class= 'img-responsive' src='" . $imageArray[$i] . "'>
		<figcaption>" . $row['chapters'] . "</figcaption>";
	echo "
		</figure></a>
	</div>";

	$i++;

}
?>


		</div>
	</div>

</body>
</html>