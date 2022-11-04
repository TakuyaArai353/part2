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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'impression' => $_POST['impression']
    ];

    // バリデーションする
    $link = dbConnect();

    createReview($link, $review);

    mysqli_close($link);
}

header("Location: index.php");

?>
