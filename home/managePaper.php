<?php
include 'db.php';
$sql="select paper.*,class.cname from paper,class where paper.cid=class.cid";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);