<?php 
header('Content-type:text/html;charset=utf8');

/*
 原始
 */
// $conn =mysqli_connect("localhost", "root", "123456"); 
// //链接数据库，替换成自己的
// mysqli_select_db($conn,"danmu"); //选择弹幕列表所存放数据库，替换成自己的
// //存入的是json格式
// $danmu=$_POST['danmu']; 
// //接受弹幕参数，接受参数后请做SQL防注入过滤。
// $sql="INSERT INTO `danmu`(danmu) VALUES ('".$danmu."')"; 
// $query=mysqli_query($conn, $sql);
// //在这里弹幕所存放的数据表名称为danmu，该表只有一个text型字段，字段名名也为danmu
// //注意，在大型的应用程序中，为了防止恶意刷弹幕，需进行单个IP或用户的次数限制等操作。


/*
 PDO 链接数据库
 */
// try {
// 	$dsn= "mysql:host=localhost;dbname=danmu;charset=utf8;";
// 	$pdo = new PDO($dsn,'root','123456');
// 	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
// } catch (PDOException $e) {
// 	echo json_encode(['res'=>$e->getMessage()]);
// }
// try {
// 	$danmu = $_POST['danmu'];
// 	$res = $pdo->exec("insert into danmu(danmu) values('". $danmu ."')");
// 	echo json_encode(['res'=>$res]);
// } catch (PDOException $e) {
// 	echo json_encode(['res'=>$e->getMessage()]);
// }

/*
 redis   存储弹幕
 */
$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$danmu = $_POST['danmu'];
$res = $redis->lpush('quene',$danmu);
echo json_encode(['res'=>$res]);