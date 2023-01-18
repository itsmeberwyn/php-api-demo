<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-User");

date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

define("SERVER", "localhost");
define("DBASE", "sample_db");
define("USER", "root");
define("PASSWORD", "");
define("CHARSET", "utf8mb4");

class Connection
{
    protected $conString = "mysql:host=" . SERVER . ";dbname=" . DBASE . "; charset=" . CHARSET;
    protected $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false
    ];

    public function connect()
    {
        return new \PDO($this->conString, USER, PASSWORD, $this->options);
    }
}
