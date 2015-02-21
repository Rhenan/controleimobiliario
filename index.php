<?php
session_start();

define("BASEDIR",dirname(__FILE__)."/");
define("DEFAULT_CONTROLLER","IndexController");
define("DEFAULT_ACTION","index");
define("ERROR_CONSOLE",0);

define("UPLOAD_DIR",BASEDIR."files/");

require("core/Engine.php");

Engine::start();
