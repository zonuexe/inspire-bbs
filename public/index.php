<?php
/**
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 */
namespace InspireBBS;
use Teto\Routing\Action;

require_once dirname(__DIR__) . '/vendor/autoload.php';

error_reporting(E_ALL | E_STRICT);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// 日本時間にセットしておく
date_default_timezone_set('Asia/Tokyo');
// 現在時刻のオブジェクト
$now = new \DateTimeImmutable;

$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->overload();
$dotenv->required('DB_DSN')->notEmpty();

$basedir = dirname(__DIR__);
$loader = new \Twig_Loader_Filesystem($basedir . '/src/View/template');
$twig   = new \Twig_Environment($loader, [
    'cache' => $basedir . '/cache/twig',
    'debug' => true,
]);

// この配列にHTTPメソッド、URLと返したい値(クロージャ)を追加してしていくよ。
$routing_map = [];

// クロージャは、Actionを受け取って表示内容を文字列で返す
$routing_map[] = ['GET', '/', function (Action $action) use ($twig, $now) {
    return $twig->render('index.tpl.html', [
        'greeting' => greeting($now),
    ]);
}];

$routing_map[] = ['GET', '/list', function (Action $action) use ($twig, $now) {
    return $twig->render('list.tpl.html', [
        'boards' => Model\Board::findAll(),
    ]);
}];

// ...
// このへんにいろんな機能を追加していくよ
// ...


$routing_map['#404'] = function (Action $action) use ($twig) {
    return "そんなページありませんよ…";
};

// ルーターを起動する
$router = new \Teto\Routing\Router($routing_map);
// Actionオブジェクトにはいろんな情報が詰まってるよ
$action = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
$content = call_user_func($action->value, $action);

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
