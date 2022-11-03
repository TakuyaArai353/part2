<?php

require_once __DIR__ . '/lib/mysqli.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = [
        'name' => $_POST['name'],
        'establishment_date' => $_POST['establishment_date'],
        'founder' => $_POST['founder']
    ];

    // バリデーションする
    $link = dbConnect();

    // データベスにデータを登録する
    createCompany($link, $company);
    // データベースとの接続を切断する
}

?>
