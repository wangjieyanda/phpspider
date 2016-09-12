<?php

include 'api/GetRedis.php';
include 'api/GetMysql.php';
$sql = new GetMysql();
$mysql = $sql::getInstance();

$cache = new GetRedis();
$redis = $cache::getInstance();

$key = 'qiubai_key';
$length = $redis->llen($key);

$getAll = $redis->lrange($key, 0, $length);
foreach ($getAll as $key => $lists) {
    if (count($lists) > 0) {
        $jsonContenst[] = json_decode($lists, true);
    }
}
$b = mysql_select_db('qiubaii', $mysql);
mysql_query("set names 'utf8'");
foreach ($jsonContenst as $jsonContent) {
    foreach ($jsonContent as $key => $l) {
        $image = pathinfo($l[image_url]);
        $imageAry = explode('/', $image['dirname']);
        $userId = $imageAry[count($imageAry) - 2];
        $sqlselect = 'select * from user where userid=' . $userId;
        $select = mysql_query($sqlselect);
        $num = mysql_result($select, 2);
        if ($num <= 0 || !$num) {
            $sql = 'insert into user(userid,username,image_url) values(' . '"' . $userId . '"' . ',"' . $l[name] . '",' . '"' . $l[image_url] . '"' . ')';
            $a = mysql_query($sql);
        }
        var_dump($a);
    }
}

