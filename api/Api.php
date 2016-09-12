<?php

class Api {

    public static $cookie = array(
        '__utma' => '51854390.1308949105.1473467365.1473467365.1473467365.1',
        '__utmb' => '51854390.6.10.1473467365',
        '__utmc' => '51854390',
        '__utmd' => '1',
        '__utmt' => '1 ',
        '__utmv' => '51854390.100-1|2=registration_date=20151130=1^3=entry_date=20151130=1 ',
        '__utmz' => '51854390.1473467365.1.1.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/people/ai-qi-xing
-de-ha-shi-qi',
        '_xsrf' => 'dcb2324001524148a825a546ab3fc1b1',
        '_za' => 'edd7fef0-f340-4eb7-9efe-17f849b9377f',
        '_zap' => '"2.0ABBMW-nIFQkXAAAA39n6VwAQTFvpyBUJAACAPktDSwoXAAAAYQJVTf4B-VcAsNDTUYXynPquFTqPqWNqV5nI6-2B2_XqnATIadCPSJI-cda7_-biNg
=="',
        'cap_id' => '"NTc2NTU4ZGFkODA4NDk2YmI3ZTk5MzhiMTYwNDIwMjM=|1473344750|24e177a3bb31c1f7f7e3d228a4251ff4c00319e6"',
        'd_c0' => '"AACAPktDSwqPTphLdylww_92aLVjGjG2zVk=|1469629497"',
        'l_cap_id' => '"YWY5NGYxNTcxZDYxNDZiZDkyM2UyZWU3NzI1ZWJiNTk=|1473344750|bb886f281f76a50f6cd6717082ca912370fdd325"',
        'login' => '"ZWQ5NGUzZDlhNjY1NGIzNTlkOTZlZDg0NjhlMmNlODg=|1473344760|54a1f704953c4c474b37f764680a715984307705"',
        'q_c1' => '0c926d8c127245ce984d03e075d20f8b|1473344750000|1469629497000',
        'z_c0' => 'Mi4wQUJCTVctbklGUWtBQUlB...9be45440eac8e91824d42c2',
    );

    public static function request($url_list, $param = array(), $type = "get", $timeout = 5) {
        $result = Api::curlGet($url_list, $param, $type, $timeout);
        return $result;
    }

    public static function curlGet($url_list, $method, $param = array()) {
        //$cookie = self::setCookie(self::$cookie);
        $url_info = $url_list;
        $ch = curl_init($url_info); //初始化会话
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie); //设置请求COOKIE
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER[' HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }
        $result = curl_exec($ch);
        curl_close($ch); //关闭cURL资源，并且释放系统资源
        return $result;
    }

    public static function setCookie($cookies) {
        $str = '';
        foreach ($cookies as $key => $cookie) {
            $str .=$key . $cookie . ';';
        }
        return trim($str, ';');
    }

}
