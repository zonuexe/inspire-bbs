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
        $db = new \PDO(getenv('DB_DSN'), null, null, [PDO::ATTR_PERSISTENT => true]);
    }

    return $db;
}
