<?php
include 'db.php';
$name = $_POST['name'];
$pass = md5($_POST['pass']);
$type = $_POST['type'];
$code1 =$_POST['code'];
$code=strtolower($code1);
$sql = "select * from $type";
$data = $mysql->query($sql)->fetch_all(1);
for($i = 0;$i<count($data);$i++){
    if($data[$i]['mname'] == $name){
        session_start();
        if($_SESSION['code']==$code){
            if($data[$i]['mpass'] == $pass){
                $_SESSION['user']=$name;
                $_SESSION['isLogin']='yes';
                echo '1';
                if($type=='student'){
                    $_SESSION['uid']=$data[$i]['uid'];
                    $_SESSION['cid']=$data[$i]['cid'];
                }
                exit();
            }else{
                echo '2';
                exit();
            }
        }else{
            echo '3';
            exit();
        }
    }
}
echo '4',
exit;