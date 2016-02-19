<?php
/**
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 */
namespace InspireBBS;

require_once dirname(__DIR__) . '/vendor/autoload.php';

error_reporting(E_ALL | E_STRICT);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

echo "こんにちはこんにちは";
