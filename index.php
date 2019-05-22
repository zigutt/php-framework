<?php
require_once("core/config.php");
require_once("core/Controller.php");
require_once("core/Router.php");
require_once("App/routes/web.php");
require_once("core/PDOWrapper.php");
require_once("core/Template.php");

Router::run();