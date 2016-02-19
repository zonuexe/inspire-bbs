-- -*- sql-product: sqlite -*-

CREATE TABLE `boards`( -- 板
    `id`   TEXT PRIMARY KEY, -- 板ID(slug)
    `name` TEXT NOT NULL,    -- 板名
    `text` TEXT NOT NULL     -- 説明文
);

CREATE TABLE `threads`( -- スレ
    `timestamp` INT  NOT NULL, -- スレID(timestamp)
    `board_id`  TEXT NOT NULL, -- 板ID(slug)
    `title`     TEXT NOT NULL, -- スレタイ
    PRIMARY KEY( `timestamp`, `board_id` )
);

CREATE TABLE `posts`( -- レス
    `id`               INTEGER PRIMARY KEY AUTOINCREMENT,
    `board_id`         INT  NOT NULL, -- timestamp
    `thread_timestamp` INT  NOT NULL, -- スレID(timestamp)
    `posted_at`        TEXT NOT NULL, -- 日付 (Y-m-d H:i:s)
    `name`             TEXT NOT NULL, -- 名前(+トリップ)
    `email`            TEXT NOT NULL, -- e-mail (または、キャップ)
    `author_hash`      TEXT NOT NULL, -- 投稿者ID
    `message`          TEXT NOT NULL, -- 投稿される本文
    `ip_addr`          TEXT NOT NULL  -- IPアドレス、京都府警から令状が届いたら困るよね
);
CREATE INDEX `post_board_thread` ON `posts`( `board_id`, `thread_timestamp` );
CREATE INDEX `post_author_hash` ON `posts`( `author_hash` ); -- 必死チェッカー
