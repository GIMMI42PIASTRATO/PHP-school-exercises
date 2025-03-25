<?php
echo 'test';
session_start();
echo session_save_path() ?: sys_get_temp_dir();
$_SESSION["user_id"] = 1;
