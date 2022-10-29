<?php

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

if (!$link) {
    echo 'Error: データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo 'データベースに接続できました' . PHP_EOL;

// データの取得
$sql = 'SELECT name FROM companies';

$result = mysqli_query($link, $sql);

// 連想配列で結果を取得
while ($company = mysqli_fetch_assoc($result)) {
    echo '会社名：' . $company['name'] . PHP_EOL;
}

// メモリの解放
mysqli_free_result(($result));

// データの追加
// $sql = <<<EOT
// INSERT INTO companies (
//     name,
//     establishment_date,
//     founder
// ) VALUES (
//     'SmartHR Inc',
//     '2013-01-23',
//     'Syouji Miyata'
// )
// EOT;

// $result = mysqli_query($link, $sql);

// if ($result) {
//     echo 'データを追加しました' . PHP_EOL;
// } else {
//     echo 'Error: データの追加に失敗しました' . PHP_EOL;
//     echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
// }

mysqli_close($link);
echo 'データベーストの接続を切断しました' . PHP_EOL;
