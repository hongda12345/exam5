<?php
include 'db.php';
$sid = $_REQUEST['sid'];
$sql="select stage.*,direction.dname from stage,direction where stage.did=direction.did and stage.sid=$sid";
$data=$mysql->query($sql)->fetch_assoc();
echo json_encode($data);