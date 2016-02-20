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

// 日本時間にセットしておく
date_default_timezone_set('Asia/Tokyo');
// 現在時刻のオブジェクト
$now = new \DateTimeImmutable;

$basedir = dirname(__DIR__);
$loader = new \Twig_Loader_Filesystem($basedir . '/src/View/template');
$twig   = new \Twig_Environment($loader, [
    'cache' => $basedir . '/cache/twig',
    'debug' => true,
]);

$content = $twig->render('index.tpl.html', [
    'greeting' => greeting($now),
]);

header('Content-Type: text/html; charset=utf-8');
header('Content-Length: ' . strlen($content));
echo $content;

/**
 * @return string
 */
function greeting(\DateTimeInterface $dt)
{
    $hour = (int)$dt->format('H');

    if (4 <= $hour && $hour < 10) {
        return "お早うございます";
    }
    if (10 <= $hour && $hour < 17) {
        return "こんにちは";
    }

    return "こんばんわ";
}
