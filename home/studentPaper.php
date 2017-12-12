<?php
include 'db.php';
session_start();
$pid=$_REQUEST['pid'];
$sql="select test.*,paperextra.* from test,paperextra where test.tid=paperextra.tid and pid=$pid";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
