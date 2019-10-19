<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", true);

require 'vendor/autoload.php';
require 'src/Config.php';
require 'dependences.php';
require 'router/routerLogin.php';
require 'router/routerPainel.php';
require 'router/routerUsu.php';
require 'router/routerOrcamento.php';
require 'router/routerCli.php';
require 'router/routerTec.php';
require 'router/routerOS.php';

$app->run();