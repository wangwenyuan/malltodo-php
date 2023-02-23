<?php
$base_path = "D:/phpstudy_pro/WWW/malltodo-php-template/a001/";

TDConfig::$db_type = "sqlite";
TDConfig::$sqlite_db = $base_path . "db/malltodo.db";
TDConfig::$upload["rootPath"] = $base_path . "Uploads";