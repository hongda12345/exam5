<?php
include 'db.php';
$uid = $_REQUEST['uid'];
$sql="select * from student where uid = $uid";
$data=$mysql->query($sql)->fetch_assoc();
echo json_encode($data);