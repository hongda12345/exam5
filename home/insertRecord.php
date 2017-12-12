<?php
include 'db.php';
$tids=$_REQUEST['tids'];
$answer=$_REQUEST['answer'];
$pid=$_REQUEST['pid'];
for($i=0;$i<count($tids);$i++){
    $str .= "(" . $tids[$i] .",";
    if(is_array($answer['title'.$i])){
        $s = implode(',',$answer['title'.$i]);
        $str .="'" . $s ."',";
    }else{
        $str .="'" . $answer['title'.$i] ."',";
    }
    $str .= $pid . ",'" . $_SESSION['uid'] ."'),";
}
$str = substr($str,0,-1);
$sql = "insert into record (tid,answer,pid,user) values $str";
$mysql->query($sql);
echo $mysql->affected_rows;