<?php
include 'db.php';
$tid = $_REQUEST['tid'];
$sql="select * from test where tid=$tid";
$data=$mysql->query($sql)->fetch_assoc();
echo json_encode($data);