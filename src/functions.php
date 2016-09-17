<?php
/**
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 */

/**
 * @return \PDO
 */
function db()
{
    static $db;

    if (!$db) {
        $db = new \PDO(getenv('DB_DSN'), '', '', [PDO::ATTR_PERSISTENT => true]);
    }

    return $db;
}


/**
 * @param  string $input UTF-8
 * @return string
 */
function tripize($input)
{
    $input = strtr($input, ['★' => '☆', '◆' => '◇']);
    $parts = explode('#', $input, 2);
    $name = array_shift($parts);

    return trim(rtrim($name) . (isset($parts[0]) ? ' ◆' . trip($parts[0]) : ''));
}

/**
 * @param  string $input
 * @return string
 */
function trip($input)
{
    static $salt_table = [
        ':' => 'A',  '['  => 'a',
        ';' => 'B',  '\\' => 'b',
        '<' => 'C',  ']'  => 'c',
        '=' => 'D',  '^'  => 'd',
        '>' => 'E',  '_'  => 'e',
        '?' => 'F',  '`'  => 'f',
        '@' => 'G',
    ];

    $input = mb_convert_encoding($input, 'SJIS', 'UTF-8,SJIS');
    $salt = substr($input . 'H.', 1, 2);
    $salt = strtr($salt, $salt_table);
    $salt = preg_replace('/[\x00-\x20\x7B-\xFF]/', '.', $salt);

    return substr(crypt($input, $salt), -10);
}

function trip12($input)
{
    // todo
}
