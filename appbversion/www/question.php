<?php include "connection.php";?>
<?php
$msg = "";
$q = $_REQUEST['question'];
$topic = $_REQUEST['topic'];
$grade = $_REQUEST['grade'];
$subject = $_REQUEST['subject'];
$flag = $_REQUEST['flag'];
$sr = $_REQUEST['sr'];
if ($flag) {
	$sql = "Select A,B,C,D,right from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And topic='" . $topic . "' And question='" . $q . "'";

	$result = $db->query($sql);
} else {
	$sql = "Select A,B,C,D,right from quiz_topics where book ='" . $subject . "' And class='" . $grade . "' And subtopic='" . $topic . "' And question='" . $q . "'";

	$result = $db->query($sql);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>eLearn</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="libraries/bootstrap.min.css">
  	<script src="libraries/jquery-3.3.1.min.js"></script>
	<script src="libraries/bootstrap.min.js"></script>
	<script defer src="libraries/fontawesome-all.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>
	<style type="text/css">

	</style>
<script>
	function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function check_ans() {

	var  ts=document.getElementById('ts');
	var A=document.getElementById('A');
	var B=document.getElementById('B');
	var C=document.getElementById('C');
	var D=document.getElementById('D');
	var right=document.getElementById('right');
	var flag=true;

	if(ts && ts.value==0){
		alert("Select total Students");
		ts.focus();
		flag = false;
	}
	else if(A && A.value==[null])
	{
		alert("Select option A");
		A.focus();
		flag = false;

	}
	else if(B && B.value==[null])
	{
		alert("Select option B");
		B.focus();
		flag = false;
	}
	else if( C && C.value==[null])
	{
		alert("Select option C");
		C.focus();
		flag = false;
	}
	else if(D && D.value==[null])
	{
		alert("Select option D");
		D.focus();
		flag = false;
	}

	return flag;
}

</script>
</head>

<body>
	<nav class="navbar" style="background-color: #33AD92">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" style="color: #FFF;font-size: 30px" href="index.php">eLearn content</a>
	    </div>
	  </div>
</nav>

<?php echo "<a href='quiz.php?topic=$topic&sr=$sr&grade=$grade&subject=$subject&flag=$flag' title='click to go back'><i class='fa fa-arrow-left' style='font-size:48px;color:#33AD92;margin-left: 80px'></i></a>"; ?>
<a href='index.php' title='click to go home'><i class='fa fa-home' style='font-size:48px;color:#33AD92;margin-right:130px;float: right'></i></a>

<div class="container">
	<div class="jumbotron text-center" style="margin-top: 50px">
<?php
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
	$right = $row['right'];
	$A = $row['A'];
	$B = $row['B'];
	$C = $row['C'];
	$D = $row['D'];

	echo "<h2> Quiz:&nbsp;  " . $q . "</h2>";
	echo "<div class='row' style='margin-top:70px'>";
	echo "<div class='col-md-6'>";
	echo "<h3>A. " . $row['A'] . "</h3>";
	echo "</div>";
	echo "<div class='col-md-6'>";
	echo "<h3>B. " . $row['B'] . "</h3>";
	echo "</div>";
	echo "</div>";
	echo "<div class='row' style='margin-top:10px'>";
	echo "<div class='col-md-6'>";
	echo "<h3>C. " . $row['C'] . "</h3>";
	echo "</div>";
	echo "<div class='col-md-6'>";
	echo "<h3>D. " . $row['D'] . "</h3>";
	echo "</div>";
	echo "</div>";
}
?>
<?php
if (isset($_REQUEST['check'])) {

	$ts = $_REQUEST['ts'];
	$an = $_REQUEST['an'];
	$bn = $_REQUEST['bn'];
	$cn = $_REQUEST['cn'];
	$dn = $_REQUEST['dn'];

	$a = $_REQUEST['A'];
	$b = $_REQUEST['B'];
	$c = $_REQUEST['C'];
	$d = $_REQUEST['D'];
	$right = $_REQUEST['right'];

	$array1 = array();
	$array1[0] = $a;
	$array1[1] = $b;
	$array1[2] = $c;
	$array1[3] = $d;

	$i = 0;
	$array2[0] = 'A';
	$array2[1] = 'B';
	$array2[2] = 'C';
	$array2[3] = 'D';
	while ($i <= 3) {
		if ($array1[$i] == $right) {
			$r = $array2[$i];
			break;
		} else {
			$r = 0;
		}
		$i++;
	}
	$check = $an + $bn + $cn + $dn;
	if ($check != $ts) {
		$msg = 'Please enter values again ';
	} else {

		$msg = 'The correct answer is option ' . $r;
	}
}
?>
<br>
<hr style="background-color: #33AD92;height:2px">
<form method="post">
<input type="hidden" name="right"  value="<?php echo $right; ?>">
<input type="hidden" name="A"  value="<?php echo $A; ?>">
<input type="hidden" name="B"  value="<?php echo $B; ?>">
<input type="hidden" name="C"  value="<?php echo $C; ?>">
<input type="hidden" name="D" value="<?php echo $D; ?>">
<label style="float:left">Total Students &nbsp;</label>
<input style="float:left"  name='ts' type="text" onkeypress='validate(event)'  maxlength="3" size="4" id="ts">
<label style="float:left"> &nbsp;&nbsp;&nbsp;&nbsp; A &nbsp;</label>
<input  style="float:left" name='an' type="text" onkeypress='validate(event)'  maxlength="3" size="4" id="A">
<label style="float:left">&nbsp;&nbsp;&nbsp;&nbsp; B &nbsp;</label>
<input style="float:left" name='bn' type="text" onkeypress='validate(event)'  maxlength="3" size="4" id="B">
<label style="float:left"> &nbsp;&nbsp;&nbsp;&nbsp; C &nbsp;</label>
<input style="float:left" name='cn' type="text" onkeypress='validate(event)'  maxlength="3" size="4" id="C">
<label style="float:left" > &nbsp;&nbsp;&nbsp;&nbsp;D &nbsp;</label>
<input style="float:left" name='dn'  type="text" onkeypress='validate(event)'  maxlength="3" size="4" id="D" >
<button style="float:right"  onclick="return check_ans();"  name="check" class="btn btn-lg btn-primary">Check</button>
</form>
</div>
<div><h3 class="text-center" style="background-color:#33AD92;color: #FFF"><?php echo "$msg"; ?></h3></div>


</div>

</body>
</html>