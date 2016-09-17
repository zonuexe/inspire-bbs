-- -*- sql-product: sqlite -*-

-- 板
INSERT INTO `boards` VALUES("gline", "ガイドライン＠インスパイヤー", "ここがガ板ですよ。。。" );

-- スレ
INSERT INTO `threads` VALUES(123456789, "gline", "インスパイヤのガイドライン" );

-- 投稿
INSERT INTO `posts`( `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr` )
    VALUES("gline", 123456789, "2016-02-17 04:04:04", "たっどさん", "#いんすぱいやー", "tW1nDri11" ,"てすとです…", "127.0.0.1");

INSERT INTO `posts`( `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr` )
    VALUES("gline", 123456789, "2016-02-18 04:04:04", "たっどさん", "#いんすぱいやー", "tW1nDri11", "もういい加減ねるぽ", "127.0.0.1");
