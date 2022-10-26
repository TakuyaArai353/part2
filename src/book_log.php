<?php

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'Error: データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースに接続できました' . PHP_EOL;

    return $link;
}

function createReview($link)
{
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

    $sql = <<<EOT
    INSERT INTO reviews (
        title,
        author,
        situation,
        score,
        impression
    ) VALUES (
        "{$title}",
        "{$author}",
        "{$situation}",
        $score,
        "{$impression}"
    )
    EOT;

    $result = mysqli_query($link, $sql);

    if ($result) {
        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error: データの登録に失敗しました' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }
}

function displayReviews($reviews)
{
    echo '読書ログを表示します' . PHP_EOL;

    foreach ($reviews as $review) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名：' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['situation'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['impression'] . PHP_EOL;
        echo '----------------' . PHP_EOL;
    }
}

$reviews = [];

$link = dbConnect();

while (true) {

    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）:';
    $num = trim(fgets(STDIN));


    if ($num === '1') {
        // 読書ログを登録する
        // $reviews[] = createReview();
        createReview($link);
    } elseif ($num === '2') {
        // 読書ログを表示する
        displayReviews($reviews);
    } elseif ($num === '9') {
        // アプリケーションを終了する
        mysqli_close($link);
        echo 'データベースとの接続を切断しました' . PHP_EOL;
        break;
    }

}
