<?php

include 'api/Api.php';
include 'api/GetUser.php';
include 'api/GetRedis.php';

function getUserData($url) {
    if (class_exists('Api')) {
        $api = new Api();
        $get = new GetUser();
        $result = $api::request($url, 'post', $param);

        $str = htmlspecialchars_decode($result);

        //用户图片
        $cahce = new GetRedis();
        $redis = $cahce::getInstance();
        preg_match_all('/<img.*?(?:>|\/>)/', $str, $matches);
        $returnUser = $get->get($matches[0], $redis);

        if (count($returnUser) > 0) {
            foreach ($returnUser as $key => $list) {
                if (strpos($list, 'medium')) {
                    continue;
                } else {
                    $image = pathinfo($list);
                    $imageAry = explode('/', $image['dirname']);
                    $userId = $imageAry[count($imageAry) - 2];
                    $userUrl[] = 'http://www.qiushibaike.com/users/' . $userId . '/followers/';
                }
            }
        }
        echo "<pre>";
        print_r($userUrl);
        echo "</pre>";

        $userUrl = array_unique($userUrl);
        if (count($userUrl) > 0) {
            foreach ($userUrl as $key => $l) {
                getUserData($l);
            }
        }
    } else {

        echo "类不存在";
    }
}

for ($i = 1; $i < 10000000000; $i++) {
    $url = 'http://www.qiushibaike.com/users/' . $i . '/followers/';
    getUserData($url);
}
