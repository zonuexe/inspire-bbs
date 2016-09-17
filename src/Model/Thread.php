<?php

namespace InspireBBS\Model;

use Teto\SQL;

/**
 * スレッドを表現するモデル
 *
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 *
 * @property int    $timestamp スレID(timestamp)
 * @property string $board_id  板ID(slug)
 * @property string $title     スレタイ
 */
final class Thread implements ModelInterface
{
    use \Teto\Object\TypedProperty;

    private static $property_types = [
        'timestamp' => 'int',
        'board_id'  => 'string',
        'title'     => 'string',
    ];

    public function __construct(array $properties)
    {
        $this->setProperties($properties);
    }

    public function setProperties(array $properties)
    {
        if (isset($properties['timestamp'])) {
            $this->timestamp = (int)$properties['timestamp'];
        }
        if (isset($properties['board_id'])) {
            $this->board_id = $properties['board_id'];
        }
        if (isset($properties['title'])) {
            $this->title = $properties['title'];
        }
    }

    /**
     * @param  string $id
     * @param  int    $timestamp
     * @return Thread|false
     */
    public static function findByBoard(Board $board, $timestamp)
    {
        $data = SQL\Query::execute(db(), self::findByBoard_query, [
            ':board_id'  => $board->id,
            ':timestamp' => $timestamp,
        ])->fetch(\PDO::FETCH_ASSOC);

        return $data ? new Thread($data) : false;
    }
    const findByBoard_query = '
        SELECT `timestamp`, `board_id`, `title`
        FROM `threads`
        WHERE `board_id` = :board_id@string AND `timestamp` = :timestamp@int
    ';

    /**
     * @param  string $id
     * @return Thread[]
     */
    public static function findAllByBoard(Board $board)
    {
        $data = SQL\Query::execute(db(), self::findAllByBoard_query, [
            ':board_id' => $board->id,
        ])->fetchAll(\PDO::FETCH_ASSOC);

        $threads = [];
        foreach ($data as $d) {
            $threads[] = new Thread($d);
        }

        return $threads;
    }
    const findAllByBoard_query = '
        SELECT `timestamp`, `board_id`, `title`
        FROM `threads`
        WHERE `board_id` = :board_id@string
    ';
}
