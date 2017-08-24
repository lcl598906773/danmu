<?php 
// header('Content-type:text/html;charset=utf8');
/*
 数据库读取弹幕
 */
// $conn = mysqli_connect("localhost", "root", "123456");
// mysqli_select_db($conn,"danmu");
// $sql="SELECT `danmu` FROM `danmu`";
// $query=mysqli_query($conn, $sql); 
// echo "[";
// $first=0;
// while($row=mysqli_fetch_array($query)){
// 	if ($first) {
// 		echo ",";
// 	}
// 	$first=1;
// 	echo "'".$row['danmu']."'";
// }
// echo "]";
/*
redis 读取弹幕
/usr/local/redis/utils/redis_init_script_6379 start
*/
$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$quene = $redis->lrange('quene',0,-1);
echo "[";
$first=0;
foreach ($quene as $key => $value) {
	if ($first) {
		echo ",";
	}
	$first=1;
	echo "'" . $value . "'";
}
echo "]";