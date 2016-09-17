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

ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('xdebug.var_display_max_depth', -1);

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
$routing_map['top_index'] = ['GET', '/', function (Action $action) use ($twig, $now) {
    return $twig->render('top_index.tpl.html', [
        'boards' => Model\Board::findAll(),
    ]);
}];

$routing_map['board_index'] = ['GET', '/:board', function (Action $action) use ($twig, $now) {
    $board = Model\Board::find($action->param['board']);
    $threads = Model\Thread::findAllByBoard($board);

    return $twig->render('board_index.tpl.html', [
        'board'   => $board,
        'threads' => $threads,
    ]);
}, ['board' => '/\A[a-z0-9]{1,16}\z/']];

$routing_map['thread_index'] = ['GET', '/:board/:timestamp', function (Action $action) use ($twig, $now) {
    return 'あとで実装…';
}, ['board' => '/\A[a-z0-9]{1,16}\z/', 'timestamp' => '/\A[1-9][0-9]*\z/']];

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
