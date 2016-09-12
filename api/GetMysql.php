<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GetMysql {

    public static $instance;

    public static function getInstance() {
        if (null == self::$instance) {
            $mysql = mysql_connect('127.0.0.1', 'root', '19891210wj');
            return self::$instance = $mysql;
        }
        return self::$instance;
    }

}
