<?php
namespace InspireBBS\Model;
use Teto\SQL;

/**
 * 板を表現するモデル
 *
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 *
 * @property string $id   板ID(slug)
 * @property string $name 板名
 * @property string $text 説明文
 */
final class Board implements ModelInterface
{
    use \Teto\Object\TypedProperty;

    private static $property_types = [
        'id'    => 'string',
        'name'  => 'string',
        'text'  => 'string',
    ];

    public function __construct(array $properties)
    {
        $this->setProperties($properties);
    }

    public function setProperties(array $properties)
    {
        if (isset($properties['id'])) {
            $this->id   = $properties['id'];
        }
        if (isset($properties['name'])) {
            $this->name = $properties['name'];
        }
        if (isset($properties['text'])) {
            $this->text = $properties['text'];
        }
    }

    /**
     * @param  string $id
     * @return Board|false
     */
    public static function find($id)
    {
        $data = SQL\Query::execute(db(), self::find_query, [
            ':id' => $id
        ])->fetch(\PDO::FETCH_ASSOC);

        if ($data === false) {
            return false;
        }

        return new Board($data);
    }
    const find_query = '
        SELECT `id`, `name`, `text` FROM `boards` WHERE `id` = :id@string
    ';

    /**
     * @return Board[]
     */
    public static function findAll()
    {
        $data = SQL\Query::execute(db(), self::findAll_query, [])
            ->fetchAll(\PDO::FETCH_ASSOC) ?: [];

        $boards = [];
        foreach ($data as $b) {
            $boards[] = new Board($b);
        }

        return $boards;
    }
    const findAll_query = '
        SELECT `id`, `name`, `text` FROM `boards`
    ';
}
