<?php

class GetUser {

    public function get($userList, $cahce) {
        $str = md5(json_encode($userList));
        $userLists = [];
        foreach ($userList as $key => $list) {
            if (strpos($list, 'http://pic.qiushibaike.com/system/avtnew')) {
                $ary = explode(' ', $list);
                $userLists[$key]['name'] = substr($ary['2'], stripos($ary['2'], '"') + 1, -2);
                $userLists[$key]['image_url'] = substr($ary['1'], stripos($ary['1 '], '"') + 5, -1);
                $image = pathinfo(substr($ary['1'], stripos($ary['1 '], '"') + 5, -1));
                $imageAry = explode('/', $image['dirname']);
                $userLists[$key]['userId'] = $imageAry[count($imageAry) - 2];
            }
        }
        if (count($userLists) > 0) {
            $a = $cahce->lPush('qiubai_key', json_encode($userLists));
            return array_column($userLists, 'image_url');
        }
    }

    public function dealUserAll() {

    }

}
