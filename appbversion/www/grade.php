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
	 <script defer src="libraries/fontawesome-all.js"></script>
	<style type="text/css">

	</style>
</head>
<?php
$g = $_REQUEST["g"];

if ($g != 1 && $g != 2 && $g != 3 && $g != 4 && $g != 5 && $g != 6 && $g != 7 && $g != 8 && $g != 9 && $g != 10 && $g != 11) {
	header('location:index.php');
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
<?php echo "<a href='index.php' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
	<div class="container">
		<img src="images/image1.png" style="height:200px" class="img-responsive center-block">
		<?php echo "<h2>Grade $g Books</h2>"; ?>
		<hr style="background-color: #33AD92;height:1px">
	</div>



	<?php
if ($g == 6 || $g == 7 || $g == 8) {
	echo "<div class='container'>
				<div class='col-lg-6 col-lg-offset-3' style='margin-bottom: 100px'>
					<a href='chapters.php?g=$g&s=Math'><img src='images/math.png'></a>
					<a href='chapters.php?g=$g&s=Science'><img style='margin-left: 70px' src='images/science.png'></a>
				</div>
			</div>";
}
?>
	<?php
if ($g == 9 || $g == 10 || $g == 11) {
	echo "<div class='container'>
				<div class='col-lg-6 col-lg-offset-3' style='margin-bottom: 100px'>
					<a href='chapters.php?g=$g&s=Math'><img src='images/math.png'></a>
					<a href='chapters.php?g=$g&s=Chemistry'><img style='margin-left: 70px' src='images/chem.png'></a><br><br>
					<a href='chapters.php?g=$g&s=Physics'><img src='images/physics.png'></a>
					<a href='chapters.php?g=$g&s=Biology'><img style='margin-left: 70px' src='images/bio.png'></a>
				</div>
			</div>";
}
?>
</body>
</html>