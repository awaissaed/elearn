<?php

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('mydb.db');
	}
}
$db = new MyDB();
if (!$db) {
	echo $db->lastErrorMsg();
}
class localdb extends SQLite3 {
	function __construct() {
		$this->open('local.db');
	}
}
$db1 = new localdb();
if (!$db1) {
	echo $db1->lastErrorMsg();
}
?>
