<?php
include 'db.php';
$sql="select class.*,direction.dname from class,direction where class.did=direction.did";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);