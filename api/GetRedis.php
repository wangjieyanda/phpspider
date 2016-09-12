<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GetRedis {

    public static $_instance;

    public function __construct() {

    }

    public static function getInstance() {
        if (NULL == self::$_instance) {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            return self::$_instance = $redis;
        }
        return self::$_instance;
    }

}
