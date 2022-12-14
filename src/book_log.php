<?php
function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    // if (!$link) {
    //     echo 'Error: データベースに接続できませんでした' . PHP_EOL;
    //     echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    //     exit;
    // }

    // echo 'データベースに接続できました' . PHP_EOL;

    return $link;
}

function validate($review)
{
    $errors = [];

    // 書籍名が正しく入力されているかチェック
    if (!mb_strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (mb_strlen($review['title']) > 255) {
        $errors['title'] = '書籍名は２５５文字以内で入力してください';
    }

    // 著者名が正しく入力されているかチェック
    if (!mb_strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (mb_strlen($review['author']) > 100) {
        $errors['author'] = '著者名は１００文字以内で入力してください';
    }

    // 読書状況が正しく入力されているかチェック
    if (!in_array($review['situation'], ['未読', '読中', '読了'])) {
        $errors['situation'] = '読書状況には「未読」「読中」「読了」のいずれかを入力してください';
    }

    // 評価（５点満点の整数）が正しく入力されているかチェック
    if (!mb_strlen($review['score'])) {
        $errors['score'] = '評価を入力してください';
    } else if ($review['score'] > 5 || $review['score'] < 1) {
        $errors['score'] = ' 評価は１～５の整数を入力してください';
    }

    // 感想が正しく入力されているかチェック
    if (!mb_strlen($review['impression'])) {
        $errors['impression'] = '感想を入力してください';
    } elseif (mb_strlen($review['impression']) > 1000) {
        $errors['impression'] = '感想は１０００文字以内で入力してください';
    }

    return $errors;
}

function createReview($link)
{
    $review = [];
    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $review['title'] =  trim(fgets(STDIN));
    echo '著者名：';
    $review['author'] =  trim(fgets(STDIN));
    echo '読書状況：';
    $review['situation'] =  trim(fgets(STDIN));
    echo '評価：';
    $review['score'] = (int) trim(fgets(STDIN));
    echo '感想：';
    $review['impression'] =  trim(fgets(STDIN));

    $validated = validate($review);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

    $sql = <<<EOT
    INSERT INTO reviews (
        title,
        author,
        situation,
        score,
        impression
    ) VALUES (
        "{$review['title']}",
        "{$review['author']}",
        "{$review['situation']}",
        "{$review['score']}",
        "{$review['impression']}"
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

function displayReviews($link)
{
    echo '読書ログを表示します' . PHP_EOL;

    $sql = 'SELECT * FROM reviews';

    $result = mysqli_query($link, $sql);

    while ($review = mysqli_fetch_assoc($result)) {
            echo '書籍名：' . $review['title'] . PHP_EOL;
            echo '著者名：' . $review['author'] . PHP_EOL;
            echo '読書状況：' . $review['situation'] . PHP_EOL;
            echo '評価：' . $review['score'] . PHP_EOL;
            echo '感想：' . $review['impression'] . PHP_EOL;
            echo '---------------------' . PHP_EOL;
    }

    mysqli_free_result($result);
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
        createReview($link);
    } elseif ($num === '2') {
        // 読書ログを表示する
        displayReviews($link);
    } elseif ($num === '9') {
        // アプリケーションを終了する
        mysqli_close($link);
        echo 'データベースとの接続を切断しました' . PHP_EOL;
        break;
    }

}
