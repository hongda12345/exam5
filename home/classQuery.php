<?php
include 'db.php';
$cid = $_REQUEST['cid'];
$sql="select class.*,direction.dname from class,direction where class.did=direction.did and class.cid=$cid";
$data=$mysql->query($sql)->fetch_assoc();
echo json_encode($data);