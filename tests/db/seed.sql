-- -*- sql-product: sqlite -*-

-- 板
INSERT INTO `boards` VALUES("gline", "ガイドライン＠インスパイヤー", "ここがガ板ですよ。。。" );

-- スレ
INSERT INTO `threads` VALUES(123456789, "gline", "インスパイヤのガイドライン" );
INSERT INTO `threads` VALUES(1152608933, "gline", "邪気眼のガイドライン");

-- 投稿
INSERT INTO `posts`( `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr` )
    VALUES("gline", 123456789, "2016-02-17 04:04:04", "たっどさん", "#いんすぱいやー", "tW1nDri11" ,"てすとです…", "127.0.0.1");

INSERT INTO `posts`( `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr` )
    VALUES("gline", 123456789, "2016-02-18 04:04:04", "たっどさん", "#いんすぱいやー", "tW1nDri11", "もういい加減ねるぽ", "127.0.0.1");

INSERT INTO `posts`( `board_id`, `thread_timestamp`, `posted_at`, `name`, `email`, `author_hash`, `message`, `ip_addr` )
    VALUES("gline", 1152608933, "2006-07-11 18:08:53", "", "", "SFJhLoZb0", "中学の頃カッコいいと思って
怪我もして無いのに腕に包帯巻いて、突然腕を押さえて
「っぐわ！・・・くそ！・・・また暴れだしやがった・・・」とか言いながら息をを荒げて
「奴等がまた近づいて来たみたいだな・・・」なんて言ってた
クラスメイトに「何してんの？」と聞かれると
「っふ・・・・邪気眼（自分で作った設定で俺の持ってる第三の目）を持たぬ物にはわからんだろう・・・」
と言いながら人気の無いところに消えていく
テスト中、静まり返った教室の中で「うっ・・・こんな時にまで・・・しつこい奴等だ」
と言って教室飛び出した時のこと思い返すと死にたくなる

柔道の授業で試合してて腕を痛そうに押さえ相手に
「が・・・あ・・・離れろ・・・死にたくなかったら早く俺から離れろ！！」
とかもやった体育の先生も俺がどういう生徒が知ってたらしくその試合はノーコンテストで終了
毎日こんな感じだった

でもやっぱりそんな痛いキャラだとヤンキーグループに
「邪気眼見せろよ！邪気眼！」とか言われても
「・・・ふん・・・小うるさい奴等だ・・・失せな」とか言ってヤンキー逆上させて
スリーパーホールドくらったりしてた、そういう時は何時も腕を痛がる動作で
「貴様ら・・・許さん・・・」って一瞬何かが取り付いたふりして
「っは・・・し、静まれ・・・俺の腕よ・・・怒りを静めろ！！」と言って腕を思いっきり押さえてた
そうやって時間稼ぎして休み時間が終わるのを待った
授業と授業の間の短い休み時間ならともかく、昼休みに絡まれると悪夢だった", "127.0.0.1");
