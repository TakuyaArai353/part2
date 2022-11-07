<?php
require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
    INSERT INTO reviews (
        title,
        author,
        status,
        score,
        impression
    ) VALUES (
        "{$review['title']}",
        "{$review['author']}",
        "{$review['status']}",
        "{$review['score']}",
        "{$review['impression']}"
    )
    EOT;

    $result = mysqli_query($link, $sql);

    if (!$result) {
        error_log('Error: fail to create company');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

function validate($review)
{
    $errors = [];

    // 書籍名が正しく入力されているかチェック
    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($review['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    // 著者名が正しく入力されているかチェック
    if (!strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($review['author']) > 255) {
        $errors['author'] = '著者名は255文字以内で入力してください';
    }

    // 読書状況が正しく入力されているかチェック
    if (!in_array($review['status'], ['未読', '読んでる', '読了'])) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    // 評価が正しく入力されているかチェック
    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['score'] = '評価は1〜5の整数を入力してください';
    }

    // 感想が正しく入力されているかチェック
    if (!strlen($review['impression'])) {
        $errors['impression'] = '感想を入力してください';
    } elseif (strlen($review['impression']) > 10000) {
        $errors['impression'] = '感想は10,000文字以内で入力してください';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $status = '';
    if (array_key_exists('status', $_POST)) {
        $status = $_POST['status'];
    }

    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $status,
        'score' => $_POST['score'],
        'impression' => $_POST['impression']
    ];

    $errors = validate($review);

    if (!count($errors)) {
        $link = dbConnect();
        createReview($link, $review);
        mysqli_close($link);
    }
}

include 'views/new.php';
