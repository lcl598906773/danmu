# danmu
jQuery弹幕插件(服务器采用redis和数据库两种方式)

## jQuery弹幕插件

**一个让网页某div上运行弹幕效果的jQuery插件**

#### 服务器端采用数据库和redis两种方式存储弹幕的信息

- 数据库

注意：在大型的应用程序中，为了防止恶意刷弹幕，需进行单个IP或用户的次数限制等操作。

存储的数据格式：json格式

表结构：在这里弹幕所存放的数据表名称为danmu，该表只有一个text型字段，字段名名也为danmu

- redis

  存储

```php
#保证你的服务器安装php-redis和开启redis服务
/usr/local/redis/utils/redis_init_script_6379 start

$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$danmu = $_POST['danmu'];
$res = $redis->lpush('quene',$danmu); //将弹幕存入队列中
echo json_encode(['res'=>$res]);
```

​	读取

```php
$redis = new Redis();  //实例化redis
$redis->connect('127.0.0.1','6379'); //链接
$quene = $redis->lrange('quene',0,-1); //读取队列中的弹幕信息
echo "[";
$first=0;
foreach ($quene as $key => $value) {
	if ($first) {
		echo ",";
	}
	$first=1;
	echo "'" . $value . "'";
}
echo "]";//返回的数据拼接json格式
```

- 弹幕

  1.初始化

  ```javascript
  $("#danmu").danmu({
      left:0,
      top:0,
      height:"100%",
      width:"100%",
      speed:20000,
      opacity:1,
      font_size_small:16,
      font_size_big:24,
      top_botton_danmu_time:6000
    });
  ```

  2.使用

  ```javascript
  暂停弹幕：
      $('#danmu').danmu('danmuPause');
  暂停后继续：
      $('#danmu').danmu('danmuResume');
  停止弹幕：
      $('#danmu').danmu('danmuStop');
  即时增加弹幕：
      $('#danmu').danmu(addDanmu,新弹幕的弹幕对象或弹幕对象数组);
  获取弹幕运行的当前时间(单位为秒)：
      $('#danmu').data("nowTime");
  设置弹幕运行的当前时间(单位为秒)：
      $('#danmu').danmu("setTime",新时间);
  更改弹幕透明度：
      $(#danmu).danmu("setOpacity",新透明度数值);
  是否处于暂停状态：
      $('#danmu').data("paused");
  隐藏当前已所有弹幕：
      $('#danmu').data("hideAll");
  ```

