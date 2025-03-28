<?php

$url = "https://bussanovittorio.com/api/users/1?info=personal&test=ciao";

var_dump(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
parse_str($_SERVER["QUERY_STRING"], $result);
var_dump($result);
