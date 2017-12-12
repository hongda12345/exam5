<?php
include 'db.php';
$sql="select * from direction";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);