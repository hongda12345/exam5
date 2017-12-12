<?php
include 'db.php';
$sql="select * from type";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);