<?php

$title = '';
$author = '';
$situation = '';
$score = '';
$impression = '';

$reviews = [];

while (true) {

    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）:';
    $num = trim(fgets(STDIN));


    if ($num === '1') {
        // 読書ログを登録する
        echo '読書ログを登録してください' . PHP_EOL;
        echo '書籍名：';
        $title =  trim(fgets(STDIN));
        echo '著者名：';
        $author =  trim(fgets(STDIN));
        echo '読書状況：';
        $situation =  trim(fgets(STDIN));
        echo '評価：';
        $score =  trim(fgets(STDIN));
        echo '感想：';
        $impression =  trim(fgets(STDIN));

        $reviews[] = [
            'title' => $title,
            'author' => $author,
            'situation' => $situation,
            'score' => $score,
            'impression' => $impression,
        ];

        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } elseif ($num === '2') {
        // 読書ログを表示する
        foreach ($reviews as $review) {
            echo '読書ログを表示します' . PHP_EOL;
            echo '書籍名：' . $review['title'] . PHP_EOL;
            echo '著者名：' . $review['author'] . PHP_EOL;
            echo '読書状況：' . $review['situation'] . PHP_EOL;
            echo '評価：' . $review['score'] . PHP_EOL;
            echo '感想：' . $review['impression'] . PHP_EOL;
            echo '----------------' . PHP_EOL;
        }


    } elseif ($num === '9') {
        // アプリケーションを終了する
        break;
    }

}
