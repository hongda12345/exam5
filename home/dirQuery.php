<?php
include 'db.php';
$did = $_REQUEST['did'];
$sql="select * from direction where did=$did";
$data=$mysql->query($sql)->fetch_assoc();
echo json_encode($data);