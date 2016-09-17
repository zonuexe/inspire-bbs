<?php

namespace InspireBBS\Model;

use Teto\SQL;

/**
 * レス(発言/POST)を表現するモデル
 *
 * @author    USAMI Kenta
 * @copyright 2016 USAMI Kenta
 * @license   WTFPL
 *
 * @property int    $id          レスID(通番)
 * @property string $board_id    板ID(slug)
 * @property int    $thread_timestamp スレID(slug)
 * @property \DatetimeImmutable $posted_at 投稿された日付
 * @property string $name        名前(+トリップ)
 * @property string $email       e-mail (または、キャップ)
 * @property string $author_hash 投稿者ID
 * @property string $message     投稿される本文
 * @property string $ip_addr     IPアドレス、京都府警から令状が届いたら困るよね
 */
final class Post implements ModelInterface
{
    use \Teto\Object\TypedProperty;

    private static $property_types = [
        'id'               => 'int',
        'board_id'         => 'string',
        'thread_timestamp' => 'int',
        'posted_at'        => 'DatetimeImmutable',
        'name'             => 'string',
        'email'            => 'string',
        'author_hash'      => 'string',
        'message'          => 'string',
        'ip_addr'          => 'string',
    ];

    public function __construct(array $properties)
    {
        $this->setProperties($properties);
    }

    public function setProperties(array $properties)
    {
        if (isset($properties['id'])) {
            $this->id = (int)$properties['id'];
        }
        if (isset($properties['board_id'])) {
            $this->board_id = $properties['board_id'];
        }
        if (isset($properties['thread_timestamp'])) {
            $this->thread_timestamp = (int)$properties['thread_timestamp'];
        }
        if (isset($properties['posted_at'])) {
            $this->posted_at = \DatetimeImmutable::createFromFormat('Y-m-d H:i:s', $properties['posted_at']);
        }
        if (isset($properties['name'])) {
            $this->name = $properties['name'];
        }
        if (isset($properties['email'])) {
            $this->email = $properties['email'];
        }
        if (isset($properties['author_hash'])) {
            $this->author_hash = $properties['author_hash'];
        }
        if (isset($properties['message'])) {
            $this->message = $properties['message'];
        }
        if (isset($properties['ip_addr'])) {
            $this->ip_addr = $properties['ip_addr'];
        }
    }

    /**
     * @param  Thread $thread
     * @return Post[]
     */
    public static function findAllByThread(Thread $thread)
    {
        $data = SQL\Query::execute(db(), self::findAllByThread_query, [
            ':board_id'  => $thread->board_id,
            ':thread_timestamp' => $thread->timestamp,
        ])->fetchAll(\PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($data as $d) {
            $posts[] = new Post($d);
        }

        return $posts;
    }
    const findAllByThread_query = '
        SELECT `id`, `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr`
        FROM `posts`
        WHERE `board_id` = :board_id@string AND `thread_timestamp` = :thread_timestamp@int
    ';
}
