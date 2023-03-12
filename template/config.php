<?php
$base_path = "./template/default/";
TDConfig::$db_type = "sqlite";
TDConfig::$table_pre = "javatodo_";
TDConfig::$sqlite_db = $base_path . "db/malltodo.db";
TDConfig::$upload["rootPath"] = $base_path . "Uploads/";